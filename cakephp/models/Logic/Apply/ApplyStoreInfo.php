<?php

App::uses('BasicInfoLogic', 'Model');

/**
* 申請情報のロジックを記述するモデルです。
* DB接続は行わないです。
*/

class ApplyStoreInfo extends BasicInfoLogic {


	protected $infoName = 'apply_info';


	protected function formatEachLogic($info, $data) {

		$info = json_decode($info, true);
		$info['store_info'] = array(
			'app_name' => $data['app_name'],
			'app_disp_name' => $data['app_disp_name'],
			'description' => $data['description'],
		);
		return json_encode($info);

	}

}