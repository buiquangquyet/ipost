<?php
App::uses('AppApiController', 'Controller');
/**
* セッティング画面APIのコントローラです。
* @author    Yoshitaka Kitagawa
*/
class SettingController extends AppApiController {

    /**
    * 前処理
    */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
    * トップAPI
    */
    public function index() {
        $token = null;
        if ($this->request->is('post')) {
            $token = $this->request->data['token'];
        }
        $array = array(
            'setting' => $this->getDevice($this->user_id, $token),
            'shopprofile' => $this->getShop($this->user_id),
        );
        $this->response->body(json_encode($array));
        return;
    }

    /**
    * デバイスからallow_flgを操作します。
    */
    public function notification() {
        $token = null;
        $notif = 1;
        if ($this->request->is('post')) {
            $userId = $this->request->data['user_id'];
            $token = $this->request->data['token'];
            $notif = $this->request->data['notif'];

            // DEBUG
            // $userId = $_GET['user_id'];
            // $token = $_GET['token'];
            // $notif = $_GET['notif'];

            $deviceInfo = $this->getDevice($userId, $token);
            if ( ! empty($deviceInfo)) {
                $deviceInfo['Device']['allow_flg'] = $notif;
                if ( ! $this->Device->save($deviceInfo)) {
                    $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' Update Allow FLG Error => ' . $deviceInfo['Device']['id'], LOG_DEBUG);

                } else {
                    $this->response->body('OK');
                    return;
                }
            }
        }
    }

    /**
    * デバイス情報を取得します。
    */
    private function getDevice($id, $token) {
        $this->loadModel('Device');
        $res = null;
        if ( ! empty($this->Device->getInfo($id, $token))) {
            $res = $this->Device->getInfo($id, $token);
        }
        return $res;
    }

    /**
    * 店舗情報を取得します。
    */
    private function getShop($id) {
        $this->loadModel('Shop');
        $this->loadModel('BasicInfo');

        $basicInfo = $this->BasicInfo->getInfo($this->user_id, $this->Shop->getInfoName());
        $modified = '';
        $created  = '';
        if ( ! empty($this->_basicInfo)) {
            $modified = $basicInfo['BasicInfo']['modified'];
            $created  = $basicInfo['BasicInfo']['created'];
        }

        $geocode = array('lat' => '', 'lng' => '');
        $shopInfo = json_decode($this->Shop->getData($this->user_id), true);
        if (array_key_exists('address', $shopInfo['profile'])) {
            $geocode = $this->geocode($shopInfo['profile']['address']);
        }

        $shopInfo = json_decode($this->Shop->getData($id), true);
        $shop = array(
            'user_id' => $id,
            'shop_name' => $shopInfo['profile']['shop_name'],
            'email' => $shopInfo['profile']['email'],
            'tel1' => $shopInfo['profile']['tel1'],
            'tel2' => $shopInfo['profile']['tel2'],
            'tel3' => $shopInfo['profile']['tel3'],
            'fax1' => $shopInfo['profile']['fax1'],
            'fax2' => $shopInfo['profile']['fax2'],
            'fax3' => $shopInfo['profile']['fax3'],
            'zip_code1' => $shopInfo['profile']['zip_code1'],
            'zip_code2' => $shopInfo['profile']['zip_code2'],
            'address' => $shopInfo['profile']['address'],
            'url' => $shopInfo['profile']['url'],
            'online_shop' => $shopInfo['profile']['online_shop'],
            'open_hours' => $shopInfo['profile']['open_hours'],
            'holiday' => $shopInfo['profile']['holiday'],
            'lat' => $geocode['lat'],
            'lng' => $geocode['lng'],
            'remarks' => '',
            'updated_at' => $modified,
            'created_at' => $created,
        );
        return $shop;
    }

}
