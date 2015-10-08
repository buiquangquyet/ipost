<?php

App::uses('AppPreviewController', 'Controller');

/**
 * 背景設定画面コントローラ.
 */
class TopPreviewController extends AppPreviewController {

	/**
	 * 画面表示.
	 */
	public function index() {
		$this->loadModel('Block');
		$jsonData = $this->Block->getPreviewData($this->userId);
		$this->set('Block', $jsonData);
	}
}