<?php
App::uses('AppAgentController', 'Controller');
/**
* 統計表示画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class StatisticsController extends AppAgentController {

    // ページングセットアップ
    public $paginate = array(
        'UserRelation' => array(
            'limit' => 10,
            'order' => array(
                'UserRelation.id' => 'asc'
            ),
        ),
    );

    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();

        $this->loadModel('UserRelation');
        $this->loadModel('Device');
    }

    /**
    * トップ画面表示
    * @access  public
    */
    public function index() {
    }

    /**
    * アプリ公開数
    * @access  public
    */
    public function appli() {
        // ダウンロード数（仮
        $userList = $this->UserRelation->getUserList(AuthComponent::user('id'));
        $deviceCnt = 0;
        foreach ((array)$userList as $key => $user) {
            $deviceList = $this->Device->getTokenList($user['User']['id'], null, array(Device::ALLOW_FLG_OFF,Device::ALLOW_FLG_ON));
            $deviceCnt += count($deviceList);
        }
        $this->set('deviceCnt', $deviceCnt);

        // 公開数（仮
        $this->loadModel('InspectRequest');
        $publishCnt = 0;
        foreach ((array)$userList as $key => $user) {
            $irInfo = $this->InspectRequest->getInfo($user['User']['id'], 9);
            $publishCnt += count($irInfo);
        }
        $this->set('publishCnt', $publishCnt);
    }

    /**
    * アプリダウンロード数
    * @access  public
    */
    public function download() {
        $userList = $this->paginate('UserRelation', array('parent_id =' =>  AuthComponent::user('id')));

        $this->loadModel('Store');

        $list = array();
        foreach ((array)$userList as $key => $user) {
            $item = array();
            $item = $user;

            $deviceList = $this->Device->getTokenList($user['User']['id']);
            $item['count'] = count($deviceList);

            $storeInfo = $this->Store->getData($user['User']['id']);
            $storeInfo = json_decode($storeInfo, true);
            $item['app_name'] = $storeInfo['text']['app_name'] ? $storeInfo['text']['app_name'] : __('未設定');

            array_push($list, $item);
        }
        $this->set('list', $list);
    }

}
