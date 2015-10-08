<?php

App::uses('ImageLogic', 'Model');

class ApplyScreenShot extends ImageLogic {

	protected $infoName = 'apply_info';

	var $validate = array(
		'name' => array(
			'rule'    => array('notEmpty'),
			'message' => '画像が選択されていません',
		),
	);

	protected function formatEachLogic($info, $data) {
		$info = json_decode($info, true);
		$info[$data['orgParams']['image_type']][$data['orgParams']['image_key']] = $data['Image']['image_id'];
		return json_encode($info);

	}
}
