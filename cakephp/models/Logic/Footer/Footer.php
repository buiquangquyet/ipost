<?php

App::uses('BasicInfoLogic', 'Model');

class Footer extends BasicInfoLogic {
	protected $infoName = 'footer_info';

	/**
	* プレビュー用のデータを取得します。
	*/
	public function getPreviewData($id) {
		
		// データの取得
		$data = json_decode($this->getData($id), true);

		// マスターとぶつける。
		$iconList = Configure::read('DescriptionWithIconList');
		$returnList = array();
		foreach($data as $key => $value) {
			if ($value['icon'] !== '') {
				$value['icon'] = $iconList[$value['icon']]['icon'];
				$returnList[] = $value;
			}
		}
		
		return $returnList;

	}

	/**
	 * 各ロジックごとにデータを整形する場合には、オーバーライドしてください。
	 * 
	 * @param 
	 */
	protected function formatEachLogic($info, $datas) {

		foreach ($datas as &$data) {
			if (empty($data['type'])) {
				$data['icon'] = '';
			} elseif (! preg_match("/^[0-9]+$/", $data['icon'])) {
				$data['type'] = '';
				$data['icon'] = '';
			}
		}

		return json_encode($datas);
	}
}
