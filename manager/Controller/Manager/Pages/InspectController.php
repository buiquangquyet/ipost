<?php
App::uses('AppManagerController', 'Controller');
/**
* 申請表示画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class InspectController extends AppManagerController {

    // ページングセットアップ
    public $paginate = array(
        'InspectRequest' => array(
            'conditions' => array(
                'InspectRequest.agent_result' => '1',
            ),
            'limit' => 10,
            'order' => array(
                'InspectRequest.id' => 'desc'
            ),
        ),
    );

    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();

        $this->loadModel('InspectRequest');
        $this->loadModel('Reject');
        $this->loadModel('User');
        $this->loadModel('Store');

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
        $current_status = 1;
        if (array_key_exists('status', $this->request->params)) {
            $current_status = $this->request->params['status'];
        }

        $status = Configure::read('InspectStatusInfo');

        $requests = $this->paginate('InspectRequest', array('status =' =>  $current_status));

        // 情報整理
        $list = array();
        foreach ((array)$requests as $key => $value) {
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
            $value['InspectRequest']['status_disp'] = $status[$value['InspectRequest']['status']];

            array_push($list, $value);
        }

        $this->set('current_status', $current_status);
        $this->set('list', $list);
        $this->render('list');
    }

    /**
    * 申請アプリ状況
    * @access  public
    */
    public function info($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('リクエストIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        // リジェクト処理
        if ($this->request->is('post')) {
            $this->Reject->set($this->request->data);
            if ($this->Reject->validates()) {
                $this->reject($id, $this->request->data);
                $this->render('reject');
            }
        }

        $status = Configure::read('InspectStatusInfo');

        // リクエスト情報の取得
        $this->InspectRequest->id = $id;
        $request = $this->InspectRequest->read();
        $request['InspectRequest']['status_disp'] = $status[$request['InspectRequest']['status']];

        $elapsed_time = __('不明');
        if ($request['InspectRequest']['created'] != '0000-00-00 00:00:00') {
            $elapsed_time = $this->elapsed_time($request['InspectRequest']['created']);
        }

        // ストア情報の取得
        $store = json_decode($this->Store->getData($id));

        // ユーザー情報の取得
        $this->User->id = $request['InspectRequest']['user_id'];
        $user = $this->User->read();

        $this->set('managers', $this->User->getOptionsArray(USER_TYPE_NONE));
        $this->set('requestInfo', $request);
        $this->set('userInfo',  $user);
        $this->set('storeInfo', $store);
        $this->set('elapsed_time', $elapsed_time);
    }

    /**
    * アプリ審査担当者の設定
    */
    public function manager_update($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('リクエストIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        // ステータスの更新
        $this->status_update($id, 2, $this->request->data);
        $this->Session->setFlash(__('簡易審査の受領処理をしました。'), 'default', array('class' => 'alert alert-success'));
        $this->redirect(array('action' => 'info', $id));
    }

    /**
    * リジェクト処理
    * バリデーションの関係上、プライベートメソッド処理にしています。
    */
    private function reject($id, $data) {
        $this->InspectRequest->id = $id;
        $request = $this->InspectRequest->read();

        // DBの値を更新します。
        $setItem = array();
        $setItem['agent_result'] = null;
        $setItem['status'] = 0;
        $setItem['master_result'] = 0;
        if ( ! $this->InspectRequest->save($setItem)) {
            $this->Session->setFlash(__('審査リジェクト処理に失敗しました。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'info', $id));
        }

        // ユーザー情報の取得
        $this->User->id = $request['InspectRequest']['user_id'];
        $user = $this->User->read();

        $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' ' . print_r($user, true), LOG_DEBUG);

        // メール送信のための処理
        $this->User->id = $user['UserRelation'][0]['parent_id'];
        $agent = $this->User->read();

        $email = $agent['User']['email'];
        $subject = __('【iPost運営事務局】アプリ簡易審査結果のお知らせ');
        // テンプレートに送る変数
        $body = array (
            'agent_name' => $agent['User']['user_name'],
            'user_id'   => $user['User']['id'],
            'user_name' => $user['User']['user_name'],
            'type'  => $data['Reject']['type'],
            'title' => $data['Reject']['title'],
            'body'  => $data['Reject']['body'],
        );

        $this->sendEmail($email, $subject, 'inspect/agent/reject', $body);

        $this->Session->setFlash(__('審査リジェクトの処理をしました。'), 'default', array('class' => 'alert alert-success'));
        $this->redirect(array('action' => 'list'));
    }

    /**
    * 審査通過処理
    */
    public function pass($id=null) {
        $this->InspectRequest->id = $id;

        // ステータスの更新
        $request = $this->status_update($id, 3, $this->request->data);

        // ユーザー情報の取得
        $this->User->id = $request['InspectRequest']['user_id'];
        $userInfo = $this->User->read();

        // ユーザーのストア情報を取得
        $storeInfo = json_decode($this->Store->getData($userInfo['User']['id']), true);

        // ユーザーにメール送信
        $email = $userInfo['User']['email'];
        $subject = __('【iPost運営事務局】アプリ簡易審査通過のお知らせ');
        $body = array(
            'user_name' => $userInfo['User']['user_name'],
        );
        $this->sendEmail($email, $subject, 'inspect/client/pass', $body);

        // 所属代理店の情報を読み込み
        $this->User->id = $userInfo['UserRelation'][0]['parent_id'];
        $agentInfo = $this->User->read();

        // 所属代理店にメール送信
        $email = $agentInfo['User']['email'];
        $subject = __('【iPost運営事務局】アプリ簡易審査を通過されました');
        $body = array(
            'user_name' => $userInfo['User']['user_name'],
            'app_name' => $storeInfo['text']['app_name'],
        );
        $this->sendEmail($email, $subject, 'inspect/agent/pass', $body);

        $this->Session->setFlash(__('アプリ簡易審査通過の処理をしました。'), 'default', array('class' => 'alert alert-success'));
        $this->redirect(array('action' => 'list'));
    }

    /**
    * GooglePlay リリース完了処理
    */
    public function release_android($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('リクエストIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        // ステータスの更新
        $request = $this->status_update($id, 4, $this->request->data);

        // ユーザー情報の取得
        $this->User->id = $request['InspectRequest']['user_id'];
        $userInfo = $this->User->read();

        // ユーザーのストア情報を取得
        $storeInfo = json_decode($this->Store->getData($userInfo['User']['id']), true);

        // ユーザーにメール送信
        $email = $userInfo['User']['email'];
        $subject = __('【iPost運営事務局】Androidアプリ公開のお知らせ');
        $body = array(
            'user_name' => $userInfo['User']['user_name'],
            'app_name'  => $storeInfo['text']['app_name'],
            'store_url' => $storeInfo['url']['google'],
        );
        $this->sendEmail($email, $subject, 'inspect/client/android_release', $body);

        // 所属代理店の情報を読み込み
        $this->User->id = $userInfo['UserRelation'][0]['parent_id'];
        $agentInfo = $this->User->read();

        // 所属代理店にメール送信
        $email = $agentInfo['User']['email'];
        $subject = __('【iPost運営事務局】Androidアプリ公開のお知らせ');
        $this->sendEmail($email, $subject, 'inspect/agent/android_release', $body);

        // 画面遷移
        $this->Session->setFlash(__('Androidアプリ公開の処理をしました。'), 'default', array('class' => 'alert alert-success'));
        $this->redirect(array('action' => 'list'));
    }

    /**
    * iTunesConnect 申請処理
    */
    public function ios_inspect($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('リクエストIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        // ステータスの更新
        $request = $this->status_update($id, 6, $this->request->data);

        // 画面遷移
        $this->Session->setFlash(__('Apple審査申請の処理をしました。'), 'default', array('class' => 'alert alert-success'));
        $this->redirect(array('action' => 'list'));
    }

    /**
    * iTunesConnect 申請処理
    */
    public function ios_request($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('リクエストIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        // ステータスの更新
        $request = $this->status_update($id, 6, $this->request->data);

        // 画面遷移
        $this->Session->setFlash(__('Apple審査申請の処理をしました。'), 'default', array('class' => 'alert alert-success'));
        $this->redirect(array('action' => 'list'));
    }

    /**
    * iTunesConnect リジェクト処理
    */
    public function ios_reject($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('リクエストIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $status = Configure::read('InspectStatusInfo');

        // リクエスト情報の取得
        $this->InspectRequest->id = $id;
        $request = $this->InspectRequest->read();
        $request['InspectRequest']['status_disp'] = $status[$request['InspectRequest']['status']];

        $elapsed_time = __('不明');
        if ($request['InspectRequest']['created'] != '0000-00-00 00:00:00') {
            $elapsed_time = $this->elapsed_time($request['InspectRequest']['created']);
        }

        $this->set('managers', $this->User->getOptionsArray(USER_TYPE_NONE));
        $this->set('requestInfo', $request);
        $this->set('elapsed_time', $elapsed_time);

        // リジェクト処理
        if ($this->request->is('post')) {
            $this->Reject->set($this->request->data);
            if ($this->Reject->validates()) {
                // ステータスの更新
                $request = $this->status_update($id, 7, $this->request->data);

                // ユーザー情報の取得
                $this->User->id = $request['InspectRequest']['user_id'];
                $userInfo = $this->User->read();

                // ユーザーのストア情報を取得
                $storeInfo = json_decode($this->Store->getData($userInfo['User']['id']), true);

                // ユーザーにメール送信
                $email = $userInfo['User']['email'];
                $subject = __('【iPost運営事務局】iOSアプリのApple審査結果のお知らせ');
                $type = Configure::read('InspectRejectAppleType');
                $type_disp = $type[$this->request->data['Reject']['type']];
                $body = array(
                    'user_name' => $userInfo['User']['user_name'],
                    'type'  => $type_disp,
                    'body' => $this->request->data['Reject']['body'],
                );
                $this->sendEmail($email, $subject, 'inspect/client/ios_reject', $body);

                // 画面遷移
                $this->Session->setFlash(__('Apple審査リジェクトの処理をしました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'list'));
            }
        }

    }

    /**
    * iTunesConnect 審査通過処理
    */
    public function ios_pass($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('リクエストIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        // ステータスの更新
        $request = $this->status_update($id, 8, $this->request->data);

        // 画面遷移
        $this->Session->setFlash(__('Apple審査通過の処理をしました。'), 'default', array('class' => 'alert alert-success'));
        $this->redirect(array('action' => 'list'));
    }

    /**
    * iTunesConnect 審査通過処理
    */
    public function ios_release($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('リクエストIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        // ステータスの更新
        $request = $this->status_update($id, 9, $this->request->data);

        // ユーザー情報の取得
        $this->User->id = $request['InspectRequest']['user_id'];
        $userInfo = $this->User->read();

        // ユーザーのストア情報を取得
        $storeInfo = json_decode($this->Store->getData($userInfo['User']['id']), true);

        // ユーザーにメール送信
        $email = $userInfo['User']['email'];
        $subject = __('【iPost運営事務局】iOSアプリ公開のお知らせ');
        $body = array(
            'user_name' => $userInfo['User']['user_name'],
            'app_name'  => $storeInfo['text']['app_name'],
            'store_url' => $storeInfo['url']['google'],
        );
        $this->sendEmail($email, $subject, 'inspect/client/ios_release', $body);

        // 所属代理店の情報を読み込み
        $this->User->id = $userInfo['UserRelation'][0]['parent_id'];
        $agentInfo = $this->User->read();

        // 所属代理店にメール送信
        $email = $agentInfo['User']['email'];
        $subject = __('【iPost運営事務局】iOSアプリ公開のお知らせ');
        $this->sendEmail($email, $subject, 'inspect/agent/ios_release', $body);

        $this->Session->setFlash(__('Appleリリースの処理をしました。'), 'default', array('class' => 'alert alert-success'));
        $this->redirect(array('action' => 'list'));
    }

    /* //////////////////////////////////////////////////
    * 共通的な処理
    */ //////////////////////////////////////////////////
    /**
    * 経過時間を計算します。
    * @param string $start_datetime 登録日時
    */
    private static function elapsed_time($start_datetime) {
        $start   = strtotime($start_datetime);
        $current = time();
        $e_sec   = $current - $start;
        if ($e_sec < 0) {
            $e_sec = '--- 不明 ---';
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
    * ステータスの更新
    */
    private function status_update($id, $status, $data) {
        $this->InspectRequest->id = $id;
        $request = $this->InspectRequest->read();

        $setItem = array();

        // マスターIDの登録
        if (array_key_exists('Reject', $data)) {
            if (array_key_exists('master_id', $data['Reject'])) {
                $setItem['master_id'] = $data['Reject']['master_id'];
            }
        }
        // マスター審査結果登録
        $setItem['master_result'] = 1;

        // ステータスの更新
        if ($request['InspectRequest']['status'] <= $status) {
            $setItem['status'] = $status;
        }
        // GooglePlayリリース完了なら日時の登録
        if ($setItem['status']) {
            $setItem['android_released'] = date('Y-m-d H:i:s');
        }

        if ( ! $this->InspectRequest->save($setItem)) {
            $this->Session->setFlash(__('ステータスの更新に失敗しました'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'info', $id));
        }

        return $request;
    }

    /**
     * ブラックホールコールバック
     */
    public function blackhole($type) {
        switch ($type) {
            case 'csrf':
                $this->Session->setFlash(__('不正な送信が行われました'), 'default', array('class' => 'alert alert-danger'));
                $this->redirect(array('action' => $this->action));
                break;
            default:
                $this->redirect(array('action' => 'list'));
                break;
        }
    }

}
