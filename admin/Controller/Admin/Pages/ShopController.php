<?php

App::uses('AppAdminController', 'Controller');

/**
 * 店舗管理画面コントローラー.
 *
 */
class ShopController extends AppAdminController {

	/**
	 * 画面表示.
	 */
	public function profile() {
		$rs = $this->processingForDisplay($this->Shop->getData(AuthComponent::user('id')));
		$this->set('shopInfo', $rs);
		$arr_pref = Configure::read('PrefList');
		$rs = json_decode($rs);
		$prer_index = $rs->profile->pref;
		$pref_old = $prer_index?$arr_pref[$prer_index]:'';
		$this->set('pref_old', $pref_old);
		$this->set('prer_index', $prer_index);
	}

	/**
	 * 表示用に加工制御するメソッド.
	 *
	 * @param $displayData 画面に出力するデータ群 ( JSON-ENCデータ )
	 * @return string 加工した画面に出力するデータ群 ( JSON-ENC データ )
	 */
	protected function processingForDisplay($displayData) {

		// JSONデータをデコード処理
		$decodeData = json_decode($displayData);

		// 都道府県にIDが入っていたら表示用に加工
		if (! empty($decodeData->profile->pref)) {
			$prefList = Configure::read('PrefList');
			$decodeData->profile->pref_disp = $prefList[$decodeData->profile->pref];
		}

		return json_encode($decodeData);
	}
}
