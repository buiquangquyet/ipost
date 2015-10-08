<?php

App::uses('MediaLogic', 'Model');

class BackgroundImage extends MediaLogic {
	protected $infoName = 'background_info';
	protected $mediaName = 'background_image';

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
		$info->background->image = $data['Media']['id'];
		return json_encode($info);
	}
}
