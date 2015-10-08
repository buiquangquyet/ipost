<?php

/**
* サポート画面のコントローラです。
* マニュアルダウンロードの機能を提供します
*/

App::uses('AppAdminController', 'Controller');

class SupportController extends AppAdminController {

	/**
	* 前処理
	*/
	public function beforeFilter() {
		parent::beforeFilter();
	}

	/**
	* トップ画面表示
	*/
	public function manual() {

		$lang = $this->Cookie->read('lang');
		$this->set('lang', $lang);
	}
}