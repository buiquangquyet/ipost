<?php
App::uses('AppApiController', 'Controller');
/**
* クーポンAPIのコントローラです。
* @author    Yoshitaka Kitagawa
*/
class CouponController extends AppApiController {

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
        $this->loadModel('BasicInfo');
        $coupon = array();
        $couponInfo = $this->Coupon->getData($this->user_id);
        $basicInfo = $this->BasicInfo->getInfo($this->user_id, $this->Coupon->getInfoName());
        $modified = '';
        $created  = '';
        if ( ! empty($this->_basicInfo)) {
            $modified = $basicInfo['BasicInfo']['modified'];
            $created  = $basicInfo['BasicInfo']['created'];
        }
        $position = 1;
        foreach ($couponInfo as $key => $info) {
            if (empty($info['enable_flg'])) {
                continue;
            }
            $start_datetime = '';
            $end_datetime = '';
            if ( ! empty($info['start_datetime'])) {
                $start_datetime = date('Y / m / d', strtotime($info['start_datetime']));
            }
            if ( ! empty($info['start_datetime'])) {
                $end_datetime = date('Y / m / d', strtotime($info['end_datetime']));
            }

            $image_url = '';
            if ( ! empty($info['image'])) {
                $image_url = $this->getImageUrl($info['image']);
            }

            $coupon[] = array(
                //'user_id' => $this->user_id,
                'id' => (string)$info['hash'], // Hss add Id
                'title' => $info['title'],
                'discount' => $info['discount'],
                'discount_type' => '',
                'policy' => $info['policy'],
                'image' => $info['image'],
                //'image_url' => $image_url,
                //'tmp_file_name' => '',
                //'use_count' => '0',
                'position' => $position,
                'coupon_type' => $info['coupon_type'],
                'display_days' => $info['display_days'],
                'enable_flg' => $info['enable_flg'],
                'term_flg' => $info['term_flg'],
                'start_datetime' => $start_datetime,
                'end_datetime' => $end_datetime,
                //'modified' => $modified,
                //'created' => $created,
            );
            $position ++;
        }
        if (empty($coupon)) {
            return;
        }
        $this->response->body(json_encode($coupon));
        return;
    }

}
