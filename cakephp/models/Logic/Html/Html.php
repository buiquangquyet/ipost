<?php

App::uses('BasicInfoLogic', 'Model');

/**
* ヘッダ情報のロジックを記述するモデルです。
* DB接続は行わないです。
*/

App::uses('AppModel', 'Model');

class Html extends BasicInfoLogic {
	protected $infoName = 'html_info';

	/**
	* 対象のプレビューデータを取得します。
	*/
	public function getPreviewData($userId) {

		$data = json_decode($this->getData($userId), true);		
		return $data;
	}

	/**
	 * 保存時の情報設定
	 * 
	 * @param 
	 */
	protected function formatEachLogic($info, $datas) {

		// データ置き換え
		$info = json_decode($info, true);

		$key = key($datas);

		// キーがimageの時は削除する。
		if ($key == 'image') {
			$secondKey = key($datas['image']);
			unset($info['image'][$secondKey]);
		} else {
			$info[$key] = $datas[$key];
		}

		return json_encode($info);
	}
}