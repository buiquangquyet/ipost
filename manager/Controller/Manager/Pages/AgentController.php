<?php
App::uses('AppManagerController', 'Controller');
/**
* 代理店情報画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class AgentController extends AppManagerController {

    // ページングセットアップ
    public $paginate = array(
        'UserRelation' => array(
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
        $users = $this->paginate('User', array('type =' =>  USER_TYPE_OYA));
        $list = array();
        foreach ($users as $user) {
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
        $this->set('users', $list);
        $this->render('list');
    }

    /**
    * 詳細表示
    * @access  public
    */
    public function info($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('代理店IDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        // 代理店情報の取得
        $this->User->id = $id;
        $userInfo = $this->User->read();
        $this->set('userInfo', $this->User->read());

        // 代理店の詳細情報の取得
        $this->loadModel('UserDetail');
        $list = $this->UserDetail->getInfo($id);
        $userDetail = array();
        foreach ($list as $key => $value) {
            if (array_key_exists('pref', $value)) {
                $value['pref_disp'] = '';
                if ($value['pref'] != 0) {
                    $prefList = Configure::read('PrefList');
                    $value['pref_disp'] = $prefList[$value['pref']];
                }
            }
            array_push($userDetail, $value);
        }
        $this->set('userDetail', $userDetail[0]);

        // 所属しているユーザーリストの取得
        $this->loadModel('UserRelation');
        $users = $this->paginate('UserRelation', array('parent_id =' =>  $id));

        // 必要な情報の修得
        $this->loadModel('InspectRequest');
        $this->loadModel('Shop');

        $list = array();
        foreach ($users as $key => $value) {
            // お店の情報
            $shop = $this->processingForDisplay($this->Shop->getData($id));

            // 状態
            $inspect = $this->InspectRequest->getInfo($value['User']['id']);
            $item = array();
            if (count($inspect) < 1) {
                $inspect[0]['InspectRequest']['status'] = '';
                $inspect[0]['InspectRequest']['status_disp'] = '未申請';

            } else {
                $config = Configure::read('InspectStatusInfo');
                $inspect[0]['InspectRequest']['status_disp'] = $config[$inspect[0]['InspectRequest']['status']];
            }

            $value['InspectRequest'] = $inspect[0]['InspectRequest'];
            $value['Shop'] = json_decode($shop, true);

            array_push($list, $value);
        }

        $this->set('users', $list);
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
                $this->Session->setFlash(__('代理店の登録に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                // $this->sendEmail($this->request->data);
                $this->Session->setFlash(__('代理店を登録しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'list'));
            }
        }
    }

    /**
    * 基本情報の編集
    * @access  public
    */
    public function edit_info($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('代理店IDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->User->id = $id;
        $userInfo = $this->User->read();

        if ($this->request->is('get')) {
            $this->request->data = $userInfo;

        } else {
            // 更新処理
            if ( ! $this->User->save($this->request->data)) {
                $this->Session->setFlash(__('基本情報の更新に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('基本情報を更新しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'info', $id));
            }
        }

        $this->set('userInfo', $userInfo);
    }

    /**
    * 基本情報の編集
    * @access  public
    */
    public function edit_detail($id=null) {
        if (is_null($id)) {
            if ( ! is_null($id)) break;
            $this->Session->setFlash(__('代理店IDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->loadModel('UserDetail');

        $userDetail = $this->UserDetail->getInfo($id);
        if ($this->request->is('get')) {
            $this->request->data = $userDetail;

        } else {
            // 更新処理
            $result = $this->UserDetail->saveData($id, $this->request->data);

            if ( ! $result) {
                $this->Session->setFlash(__('会社情報の更新に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('会社情報を更新しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'info', $id));
            }
        }

        $this->set('userDetail', $userDetail);
    }

    /**
    * 削除
    * @access  public
    */
    public function delete($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('代理店IDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->User->id = $id;

        if ( ! $this->request->is('get')) {
            if ( ! $this->User->save($this->request->data)) {
                $this->Session->setFlash(__('代理店情報の削除に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('代理店情報を削除しました。'), 'default', array('class' => 'alert alert-success'));
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
        if (! empty($decodeData->profile->pref)) {
            $prefList = Configure::read('PrefList');
            $decodeData->profile->pref_disp = $prefList[$decodeData->profile->pref];
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
                $this->redirect(array('action' => $this->action));
                break;
            default:
                $this->redirect(array('action' => 'add'));
                break;
        }
    }

}
