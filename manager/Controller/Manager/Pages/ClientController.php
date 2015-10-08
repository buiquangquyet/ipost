<?php
App::uses('AppManagerController', 'Controller');
/**
* クライアントアカウント画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class ClientController extends AppManagerController {

    // ページングセットアップ
    public $paginate = array(
        'User' => array(
            'limit' => 10,
            'order' => array(
                'User.id' => 'asc'
            ),
        ),
    );

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

        // ユーザーモデルの読み込み
        $this->loadModel('User');

        $this->Security->validatePost = false;

        // ブラックホールコールバック指定
        $this->Security->blackHoleCallback = 'blackhole';
    }

    /**
    * リスト表示
    * @access  public
    */
    public function lists() {
        $users = $this->paginate('User', array('type =' =>  USER_TYPE_KO));

        // 所属している代理店情報を取得します
        $list = array();
        foreach ($users as $key => $user) {
            $agentInfo = $this->User->getInfo($user['UserRelation'][0]['parent_id'], array(USER_STATUS_KARI, USER_STATUS_ENABLE, USER_STATUS_DISABLE, USER_STATUS_DELETE));
            $user['Agent'] = $agentInfo;

            switch ($user['User']['status']) {
                case USER_STATUS_KARI:
                    $status_disp = __('仮登録');
                    break;
                case USER_STATUS_DISABLE:
                    $status_disp = __('無効');
                    break;
                case USER_STATUS_DELETE:
                    $status_disp = __('削除');
                    break;
                default:
                    $status_disp = __('有効');
                    break;
            }
            $user['User']['status_disp'] = $status_disp;

            array_push($list, $user);
        }

        $this->set('users', $list);
        $this->render('list');
    }

    /**
    * 詳細表示
    * @access  public
    * @param number $id
    */
    public function info($id) {
        if (empty($id)) {
            $this->Session->setFlash(__('クライアントIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        // クライアント基本情報
        $this->User->id = $id;
        $userInfo = $this->User->read();
        $this->set('userInfo', $userInfo);

        // 公開状況
        $this->loadModel('ShopStatus');
        $this->set('shopStatus', $this->processingForDisplay($this->ShopStatus->getData($id)));

        // お店情報
        $this->loadModel('Shop');
        $this->set('shopInfo', $this->processingForDisplay($this->Shop->getData($id)));

        // ストア情報
        $this->loadModel('Store');
        $this->set('storeInfo', $this->processingForDisplay($this->Store->getData($id)));

        // 所属代理店基本情報
        $agentInfo = $this->User->getInfo($userInfo['UserRelation'][0]['parent_id'], array(USER_STATUS_KARI, USER_STATUS_ENABLE, USER_STATUS_DISABLE, USER_STATUS_DELETE));
        $this->set('agentInfo', $agentInfo[0]);

        // 対応言語
        $this->loadModel('UserLang');
        $this->set('langInfo', $this->UserLang->getList($id));

        // 備考欄の更新
        $this->loadModel('UserDetail');
        $userDetail = $this->UserDetail->getInfo($id);
        $this->UserDetail->id = $userDetail['UserDetail']['id'];
        $userDetail = $this->UserDetail->read();

        if ($this->request->is('get')) {
            $this->request->data = $userDetail;

        } else {
            unset($this->UserDetail->validate['pref']);
            if ( ! $this->UserDetail->save($this->request->data)) {
                $this->Session->setFlash(__('備考欄の更新に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('備考欄を更新しました。'), 'default', array('class' => 'alert alert-success'));
            }
        }
    }

    /**
    * 登録
    * @access  public
    * @param number $id
    */
    public function add() {
        $this->set('userId', AuthComponent::user('id'));
        $this->set('parentList', $this->User->getOptionsArray(USER_TYPE_OYA));

        if ($this->request->is('post')) {
            // データベースに追加保存
            $parent_id = $this->request->data['UserRelation']['parent_id'];
            $result = $this->User->saveData($parent_id, $this->request->data);
            if ( ! $result) {
                $this->Session->setFlash(__('クライアントの登録に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                // メール送信
                $email = $this->request->data['User']['email'];
                $subject = __('【iPost運営事務局】アプリ簡易審査結果のお知らせ');
                $login_url = str_replace('agent.', 'admin.', FULL_BASE_URL);
                $template = 'client/add';
                if ( ! empty($this->request->data['User']['lang'])) {
                    $template = $this->request->data['User']['lang'] . DS . 'client/add';
                }
                $body = array (
                    'login_url' => $login_url,
                    'email' => $this->request->data['User']['email'],
                    'user_name' => $this->request->data['User']['user_name'],
                    'password' => $this->request->data['User']['password'],
                );
                $this->sendEmail($email, $subject, $template, $body);

                $this->Session->setFlash(__('クライアントを登録しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'list'));
            }
        }
    }

    /**
    * 編集
    * @access  public
    * @param number $id
    */
    public function edit($id) {
        if (empty($id)) {
            $this->Session->setFlash(__('クライアントIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->User->id = $id;

        if ($this->request->is('post')) {
            if ( ! $this->User->save($this->request->data)) {
                $this->Session->setFlash(__('基本情報の更新に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('基本情報を更新しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'info', $id));
            }
        }

        // ユーザー情報の取得
        $this->request->data = $this->User->read();
        $this->set('id', $id);
    }

    /**
    * 対応言語
    * @access  public
    * @param number $id
    */
    public function lang($id) {
        if (empty($id)) {
            $this->Session->setFlash(__('クライアントIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->loadModel('UserLang');

        if ($this->request->is('post')) {
            $this->loadModel('UserLang');
            $this->UserLang->saveData($id, $this->request->data);

            $this->Session->setFlash(__('対応言語を更新しました。'), 'default', array('class' => 'alert alert-success'));
            $this->redirect(array('action' => 'info', $id));
        }

        $list = $this->UserLang->getList($id);
        $this->request->data = $this->UserLang->getListFormat($list);

        $this->set('id',$id);
    }

    /**
    * 停止
    * @access  public
    * @param number $id
    */
    public function delete($id) {
        if (empty($id)) {
            $this->Session->setFlash(__('クライアントIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->User->id = $id;

        if ($this->request->is('post')) {
            if ( ! $this->User->save($this->request->data)) {
                $this->Session->setFlash(__('クライアント情報の削除に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('クライアント情報を削除しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'list'));
            }
        }

        $userInfo = $this->User->read();
        $this->request->data = $userInfo;
        $this->set('userInfo', $userInfo);
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
        // if ( ! empty($decodeData->profile->pref)) {
        //     $prefList = Configure::read('PrefList');
        //     $decodeData->profile->pref_disp = $prefList[$decodeData->profile->pref];
        // }

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
                $this->Session->setFlash(__('不正な送信が行われました。'), 'default', array('class' => 'alert alert-danger'));
                $this->redirect(array('controller' => 'client', 'action' => 'list'));
                break;
            default:
                $this->redirect(array('controller' => 'client', 'action' => 'list'));
                break;
        }
    }

}
