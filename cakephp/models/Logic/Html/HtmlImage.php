<?php

App::uses('ImageLogic', 'Model');

/**
* ヘッダ情報のロジックを記述するモデルです。
* DB接続は行わないです。
*/

App::uses('AppModel', 'Model');

class HtmlImage extends ImageLogic {
	protected $infoName = 'html_info';

	/**
	 * 保存時の情報設定
	 * 
	 * @param 
	 */
	protected function formatEachLogic($info, $datas) {
    	if(empty($datas['Image']['image_id'])) {
    		return $info;
    	}
		
		$info = json_decode($info, true);

		// もしイメージIDが空っぽだったら削除
		$info['image'][] = $datas['Image']['image_id'];

		return json_encode($info);
	}
}