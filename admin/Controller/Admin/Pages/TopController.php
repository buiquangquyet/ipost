<?php

/**
* トップ画面のコントローラです。
* ログイン後の一番トップの画面となります。以下の機能を提供します。
*/

App::uses('AppAdminController', 'Controller');

class TopController extends AppAdminController {

	/**
	* 前処理
	*/
	public function beforeFilter() {
		parent::beforeFilter();

		$this->isSmartphone = $this->_isSmartphone();

		if ($this->isSmartphone){
			$this->theme = 'Smartphone';
		}

		$this->Security->validatePost = false;
	}

	/**
	* トップ画面表示
	*/
	public function index() {

		// TODO:後で治す！！
		// 簡易スマホ対応
		if($this->theme =='Smartphone'){

			$this->layout = "";
			$this->render('sp/index');
		}

	}

	public function _isSmartphone() {
		return ($this->_isIphone() || $this->_isAndroid());
	}


	public function _isIphone() {
		return (stripos(env('HTTP_USER_AGENT'),'iPhone') !== FALSE);
	}


	public function _isAndroid() {
		return (stripos(env('HTTP_USER_AGENT'),'Android') !== FALSE);
	}
}