<?php
App::uses('AppAgentController', 'Controller');
/**
* トップ画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class TopController extends AppAgentController {
	/**
	* 前処理
	* @access  public
	*/
	public function beforeFilter() {
		parent::beforeFilter();
        $this->Security->validatePost = false;
	}

	/**
	* トップ画面表示
	* @access  public
	*/
	public function index() {
	}

}
