<?php
App::uses('AppApiController', 'Controller');
/**
* Mediaクラスです。
*/
class MediaController extends AppApiController {
	public $uses = array('MediaLogic', 'ImageLogic');

	/**
	 * 前処理
	 */
	public function beforeFilter() {
		$this->autoRender = false;
		parent::beforeFilter();
	}

	public function index() {
		//$media = $this->MediaLogic->get(1, $this->request->params);
		$media = $this->MediaLogic->getImageById($this->request->params); // HSS
		if (empty($media)) {
			throw new NotFoundException();
		}

		header('Content-type: ' . $media['mime']);
		echo $media['file'];
	}

	public function image() {
		//$media = $this->ImageLogic->get($this->request->params); // Hiro version old
		$media = $this->ImageLogic->getApiImage($this->request->params); // HSS add way to view image by image_id via base64
		if (empty($media)) {
			throw new NotFoundException();
		}

		header('Content-type: ' . $media['mime']);
		echo $media['file'];
	}
}
