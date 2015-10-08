<?php

App::uses('MediaLogic', 'Model');

class ShopImage extends MediaLogic {
	protected $infoName  = 'shop_info';
	protected $mediaName = 'shop_image';

	protected function formatEachLogic($info, $data) {
    	if(empty($data['Media']['id'])) {
    		return $info;
    	}
		
		$info = json_decode($info);
		$info->image = $data['Media']['id'];
		return json_encode($info);
	}
}
