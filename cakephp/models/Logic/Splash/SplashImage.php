<?php

App::uses('MediaLogic', 'Model');

class SplashImage extends MediaLogic {
	protected $infoName = 'splash_info';
	protected $mediaName = 'splash_image';

	var $validate = array(
		'name' => array(
			'rule'    => array('notEmpty'),
			'message' => '画像が選択されていません',
		),
	);

	protected function formatEachLogic($info, $data) {
    	if(empty($data['Media']['id'])) {
    		return $info;
    	}
		
		$info = json_decode($info);
		$info->splash->image = $data['Media']['id'];
		return json_encode($info);
	}
}
