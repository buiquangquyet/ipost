<?php

App::uses('MediaLogic', 'Model');

class HeaderImage extends MediaLogic {
	protected $infoName  = 'header_info';
	protected $mediaName = 'header_image';

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
		$info->header->image = $data['Media']['id'];
		return json_encode($info);
	}
}
