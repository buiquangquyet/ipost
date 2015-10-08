<?php

App::uses('BasicInfoLogic', 'Model');

/**
* サイドメニュー情報のロジックを記述するモデルです。
*/

App::uses('AppModel', 'Model');

class Sidemenu extends BasicInfoLogic {
	protected $infoName = 'sidemenu_info';
	protected $baseModel = 'Sidemenu';

	/**
	 * プレビュー用のデータを取得します。
	 */
	public function getPreviewData($id) {
		$data = $this->getData($id);

		//　enableの値が1のやつだけにする
		$returnData = array();
		foreach($data as $key => $value) {
			if ($value['enable'] == 1) {
				$returnData[$key] = $value;
			}
		}

		return $returnData;
	}

	public function getData($id) {
		$basicInfo = parent::getData($id);
		$basicInfo = json_decode($basicInfo, true);
		return $basicInfo;
	}

	public function getDataApi($id, $lang) {
		$basicInfo = parent::getDataApi($id, $lang);
		$basicInfo = json_decode($basicInfo, true);
		return $basicInfo;
	}

	/**
	 * 登録スル。
	 */
	public function regist($userId, $params) {

		// 保存する内容の種類を分離
		$key = key($params['Sidemenu']);

		// 情報取得
		$data = $this->getData($userId);

		// マージ
		$key = key($params['Sidemenu']);
		$data[$key] = array_merge($data[$key], $params['Sidemenu'][$key]);

		$this->saveData($userId, $data);
	}

	/**
	 * 表示・非表示の切り替え
	 */
	public function enable($userId, $params) {

		// 情報を取得する。
		$data = $this->getData($userId);

		$key = key($params['Sidemenu']);
		$data[$key]['enable'] = $params['Sidemenu'][$key]['enable'];

		// 保存
		$this->saveData($userId, $data);
	}

	/**
	 * 位置情報変更
	 */
	public function movePos($userId, $target, $type) {

		// 情報を取得する。
		$data = $this->getData($userId);

		// キーの一覧を取得
		$keys = array_keys($data);

		// 位置情報。見つからなかったら何もしないで戻る
		$pos = array_search($target, $keys);

		if ($pos === FALSE) {
			return;
		}

		// 並び替え
		if ($type == 'forward') {
			// 対象を一つ前へ移動。いちばん先頭を移動しようとしたら、そのまま戻る。
			if ($pos-1 < 0) {
				return;
			}

			array_splice($keys, $pos-1, 0, $keys[$pos]);
			unset($keys[$pos + 1]);

		} else if($type == 'backword'){

			// 対象を1つ後ろへ移動
			if ($pos+1 >= count($keys)) {
				return;
			}

			array_splice($keys, $pos+2, 0, $keys[$pos]);
			unset($keys[$pos]);

		}

		// データの入れ替え
		$updateData = array();
		foreach($keys as $key) {
			$updateData[$key] = $data[$key];
		}

		// 保存
		$this->saveData($userId, $updateData);
	}

		/**
		 * 各ロジックごとにデータを整形する場合には、オーバーライドしてください。
		 *
		 * @param
		 */
		protected function formatEachLogic($info, $data) {
			return json_encode($data);
		}
}