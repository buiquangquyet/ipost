<?php

App::uses('AppController', 'Controller');

class CmsController extends AppController {

	/**
	 * 画面表示.
	 */
	public function index() {
		$this->layout = false;

		header('Content-Type: text/html; charset=utf-8');
		$this->loadModel('Html');
		$data = json_decode($this->Html->getData($this->request->query['userId']), true);
		echo $data['html'];
		exit;
	}

	/**
	* cssの表示
	*/
	public function css() {
		$this->layout = false;

		header('Content-Type: text/css; charset=utf-8');
		$this->loadModel('Html');
		$data = json_decode($this->Html->getData($this->request->query['userId']), true);
		echo $data['css'];
		exit;
	}
}