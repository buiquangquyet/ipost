<?php

App::uses('MediaLogic', 'Model');

class SplashMovie extends MediaLogic {
	protected $infoName = 'splash_info';
	protected $mediaName = 'splash_movie';

	var $validate = array(
		'name' => array(
			'rule'    => array('notEmpty'),
			'message' => '動画が選択されていません',
		),
	);

	protected function formatEachLogic($info, $data) {
    	if(empty($data['Media']['id'])) {
    		return $info;
    	}
		
		$info = json_decode($info);
		$info->splash->movie = $data['Media']['id'];
		return json_encode($info);
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	protected function extractionMediaData($data) {
		return $data['movie'];
	}
}
