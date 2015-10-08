<?php
App::uses('AppManagerController', 'Controller');
App::uses( 'CakeEmail', 'Network/Email');
/**
* マスターユーザ画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class ManagerController extends AppManagerController {

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

        // ブラックホールコールバック指定
        $this->Security->blackHoleCallback = 'blackhole';
    }

    /**
    * リスト表示
    * @access  public
    */
    public function lists() {
        $users = $this->paginate('User', array('type =' =>  USER_TYPE_NONE));
        $list = array();
        foreach ($users as $user) {
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
    public function info($id=null) {
        // マスター基本情報
        $this->User->id = $id;
        $this->set('userInfo', $this->User->read());
    }

    /**
    * 登録
    * @access  public
    * @param number $id
    */
    public function add() {
        $this->set('userId', AuthComponent::user('id'));

        if ($this->request->is('post')) {
            // データベースに追加保存
            $result = $this->User->saveData(null, $this->request->data);
            if ( ! $result) {
                $this->Session->setFlash(__('マスターの登録に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('マスターを登録しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'list'));
            }
        }
    }

    /**
    * 編集
    * @access  public
    * @param number $id
    */
    public function edit_info($id = null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('マスターIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->User->id = $id;
        $this->request->data = $this->User->read();
        $this->set('userInfo', $this->User->read());

        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
    }

    /**
    * 編集
    * @access  public
    * @param number $id
    */
    public function edit_detail($id = null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('マスターIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->User->id = $id;
        $this->request->data = $this->User->read();
        $this->set('userInfo', $this->User->read());

        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
    }

    /**
    * 停止
    * @access  public
    * @param number $id
    */
    public function delete($id = null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('マスターIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->User->id = $id;

        if ( ! $this->request->is('get')) {
            if ( ! $this->User->save($this->request->data)) {
                $this->Session->setFlash(__('マスター情報の削除に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('マスター情報を削除しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'list'));
            }
        }

        $userInfo = $this->User->read();
        $this->request->data = $userInfo;
        $this->set('userInfo', $userInfo);
    }

    /**
    * 許可・却下
    */
    public function permit($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('マスターIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->User->id = $id;

        if ( ! $this->request->is('get')) {
            if ( ! $this->User->save($this->request->data)) {
                $this->Session->setFlash(__('マスター発行依頼の更新に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('マスター発行依頼を更新しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'list'));
            }
        }

        // ユーザー情報の取得
        $userInfo = $this->User->read();
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
                $this->Session->setFlash(__('不正な送信が行われました。'), 'default', array('class' => 'alert alert-danger'));
                $this->redirect(array('controller' => 'manager', 'action' => $this->action));
                break;
            default:
                $this->redirect(array('controller' => 'manager', 'action' => 'add'));
                break;
        }
    }

}
