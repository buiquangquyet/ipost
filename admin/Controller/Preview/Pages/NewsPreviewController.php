<?php

App::uses('AppPreviewController', 'Controller');

class NewsPreviewController extends AppPreviewController {

	/**
	 * 画面表示.
	 */
	public function index() {

		// 情報を取得する。
		$this->loadModel('Apply');
		$applyInfo = $this->Apply->getPreviewData($this->userId);
		$this->set('applyInfo', $applyInfo);

		// 情報取得
		$this->loadModel('News');
		$newsList = $this->News->getAllData($this->userId);

		//　セット
		$this->set('newsList', $newsList);
	}
}