<?php

App::uses('AppAdminController', 'Controller');

/**
 * 背景設定画面コントローラ.
 */
class HtmlController extends AppAdminController {

	/**
	 * 画面表示.
	 */
	public function index() {
		$htmlInfo = json_decode($this->Html->getData(AuthComponent::user('id')), true);
		$this->set('HtmlInfo', $htmlInfo);

		// 保存する。
		$this->request->data = $htmlInfo;
	}
	public function registHtml() {
		// データを登録
		//html->basicInfologin->saveData->(kiem tra rong, validate)
		//type html info
		$this->Html->saveData(AuthComponent::user('id'), $this->request->data);
		$this->redirect('index');
	}

	public function registCss() {

		// データを登録
		$this->Html->saveData(AuthComponent::user('id'), $this->request->data);
		$this->redirect('index');

	}

	public function registImage() {

		// データを登録
		$this->loadModel('HtmlImage');
		$this->HtmlImage->saveData(AuthComponent::user('id'), $this->request->data);
		$this->redirect('index');
	}

	/**
	* イメージの削除
	*/
	public function removeImage() {
		$params = array('image' => array($this->request->query['pos'] => ''));

		// データを登録
		$this->Html->saveData(AuthComponent::user('id'), $params);
		$this->redirect('index');
	}
}