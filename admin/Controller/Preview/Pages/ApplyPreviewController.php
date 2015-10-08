<?php

App::uses('AppPreviewController', 'Controller');

class ApplyPreviewController extends AppPreviewController {

	/**
	 * 画面表示.
	 */
	public function index() {

		$this->layout = 'admin/previewstore';

		$this->loadModel('Apply');
		$jsonData = $this->Apply->getPreviewData($this->userId);
		$this->set('Apply', $jsonData);
		
	}
}