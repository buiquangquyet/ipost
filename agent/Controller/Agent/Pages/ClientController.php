<?php
App::uses('AppAgentController', 'Controller');
App::uses( 'CakeEmail', 'Network/Email');
/**
* クライアントアカウント画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class ClientController extends AppAgentController {

    // ページングセットアップ
    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'User.id' => 'asc'
        ),
    );

    public $_user_id;

    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();

        // listsメソッドを、listとして扱う
        if ($this->action == "list") {
            $this->action = "lists";
        }

        // POST チェックは行わない
        $this->Security->validatePost = false;
        // $this->Security->csrfCheck = false;

        // ブラックホールコールバック指定
        $this->Security->blackHoleCallback = 'blackhole';
    }

    /**
    * リスト表示
    * @access  public
    */
    public function lists() {
        $this->layout = 'agent/default';
        $this->loadModel('UserRelation');
        $this->Paginator->settings = $this->paginate;
        $users = $this->paginate('UserRelation', array('parent_id =' =>  AuthComponent::user('id')));

        $list = array();
        foreach ($users as $key => $user) {
            switch ($user['User']['status']) {
                case USER_STATUS_KARI:
                    $status_disp = '仮登録';
                    break;
                case USER_STATUS_DISABLE:
                    $status_disp = '無効';
                    break;
                case USER_STATUS_DELETE:
                    $status_disp = '削除';
                    break;
                default:
                    $status_disp = '有効';
                    break;
            }
            $user['User']['status_disp'] = $status_disp;

            array_push($list, $user);
        }
        $this->set('list', $list);
        $this->set('flag_name', Configure::read('flag_name'));

        $this->render('list');
    }

    /**
    * 詳細表示
    * @access  public
    * @param number $id
    */
    public function info($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('クライアント情報の取得に失敗しました。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect('list');
        }
        $this->_user_id = $id;

        // クライアント基本情報
        $this->User->id = $id;
        $this->set('userInfo', $this->User->read());

        // クライアント情報
        $this->loadModel('UserDetail');
        $this->set('detailInfo', $this->UserDetail->getInfo($id));

        // 公開状況
        $this->loadModel('ShopStatus');
        $this->set('shopStatus', $this->processingForDisplay($this->ShopStatus->getData($id)));

        // お店情報
        $this->loadModel('Shop');
        $this->set('shopInfo', $this->processingForDisplay($this->Shop->getData($id)));

        // ストア情報
        $this->loadModel('Store');
        $this->set('storeInfo', $this->processingForDisplay($this->Store->getData($id)));

        // 備考欄更新
        if ($this->request->is('post')) {
            if ( ! $this->UserDetail->save($this->request->data)) {
                $this->Session->setFlash(__('備考欄の更新に失敗しました'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('備考欄を更新しました。'), 'default', array('class' => 'alert alert-success'));
            }
        }
        $this->request->data = $this->UserDetail->getInfo($id);
    }

    /**
    * 登録
    * @access  public
    * @param number $id
    */
    public function add() {
        if ($this->request->is('post')) {
            // データベースに追加保存

            $this->request->data['User']['password'] = $this->create_password();

            $this->loadModel('UserLang');
            $data = $this->request->data;
            unset($data['User']);
            $langCnt = 0;
            foreach ($data as $key => $item) {
                $langCnt ++;
            }
            if (empty($langCnt)) {
                $this->set('lang_error', true);
                return;
            }

            $this->loadModel('User');
            $result = $this->User->saveData(AuthComponent::user('id'), $this->request->data);
            if ( ! $result) {
                $this->Session->setFlash(__('クライアントの登録に失敗しました'), 'default', array('class' => 'alert alert-danger'));

            } else {
                // 作成したユーザーIDを取得します。
                $user_id = $this->User->getLastInsertID();

                // 備考欄に追記
                $this->loadModel('UserDetail');
                $detailInfo = $this->UserDetail->getInfo($user_id);
                $detailInfo['UserDetail']['remarks_agent'] = json_encode(array("lang" => $this->request->data['langs']));
                $detailInfo['UserDetail']['remarks_manager'] = json_encode(array("lang" => $this->request->data['langs']));
                $this->UserDetail->save($detailInfo, false);

                // メール送信の準備
                $email = $this->request->data['User']['email'];
                $subject = __('iPost Enterprise運営事務局: 登録完了のお知らせ');
                $login_url = str_replace('agent.', 'admin.', FULL_BASE_URL);

                $body = array(
                    'user_name' => $this->request->data['User']['user_name'],
                    'email'     => $this->request->data['User']['email'],
                    'password'  => $this->request->data['User']['password'],
                    'login_url' => $login_url,
                    'langs'     => $this->request->data['langs'],
                );
                $template = 'client/add';
                if ( ! empty($data['User']['lang'])) {
                    $template = $data['User']['lang'] . DS . 'client/add';
                }
                $this->sendEmail($email, $subject, $template, $body);

                $this->Session->setFlash(__('クライアントを登録しました'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'list'));
            }
        }

        // 対応言語の選択
        $this->set('langOptions', Configure::read('flag_name'));
    }

    /**
    * 編集
    * @access  public
    * @param number $id
    */
    public function edit($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('クライアント情報の取得に失敗しました。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect('list');
        }

        $this->_user_id = $id;
        $this->User->id = $id;

        if ($this->request->is('post')) {
            if ( ! $this->User->save($this->request->data)) {
                $this->Session->setFlash(__('クライアント情報の更新に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('クライアント情報を更新しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'info', $id));
            }
        }

        $this->request->data = $this->User->read();
        $this->set('user', $this->User->read());
    }

    /**
    * 停止
    * @access  public
    * @param number $id
    */
    public function delete($id=null) {
        $this->_user_id = $id;
    }

    /**
    * パスワードを再発行（入力）
    * @access public
    * @param number $id クライアントID
    */
    public function remind($id=null) {
        $this->_user_id = $id;
        $this->User->id = $id;
        $user = $this->User->read();
        if (empty($user)) {
            $this->Session->setFlash(__('クライアント情報の取得に失敗しました。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->set('user', $user);
        $this->set('body', $this->remind_body());
    }
    /**
    * パスワードを再発行（確認）
    * @access public
    * @param number $id クライアントID
    */
    public function remind_confirm($id=null) {
        $this->_user_id = $id;
        $this->User->id = $id;
        $user = $this->User->read();
        if (empty($user)) {
            $this->Session->setFlash(__('クライアント情報の取得に失敗しました。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->set('user', $user);

        if ( ! $this->request->is('post')) {
            $this->redirect(array('action' => 'remind', $id));

        } else {
            $this->set('body', $this->request->data['body']);
        }
    }
    /**
    * パスワードを再発行（完了）
    * @access public
    * @param number $id クライアントID
    */
    public function remind_exe($id=null) {
        $this->_user_id = $id;
        $this->User->id = $id;
        $user = $this->User->read();
        if (empty($user)) {
            $this->Session->setFlash(__('クライアント情報の取得に失敗しました。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->set('user', $user);

        // 再発行の処理
        if ($this->request->is('post')) {

            // DB更新
            $password = $this->create_password();
            $user['User']['password'] = $password;

            $this->User->set($user);
            if ( ! $this->User->save()) {
                $this->Session->setFlash(__('パスワードの再発行に失敗しました。'), 'default', array('class' => 'alert alert-danger'));
                $this->redirect(array('action' => 'remind', $id));
            }

            // メール送信の準備
            $email = $user['User']['email'];
            $subject = __('iPost Enterprise運営事務局：パスワードの再発行のお知らせ');
            $template = 'client/remind';

            // パスワードとか置換処理
            $send_body = $this->request->data['body'];
            $send_body  = str_replace('%%%user_name%%%', $user['User']['user_name'], $send_body);
            $send_body  = str_replace('%%%login_url%%%', str_replace('agent.', 'admin.', FULL_BASE_URL), $send_body);
            $send_body  = str_replace('%%%password%%%',  $password, $send_body);


            $body = array('body' => $send_body);

            $this->sendEmail($email, $subject, $template, $body);
            $this->Session->setFlash(__('パスワードの再発行メールを送信しました。'), 'default', array('class' => 'alert alert-success'));
            $this->redirect(array('action' => 'info', $id));
        }
    }

    /**
    * 対応言語
    * @access public
    * @param number $id
    */
    public function lang($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('クライアント情報の取得に失敗しました。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect('list');
        }
        $this->_user_id = $id;

        $this->loadModel('UserLang');
        $langInfo = $this->UserLang->getList($id);
        if ($this->request->is('post')) {
            $selectLangs = $this->request->data['langs'];

            if (empty($selectLangs)) {
                $this->set('lang_error', true);
                return;
            }

            if ( ! empty($langInfo)) {
                // 登録されているのを一旦削除
                $param = array('user_id' => $id);
                $this->UserLang->deleteAll($param);
            }

            foreach ((array)$selectLangs as $key => $lang) {
                $this->UserLang->create();
                $setItem = array(
                    'user_id' => $id,
                    'lang' => $lang,
                );
                $this->UserLang->save($setItem);
            }
            $this->Session->setFlash(__('選択言語を更新しました。'), 'default', array('class' => 'alert alert-success'));
            $this->redirect(array('action' => 'info', $id));
        }

        for ($i=0; $i<4; $i++) {
            switch ($langInfo[$i]['UserLang']['lang']) {
                case 'ja':
                    $langList[0] = 'checked';
                    break;
                case 'en':
                    $langList[1] = 'checked';
                    break;
                case 'zh':
                    $langList[2] = 'checked';
                    break;
                case 'vi':
                    $langList[3] = 'checked';
                    break;
                default:
                    $langList[$i] = '';
                    break;
            }
        }
        $this->set('langList', $langList);
    }

    /**
     * 表示用に加工制御するメソッド.
     *
     * @param $displayData 画面に出力するデータ群 ( JSON-ENCデータ )
     * @return string 加工した画面に出力するデータ群 ( JSON-ENC データ )
     */
    protected function processingForDisplay($displayData) {
        // JSONデータをデコード処理
        $decodeData = json_decode($displayData);

        // 都道府県にIDが入っていたら表示用に加工
        if ( ! empty($decodeData->profile->pref)) {
            $prefList = Configure::read('PrefList');
            $decodeData->profile->pref_disp = $prefList[$decodeData->profile->pref];
        }

        // ショップステータスの値を表示用に加工
        if ( ! empty($decodeData->status)) {
            $prefList = Configure::read('ShopStatusInfo');
            $decodeData->status_disp = $prefList[$decodeData->status];
        }

        return json_encode($decodeData);
    }

    /**
     * ブラックホールコールバック
     */
    public function blackhole($type) {
        switch ($type) {
            case 'csrf':
                $this->Session->setFlash(__('不正な送信が行われました'), 'default', array('class' => 'alert alert-danger'));
                $this->redirect(array('action' => $this->action, $this->_user_id));
                break;
            default:
                $this->redirect(array('action' => $this->action, $this->_user_id));
                break;
        }
    }

    /**
    * パスワード生成
    */
    private function create_password($length = 8) {
        return substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, $length);
    }

    /**
    * 文言
    */
    private function remind_body() {
        return $body = <<< EOF
%%%user_name%%%  様

いつもお世話になっております。
iPost運営事務局でございます。

パスワードを再発行を再発行いたしましたので、下記のユーザーID/パスワードにてログインしてください。

■iPost Enterprise管理画面情報 --------
iPost Enterprise管理画面URL：%%%login_url%%%

パスワード: %%%password%%%

-------------------------

※お忘れになりませんよう、ご注意ください。
※ご不明な点がございましたら下記のiPost Enterprise運営事務局までお気軽お尋ねください。

-------------------------
 iPost Enterprise運営事務局
 support3@hiropro.co.jp
EOF;
    }

}
