<?php

App::uses('AppAdminController', 'Controller');

/**
 * ヘッダー設定画面コントローラ.
 */
class CouponController extends AppAdminController {

    //　ヘルパー読み込み
    public $helpers = array('Coupon');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Security->validatePost = false;
    }

    /**
     * 画面表示.
     */
    public function index() {
        $jsonData = $this->Coupon->getData(AuthComponent::user('id'));
        $this->request->data = array('Coupon' => $jsonData);
        $this->set('couponInfo', $jsonData);
    }

    public function delete() {

        // バリデーションを外して保存
        $this->loadModel('Coupon');
        $this->Coupon->deleteData(AuthComponent::user('id'), $this->request->query['id']);
        $this->redirect('index');
    }

    public function regist() {
        try {
            $this->loadModel('Ajax');
            $this->loadModel('Coupon');

            $couponInfo = $this->Coupon->getData(AuthComponent::user('id'));

            foreach($this->request->data as $key => $data) {
                $data[$this->request->data['Coupon']['pos']]['pos'] = $this->request->data['Coupon']['pos'];

                // クーポン情報を整形します。
                if ($key == 'Coupon') {
                    foreach ($data as $k => $value) {
                        if (is_array($data[$k])) {
                            if ( ! array_key_exists('hash', $couponInfo[$k])) {
                                // hash なかった
                                $data[$k]['hash'] = time();

                            } else {
                                // hash あった
                                if (empty($data[$k]['hash'])) {
                                    // hash 空っぽ
                                    $data[$k]['hash'] = time();

                                } else {
                                    // hash 空っぽじゃない
                                }
                            }
                        }
                    } // foreach end
                }

                $result = $this->Ajax->dispatchSaveData(AuthComponent::user('id'), array($key => $data[$this->request->data['Coupon']['pos']]));

            }
            $this->redirect('index');

        } catch(ValidateException $e) {

            // バリデーション失敗
            $this->index();
            $this->render('index');
        }
    }
}