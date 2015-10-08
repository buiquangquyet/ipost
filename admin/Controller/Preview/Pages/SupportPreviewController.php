<?php

App::uses('AppPreviewController', 'Controller');

class SupportPreviewController extends AppPreviewController {

	/**
	 * 画面表示.
	 */
	public function manual() {

		// TODO : 仮設定、とりあえずSplashにしておいた
		$this->loadModel('Splash');
		$jsonData = json_decode($this->Splash->getData($this->userId), true);
		$this->set('Splash', $jsonData);

		$this->render('../Pages/SplashPreview/index');
	}
}