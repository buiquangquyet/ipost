<?php

App::uses('AppPreviewController', 'Controller');

class ReservePreviewController extends AppPreviewController {

	/**
	 * 画面表示.
	 */
	public function index() {

	}

	/**
	* カレンダー表示。
	* 分かれている理由は、iframeで表示しないと全体のCSSの影響を受けるから。
	*/
	public function calendar() {
		$this->layout = false;

		// 情報お取得
		$this->loadModel('Reserve');
		$data = json_decode($this->Reserve->getData($this->userId), true);

		$this->set('reserveData', $data);
	}
}