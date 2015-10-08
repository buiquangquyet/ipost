<?php

App::uses('BasicInfoLogic', 'Model');

/**
* 申請情報のロジックを記述するモデルです。
* DB接続は行わないです。
*/

class Apply extends BasicInfoLogic {


	protected $infoName = 'apply_info';

	/**
	* プレビューの情報を取得します。
	*/
	public function getPreviewData($userId) {
		$data = json_decode($this->getData($userId), true);
		return $data;
	}

	protected function formatEachLogic($info, $data) {
		return json_encode($data);
	}

	/**
	* イメージの削除
	*/
	public function deleteImage($userId, $type, $target) {

		// 情報を取得する。
		$data = json_decode($this->getData($userId), true);

		$data[$type][$target] = '';

		// 保存
		$this->saveData($userId, $data);
	}

}