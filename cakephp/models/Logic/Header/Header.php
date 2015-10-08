<?php

App::uses('BasicInfoLogic', 'Model');

/**
* ヘッダ情報のロジックを記述するモデルです。
* DB接続は行わないです。
*/

App::uses('AppModel', 'Model');

class Header extends BasicInfoLogic {
	protected $infoName = 'header_info';

	/**
	* 対象のプレビューデータを取得します。
	*/
	public function getPreviewData($userId) {

		$data = json_decode($this->getData($userId), true);		
		return $data;
	}
}