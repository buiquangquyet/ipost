<?php

/**
 *  スプラッシュ設定画面コントローラ.
 */
App::uses('AppAdminController', 'Controller');

class WebController extends AppAdminController {

	/**
	 * 画面表示
	 */
	public function index() {
		$this->set('webInfo', $this->Web->getData(AuthComponent::user('id')));
	}
}