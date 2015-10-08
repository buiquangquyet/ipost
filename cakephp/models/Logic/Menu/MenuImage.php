<?php

App::uses('ImageLogic', 'Model');

class MenuImage extends ImageLogic {
	protected $infoName = 'apply_info';

	var $validate = array(
		'name' => array(
			'rule'    => array('notEmpty'),
			'message' => '画像が選択されていません',
		),
	);

	/*
	protected function formatEachLogic($info, $data) {

		$info = json_decode($info, true);
		$info['app_ad_image'] = $data['Image']['image_id'];
		return json_encode($info);

	}
	*/
}
