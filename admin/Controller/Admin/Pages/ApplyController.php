<?php

App::uses('AppAdminController', 'Controller');

/**
 * 申請設定画面コントローラ.
 */
class ApplyController extends AppAdminController {

	/**
	* 前処理
	*/
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Security->validatePost = false;
	}

	/**
	 * 画面表示.
	 */
	public function index() {
		$applyInfo = json_decode($this->Apply->getData(AuthComponent::user('id')), true);
		$this->set('applyInfo', $applyInfo);
	}

	/**
	* アイコン情報を登録します。
	*/
	public function registIconImage() {

		$this->request->data['imageType'] = 'icon';

		// 画像のリサイズとIDの取得
		$this->loadModel('ApplyIconImage');
		$this->ApplyIconImage->saveData(AuthComponent::user('id'), $this->request->data);

		// リダイレクト
		$this->redirect('index#icon');
	}

	/**
	* 起動用情報を登録します。
	*/
	public function registInitImage() {

		$this->request->data['imageType'] = 'fullsize';

		// 画像のリサイズとIDの取得
		$this->loadModel('ApplyInitImage');
		$this->ApplyInitImage->saveData(AuthComponent::user('id'), $this->request->data);

		// リダイレクト
		$this->redirect('index#init');
	}


	/**
	* 起動用情報を登録します。
	*/
	public function registAdImage() {

		$this->request->data['imageType'] = 'adIcon';

		// 画像のリサイズとIDの取得
		$this->loadModel('ApplyAdImage');
		$this->ApplyAdImage->saveData(AuthComponent::user('id'), $this->request->data);

		// リダイレクト
		$this->redirect('index#ad');
	}

	/**
	* 起動用情報を登録します。
	*/
	public function registDispItem() {

		// 画像のリサイズとIDの取得
		$this->loadModel('ApplyStoreInfo');
		$this->ApplyStoreInfo->saveData(AuthComponent::user('id'), $this->request->data);

		// リダイレクト
		$this->redirect('index#storedisp');
	}

	public function registCategory() {

		// 画像のリサイズとIDの取得
		$this->loadModel('ApplyCategory');
		$this->ApplyCategory->saveData(AuthComponent::user('id'), $this->request->data);

		// リダイレクト
		$this->redirect('index#appstore');
	}

	public function registKeyword() {

		// 画像のリサイズとIDの取得
		$this->loadModel('ApplyKeyword');
		$this->ApplyKeyword->saveData(AuthComponent::user('id'), $this->request->data);

		// リダイレクト
		$this->redirect('index#keyword');
	}

	/**
	* スクリーンショットを取る
	*/
	public function registScreenShot() {

		$this->request->data['imageType'] = 'fullsize';

		// 画像の登録
		$this->loadModel('ApplyScreenShot');
		$this->ApplyScreenShot->saveData(AuthComponent::user('id'), $this->request->data);

		// リダイレクト
		$this->redirect('index#' . $this->request->data['image_type']);

	}

	public function deleteScreenShot() {

		$this->Apply->deleteImage(AuthComponent::user('id'), $this->request->query['type'], $this->request->query['key']);

		// リダイレクト
		$this->redirect('index#' . $this->request->query['type']);
	}

}