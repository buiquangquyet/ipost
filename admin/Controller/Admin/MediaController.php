<?php

App::uses('AppAdminController', 'Controller');

class MediaController extends AppAdminController {
	public $uses = array('MediaLogic', 'ImageLogic');

	/**
	 * 前処理
	 */
	public function beforeFilter() {
		$this->autoRender = false;
		$this->Security->csrfCheck = false;
		$this->Security->validatePost = false;

		$this->Auth->allow('index', 'image');

		parent::beforeFilter();
	}

	public function index() {
		// XXX: http://pk-brothers.com/839/
		$userId = AuthComponent::user('id');
		if (! empty($userId)) {
			$media = $this->MediaLogic->get($userId, $this->request->params);
		} else {
			$media = $this->MediaLogic->forceGet($this->request->params);
		}

		if (empty($media)) {
			throw new NotFoundException();
		}

		header('Content-type: ' . $media['mime']);
		echo $media['file'];
	}

	public function image() {
		$media = $this->ImageLogic->get($this->request->params);
		if (empty($media)) {
			throw new NotFoundException();
		}

		header('Content-type: ' . $media['mime']);
		echo $media['file'];
		exit();
	}
}
