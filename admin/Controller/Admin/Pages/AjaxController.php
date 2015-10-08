<?php

App::uses('AppAdminController', 'Controller');

/**
 * 各種情報登録用AJAXコントローラ.
 */
class AjaxController extends AppAdminController {
	public $uses = array('Ajax');

	/**
	 * 事前処理.
	 */
	public function beforeFilter() {
		$this->autoRender = false;
		$this->Security->csrfCheck = false;
		$this->Security->validatePost = false;
		parent::beforeFilter();
	}

	/**
	 * 登録処理.
	 */
	public function regist() {
		$result = $this->request->data;
		try {
			//model logic/Ajax/dispatchSaveData
			$result = $this->Ajax->dispatchSaveData(AuthComponent::user('id'), $this->request->data);
			echo json_encode(array(
				"code" => "1",
				"result" => $result,
			));
		} catch(ValidateException $e) {
			echo json_encode(array(
				"code" => "2",
				"message" => json_decode($e->getMessage())
			));
		}
	}
}
