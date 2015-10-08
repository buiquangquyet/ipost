<?php

App::uses('AppAdminController', 'Controller');

/**
 * フッダー設定画面コントローラー.
 */
class FooterController extends AppAdminController {

	/**
	 * 画面表示.
	 */
	public function index() {
		$this->set('footerInfo', $this->Footer->getData(AuthComponent::user('id')));
	}
}
