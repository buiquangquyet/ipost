<?php
App::uses('AppAgentController', 'Controller');
/**
* 申請表示画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class InspectController extends AppAgentController {

    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();

        // listsメソッドを、listとして扱う
        if($this->action == "list"){
            $this->action = "lists";
        }

        $this->Security->csrfCheck = false;
        $this->Security->validatePost = false;
    }

    /**
    * トップ
    */
    public function index() {
    }

    /**
    * 申請リスト
    * @access  public
    */
    public function lists() {
        $this->loadModel('InspectRequest');
        $this->loadModel('Store');
        $this->loadModel('User');
        $status = Configure::read('AgentInspectStatusInfo');

        $results = $this->InspectRequest->getList(0, AuthComponent::user('id'));

        // 情報整理
        $list = array();
        foreach ((array)$results as $key => $value) {
            // ストア情報の取得
            $info = json_decode($this->Store->getData($value['InspectRequest']['user_id']));
            $requeted = '0000-00-00 00:00';
            if ($value['InspectRequest']['created'] != '0000-00-00 00:00:00') {
                $requeted = date('Y-m-d H:i', strtotime($value['InspectRequest']['created']));
            }
            $app_name = __('未設定');
            if ( ! empty($info->text->app_name)) {
                $app_name = $info->text->app_name;
            }

            // ユーザー情報の取得
            $this->User->id = $value['InspectRequest']['user_id'];

            // 取得してきた値をセット
            $value['InspectRequest']['requeted']  = $requeted;
            $value['InspectRequest']['app_name']  = $app_name;
            $value['InspectRequest']['user_name'] = $this->User->field('user_name');
            // 状態の表示を調整します。
            if (empty($value['InspectRequest']['master_id'])) {
                if (empty($value['InspectRequest']['agent_result'])) {
                    $value['InspectRequest']['status_disp'] = $status[$value['InspectRequest']['agent_result']];

                } else {
                    $value['InspectRequest']['status_disp'] = __('代理店審査通過');
                }

            } else {
                // マスター簡易審査までいった
                if (empty($value['InspectRequest']['master_result'])) {
                    if ($value['InspectRequest']['master_result'] === null) {
                        $value['InspectRequest']['status_disp'] = __('代理店審査通過');

                    } else {
                        $value['InspectRequest']['status_disp'] = __('マスターリジェクト');
                    }

                } else {
                    if ($value['InspectRequest']['status'] == 9) {
                        $value['InspectRequest']['status_disp'] = __('公開中');

                    } else if ($value['InspectRequest']['status'] > 3) {
                        $value['InspectRequest']['status_disp'] = __('Android公開中');

                    } else {
                        $value['InspectRequest']['status_disp'] = __('公開準備中');
                    }
                }
            }

            array_push($list, $value);
        }

        $this->set('list', $list);
    }

    /**
    * 申請アプリ状況
    * @access  public
    */
    public function info($id=null) {
        if (is_null($id)) {
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post')) {
            $this->loadModel('Reject');
            $this->Reject->set($this->request->data);
            if ($this->Reject->validates()) {
                $this->reject($id, $this->request->data);
                $this->render('reject');
            }
        }

        $this->loadModel('InspectRequest');
        $this->loadModel('Store');
        $this->loadModel('User');
        $status = Configure::read('InspectStatusInfo');

        // リクエスト情報の取得
        $this->InspectRequest->id = $id;
        $request = $this->InspectRequest->read();
        $request['InspectRequest']['status'] = $status[$request['InspectRequest']['status']];

        $elapsed_time = __('不明');
        if ($request['InspectRequest']['created'] != '0000-00-00 00:00:00') {
            $elapsed_time = $this->elapsed_time($request['InspectRequest']['created']);
        }

        // ストア情報の取得
        $store = json_decode($this->Store->getData($id));

        // ユーザー情報の取得
        $this->User->id = $request['InspectRequest']['user_id'];
        $user = $this->User->read();

        $this->set('requestInfo', $request);
        $this->set('userInfo',  $user);
        $this->set('storeInfo', $store);
        $this->set('elapsed_time', $elapsed_time);

        // 対応言語の選択
        $this->loadModel('UserLang');
        $langConf = Configure::read('flag_name');
        $langInfo = $this->UserLang->getList($id);
        $langOptions = array();
        foreach ((array)$langInfo as $key => $lang) {
            $langOptions[$lang['UserLang']['lang']] = $langConf[$lang['UserLang']['lang']];
        }
        if (empty($langOptions)) {
            $langOptions = $langConf;
        }
        $this->set('langOptions', $langOptions);
    }

    /**
    * リジェクト処理
    */
    private function reject($id, $data) {
        $this->loadModel('InspectRequest');
        $this->InspectRequest->id = $id;
        $request = $this->InspectRequest->read();

        // DBの値を更新します。
        $setItem = array();
        $setItem['agent_result'] = 0;
        if ( ! $this->InspectRequest->save($setItem)) {
            $this->Session->setFlash(__('審査リジェクト処理に失敗しました。'));
            $this->redirect(array('action' => 'info', $id));
        }

        // ユーザー情報の取得
        $this->loadModel('User');
        $this->User->id = $request['InspectRequest']['user_id'];
        $user = $this->User->read();

        // メール送信の準備
        $email = $user['User']['email'];
        $subject = __('【iPost運営事務局】アプリ簡易審査結果のお知らせ');
        $template = 'inspect/reject';
        if ( ! empty($data['Reject']['lang'])) {
            $template = $data['Reject']['lang'] . DS . 'inspect/reject';
        }
        $body = array (
            'user_name' => $user['User']['user_name'],
            'type'  => $data['Reject']['type'],
            'title' => $data['Reject']['title'],
            'body'  => $data['Reject']['body'],
        );
        $this->sendEmail($email, $subject, $template, $body);

        $this->Session->setFlash(__('リジェクト処理を行いました。'), 'default', array('class' => 'alert alert-success'));
        $this->redirect(array('action' => 'list'));
    }

    /**
    * 審査通過処理
    */
    public function pass($id=null) {
        $this->loadModel('InspectRequest');
        $this->InspectRequest->id = $id;

        // DBの値を更新します。
        $setItem = array();
        $setItem['agent_result'] = 1;
        $setItem['status'] = 1;
        $setItem['master_result'] = null;
        if ( ! $this->InspectRequest->save($setItem)) {
            $this->Session->setFlash(__('通過処理に失敗しました。'));
            $this->redirect(array('action' => 'info', $id));

        } else {
            $this->Session->setFlash(__('通過処理を行いました。'), 'default', array('class' => 'alert alert-success'));
            $this->redirect(array('action' => 'list'));
        }
    }

    /**
    * 経過時間を計算します。
    * @param string $start_datetime 登録日時
    */
    private static function elapsed_time($start_datetime) {
        $start   = strtotime($start_datetime);
        $current = time();
        $e_sec   = $current - $start;
        if ($e_sec < 0) {
            $e_sec = __('--- 不明 ---');
            return $e_sec;
        }

        $dd = (int)($e_sec / (60 * 60 * 24));
        if ($dd < 1) {
            $dd = '';
        }

        $e_sec2 = $e_sec - ($dd * 60 * 60 * 24);
        $ss = $e_sec2 % 60;
        $mm = (int)($e_sec2 / 60) % 60;
        $hh = (int)($e_sec2 / (60 * 60));

        $time_str = '';
        if ( ! empty($dd)) {
            $time_str = '%d日 + %02d:%02d:%02d 経過';
            return sprintf($time_str, $dd, $hh, $mm, $ss);
        } else {
            $time_str = '%02d:%02d:%02d 経過';
            return sprintf($time_str, $hh, $mm, $ss);
        }
    }

    /**
     * ブラックホールコールバック
     */
    public function blackhole($type) {
        switch ($type) {
            case 'csrf':
                $this->Session->setFlash(__('不正な送信が行われました'), 'flash_alert', array());
                $this->redirect(array('action' => $this->action));
                break;
            default:
                $this->redirect(array('action' => 'list'));
                break;
        }
    }

}
