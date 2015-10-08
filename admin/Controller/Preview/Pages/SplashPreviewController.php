<?php

App::uses('AppPreviewController', 'Controller');

class SplashPreviewController extends AppPreviewController {

	/**
	 * 画面表示.
	 */
	public function index() {

		$this->loadModel('Splash');
		$jsonData = json_decode($this->Splash->getData($this->userId), true);
		$this->set('Splash', $jsonData);
	}
}