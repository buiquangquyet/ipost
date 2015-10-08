<?php
App::uses('AppManagerController', 'Controller');
/**
* トップ画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class TopController extends AppManagerController {
	/**
	* 前処理
	* @access  public
	*/
	public function beforeFilter() {
		parent::beforeFilter();
	}

	/**
	* トップ画面表示
	* @access  public
	*/
	public function index() {
	}

}
