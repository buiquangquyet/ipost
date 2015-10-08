<?php

App::uses('AppAdminController', 'Controller');

/**
 * サイドメニュー設定画面コントローラ.
 */
class SidemenuController extends AppAdminController {

	/**
	 * 画面表示.
	 */
	public function index() {
		$jsonData = $this->Sidemenu->getData(AuthComponent::user('id'));
		$this->request->data = array('Sidemenu' => $jsonData);
		$this->set('Sidemenu', $jsonData);
	}

	/**
	* 有効にする。
	*/
	public function enable() {
		$this->Sidemenu->enable(AuthComponent::user('id'), $this->request->data);
		$this->redirect('index#' . key($this->request->data['Sidemenu']));
	}

	/**
	* 登録する。
	*/
	public function regist() {
		$this->Sidemenu->regist(AuthComponent::user('id'), $this->request->data);
		$this->redirect('index#' . key($this->request->data['Sidemenu']));

	}

	/**
	* 位置情報を変更します。
	*/
	public function movePos() {

		// 対象のIDが上か、下か、どこに移動するのかわたされてくるので、それを元に情報を変更する。
		$this->Sidemenu->movePos(AuthComponent::user('id'), $this->request->query['target'], $this->request->query['type']);

		// リダイレクト
		$this->redirect('index#' . $this->request->query['target']);
	}

}