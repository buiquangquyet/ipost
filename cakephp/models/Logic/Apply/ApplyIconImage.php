<?php

App::uses('ImageLogic', 'Model');

class ApplyIconImage extends ImageLogic {
	protected $infoName = 'apply_info';

	var $validate = array(
		'name' => array(
			'rule'    => array('notEmpty'),
			'message' => '画像が選択されていません',
		),
	);

	protected function formatEachLogic($info, $data) {

		if(empty($data['Image']['image_id'])) {
    		return $info;
    	}

		$info = json_decode($info, true);
		$info['app_icon'] = $data['Image']['image_id'];
		return json_encode($info);

	}
}