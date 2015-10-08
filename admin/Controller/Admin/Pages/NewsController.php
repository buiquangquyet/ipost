<?php

App::uses('AppAdminController', 'Controller');

/**
 * 背景設定画面コントローラ.
 */
class NewsController extends AppAdminController {

	public function beforeFilter() {
		parent::beforeFilter();

		$this->isSmartphone = $this->_isSmartphone();

		if ($this->isSmartphone){
			$this->theme = 'Smartphone';
		}

		$this->Security->validatePost = false;
	}

	public function _isSmartphone() {
		return ($this->_isIphone() || $this->_isAndroid());
	}


	public function _isIphone() {
		return (stripos(env('HTTP_USER_AGENT'),'iPhone') !== FALSE);
	}


	public function _isAndroid() {
		return (stripos(env('HTTP_USER_AGENT'),'Android') !== FALSE);
	}

	/**
	 * 画面表示.
	 */
	public function index() {

		// 情報の取得
		$this->loadModel('News');
		$this->paginate = $this->News->getAllSearchCondition(AuthComponent::user('id'));
		$dataInfoList = $this->paginate('News');

		// ループでフォーム初期化
		$formData = array();
		foreach($dataInfoList as $key => $dataInfo) {

			// 配信日時の情報を設定する。
			if ($dataInfo['News']['noticed'] != '0000-00-00 00:00:00') {
				$dataInfo['News']['notice_flg'] = 1;

				// 分割して入れる。
				$time = strtotime($dataInfo['News']['noticed']);
				$dataInfo['News']['notice_date'] = date('Y-m-d', $time);
				$dataInfo['News']['notice_hour'] = date('h', $time);
				$dataInfo['News']['notice_minute'] = date('i', $time);
			} else {
				$dataInfo['News']['notice_flg'] = 0;
			}

			$formData[$dataInfo['News']['id']] = $dataInfo['News'];
		}

		$this->set('defaultTimerDate', date("Y-m-d", strtotime("+1 day")));

		$this->request->data = $formData;
		$this->set('dataInfoList', $dataInfoList);

		// 日時の設定
		$this->set('time', Configure::read('news_time_list'));

		// TODO:後で治す！！
		// 簡易スマホ対応
		if($this->theme =='Smartphone'){

			$this->layout = "";
			$this->render('sp/index');
		}
	}

	/**
	* 削除
	*/
	public function delete() {

		// 引数チェック
		if (empty($this->request->query['id'])) {
			throw new Exception(__('パラメータが不正です。'));
		}

		// 削除開始
		$this->loadModel('News');
		$this->News->deleteData(AuthComponent::user('id'), $this->request->query['id']);

		// リダイレクト
		$this->redirect('index');
	}


	/**
	* 登録
	*/
	public function regist() {

		// 情報の設定

		//tồn tại id và id !=null
		if (isset($this->request->data['id']) && !empty($this->request->data[$this->request->data['id']])) {
			$tmpData = $this->request->data[$this->request->data['id']];
			unset($this->request->data[$this->request->data['id']]);
			$this->request->data =array_merge($this->request->data, $tmpData);
		}
		$this->loadModel('NewsImage');
		$imageInfo = $this->NewsImage->saveImage(AuthComponent::user('id'), $this->request->data);
		if (!empty($imageInfo)) {
			$this->request->data['image'] = $imageInfo['Image']['image_id'];
		} else {
			if (empty($this->request->data['old_image_id'])) {
				$this->request->data['image'] = '';

			} else {
				$this->request->data['image'] = $this->request->data['old_image_id'];
			}
		}

		$this->request->data['status'] = 1;// Hss add news default active
		// 情報登録
		$this->loadModel('News');
		if ($this->News->saveData(AuthComponent::user('id'), $this->request->data)) {
			if (isset($this->request->data['id']) && $this->request->data['id']) {
				$this->Session->setFlash(__('ニュースを更新しました。'), 'default', array('class' => 'alert alert-success'));
			} else {
	            $this->Session->setFlash(__('新規ニューズが登録されました。'), 'default', array('class' => 'alert alert-success'));
			}
        }
        
		// リダイレクト
		$this->redirect('index');
	}
}