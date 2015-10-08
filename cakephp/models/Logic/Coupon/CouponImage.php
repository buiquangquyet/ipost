<?php

App::uses('ImageLogic', 'Model');

class CouponImage extends ImageLogic {
    protected $infoName = 'coupon_info';

    protected function formatEachLogic($info, $data) {
    	
    	if(empty($data['Image']['image_id'])) {
    		return $info;
    	}

    	$info = json_decode($info, true);
    	$info[$data['orgParams']['pos']]['image'] = $data['Image']['image_id'];
    	return json_encode($info);
    }
}
