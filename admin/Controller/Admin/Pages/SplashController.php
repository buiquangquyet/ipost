<?php

/**
 *  スプラッシュ設定画面コントローラ.
 */
App::uses('AppAdminController', 'Controller');

class SplashController extends AppAdminController {

	/**
	 * 画面表示
	 */
	public function index() {
		$this->set('splashInfo', $this->Splash->getData(AuthComponent::user('id')));
	}
}