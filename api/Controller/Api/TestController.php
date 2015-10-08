<?php
App::uses('AppApiController', 'Controller');
/**
* Mediaクラスです。
*/
class TestController extends AppApiController {
	public $uses = array('MediaLogic', 'ImageLogic');

	/**
	 * 前処理
	 */
	public function beforeFilter() {
		$this->autoRender = false;
		parent::beforeFilter();
	}

	// simple api sample
	public function index() {

		$test = array();

		$test['id'] = '1';

		$json = json_encode($test);

		echo($json);

		exit;
	}


	// db connection & get data -> json_output sample
	public function sample($id = 3){

		// setting model class
		// common model place->  /cakephp/models/...
		$this->loadModel('BasicInfo');

		// call function db-model & get data
		$jsonData = $this->BasicInfo->getInfo($id,'coupon_info');

		// json_encode
		$jsonData = json_encode($jsonData);

		// echo
		echo($jsonData);

	}

}
