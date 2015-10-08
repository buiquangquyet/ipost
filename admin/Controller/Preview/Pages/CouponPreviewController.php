<?php

App::uses('AppPreviewController', 'Controller');

class CouponPreviewController extends AppPreviewController {

	/**
	 * 画面表示.
	 */
	public function index() {

		// クーポン情報取得して、セット
		$this->loadModel('Coupon');
		$jsonData = $this->Coupon->getData($this->userId);
		$this->set('Coupon', $jsonData);

	}

	/**
	 * 画面表示.
	 */
	public function detail() {

		// クーポン情報取得して、セット
		$this->loadModel('Coupon');
		$jsonData = $this->Coupon->getData($this->userId);

		$key = $this->request->query['key'];

		$detail = array();
		$detail[$key] = $jsonData[$key];

		$this->set('Coupon', $detail);

		$this->render('index');

	}

	public function regist() {
		$this->index();
		$this->render('index');
	}
}