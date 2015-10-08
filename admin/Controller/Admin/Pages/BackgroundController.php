<?php

App::uses('AppAdminController', 'Controller');

/**
 * 背景設定画面コントローラ.
 */
class BackgroundController extends AppAdminController {

	/**
	 * 画面表示.
	 */
	public function index() {
		$this->set('backgroundInfo', $this->Background->getData(AuthComponent::user('id')));
	}

	/**
	* イメージを削除する。 
	*/
	public function deleteImage() {
		$this->Background->deleteImage(AuthComponent::user('id'));
		$this->redirect('index');
	}
}