<?php

App::uses('BasicInfoLogic', 'Model');

/**
* 申請情報のロジックを記述するモデルです。
* DB接続は行わないです。
*/

class ApplyCategory extends BasicInfoLogic {


	protected $infoName = 'apply_info';


	protected function formatEachLogic($info, $data) {

		$info = json_decode($info, true);
		$info['store_category_info'] = array(
			'category_iphone1' => $data['category_iphone1'],
			'category_iphone2' => $data['category_iphone2'],
			'category_android' => $data['category_android'],
		);
		return json_encode($info);

	}

}