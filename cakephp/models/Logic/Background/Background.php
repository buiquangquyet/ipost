<?php

App::uses('BasicInfoLogic', 'Model');

/**
* ヘッダ情報のロジックを記述するモデルです。
* DB接続は行わないです。
*/

App::uses('AppModel', 'Model');

class Background extends BasicInfoLogic {
	protected $infoName = 'background_info';

	public function deleteImage($userId) {
		$backgroundInfo = $this->getData($userId);
		$backgroundInfo = json_decode($backgroundInfo, true);

		$backgroundInfo['background']['image'] = '';
		$this->saveData($userId, $backgroundInfo);
	}

	/**
	* 保存する設定を設定
	*/
	protected function formatEachLogic($info, $data) {
		return json_encode($data);
	}

	/**
	* 対象のプレビューデータを取得します。
	*/
	public function getPreviewData($userId) {

		$data = json_decode($this->getData($userId), true);		
		return $data;
	}
}