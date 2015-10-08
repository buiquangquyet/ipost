<?php
App::uses('AppApiController', 'Controller');
/**
* グローバルAPIのコントローラです。
* @author    Yoshitaka Kitagawa
*/
class GlobalController extends AppApiController {

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
        // ステータスの取得します。
        $status = $this->getShopStatus($this->user_id);

        // JSONを整えます。
        $data = $this->processingForDisplay($status);

        $this->response->body(json_encode($data));
        return;
    }

    /**
    * エンタAPI仕様に変更
    */
    protected function processingForDisplay($data) {
        // 有効期限を伸ばします。
        $expired = new DateTime();
        if (! empty($data->expired)) {
            $expired = new DateTime($data->expired);
        }
        $expired->modify('+10 day');

        // 整え
        $array =  array(
            'maintenance' => null,
            'shop_status' => array(
                'user_id' => $this->user_id,
                'status' => $data->status,
                'expired_at'  => $expired->format('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'tracking_id' => '',
            ),
        );
        return array($array);
    }

    /**
    * モデルから情報を取得します。
    */
    private function getShopStatus($id) {
        $this->loadModel('ShopStatus');
        return json_decode($this->ShopStatus->getData($id));
    }

}
