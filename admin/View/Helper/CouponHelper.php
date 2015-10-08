<?php

App::uses('AppformName', 'View/Helper');


/**
* クーポン表示用のヘルパー
*/
class CouponHelper extends AppHelper {

	public function getEnableFlg($flg) {

		if ($flg === '') {
			return '';
		}

		// マスター取得
		$masterList = Configure::read('CouponDisp');
		return $masterList[$flg];
	}

	public function getCouponType($type) {

		if ($type === '') {
			return '';
		}

		// マスター取得
		$masterList = Configure::read('ConponTypeList');
		return $masterList[$type];
	}
}