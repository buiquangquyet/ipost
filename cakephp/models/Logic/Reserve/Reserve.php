<?php

App::uses('BasicInfoLogic', 'Model');

/**
* ブロック情報のロジックを記述するモデルです。
*/

class Reserve extends BasicInfoLogic {

	protected $infoName = 'reserve_info';


	/**
	 * 各ロジックごとにデータを整形する場合には、オーバーライドしてください。
	 *
	 * @param
	 */
	protected function formatEachLogic($info, $data) {

		$info = json_decode($info, true);
		$info = array_merge($info, $data);
		
		return json_encode($info);
	}
	
}