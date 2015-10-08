<?php

App::uses('AppAdminController', 'Controller');

/**
 * ヘッダー設定画面コントローラ.
 */
class HeaderController extends AppAdminController {

	/**
	 * 画面表示.
	 */
	public function index() {
		$this->set('headerInfo', $this->Header->getData(AuthComponent::user('id')));
	}
}