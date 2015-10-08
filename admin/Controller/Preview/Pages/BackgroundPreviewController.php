<?php

App::uses('AppPreviewController', 'Controller');

class BackgroundPreviewController extends AppPreviewController {

	/**
	 * 画面表示.
	 */
	public function index() {

		$this->loadModel('Block');
		$jsonData = $this->Block->getPreviewData($this->userId);
		$this->set('Block', $jsonData);
	}
}