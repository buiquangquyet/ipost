<?php

App::uses('BasicInfoLogic', 'Model');

/**
* 申請情報のロジックを記述するモデルです。
* DB接続は行わないです。
*/

class ApplyKeyword extends BasicInfoLogic {


	protected $infoName = 'apply_info';


	protected function formatEachLogic($info, $data) {

		$info = json_decode($info, true);
		$info['keyword'] = $data['keyword'];
		return json_encode($info);

	}

}