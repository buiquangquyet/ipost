<?php

App::uses('AppAdminController', 'Controller');

/**
 * 申請設定画面コントローラ.
 */
class ReserveController extends AppAdminController {

	/**
	* インデックス
	*/
	public function index() {

		$data = $this->Reserve->getData(AuthComponent::user('id'));
		$this->request->data = json_decode($data, true);
	}

	public function registEnable() {

		$this->Reserve->saveData(AuthComponent::user('id'), $this->request->data);
		$this->redirect('index#enable');
	}

	public function registRule() {

		$this->Reserve->saveData(AuthComponent::user('id'), $this->request->data);
		$this->redirect('index#rule_body');

	}

	public function registMail() {

		$this->Reserve->saveData(AuthComponent::user('id'), $this->request->data);
		$this->redirect('index#mail_body');

	}

	public function registTelMail() {
		$this->Reserve->saveData(AuthComponent::user('id'), $this->request->data);
		$this->redirect('index#tel_mail');
	}

}

