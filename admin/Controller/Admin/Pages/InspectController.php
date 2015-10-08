<?php

App::uses('AppAdminController', 'Controller');

/**
 * 申請コントローラ.
 */
class InspectController extends AppAdminController {

	public function index() {

	}

	public function commit() {

		$this->loadModel('InspectRequest');

		// 過去に申請をしていないか確認
		$status = $this->InspectRequest->getInfo(AuthComponent::user('id'));

		if(empty($status)){

			$itemList = array();
			$itemList['user_id'] = AuthComponent::user('id');
			$itemList['status']  = 0;

			if ( ! $this->InspectRequest->save($itemList, array('validate' => false))){
				throw new Exception(__('保存失敗::') . print_r($params, true));
			}

			// ここでTOPに飛ばそう
			$this->redirect("/");

		} else {

			// あったら、agent_resultをnullにして処理
			$status = $status[0];

			$status["InspectRequest"]['status'] = 0;
			$status["InspectRequest"]['agent_result'] = null;

			if ( ! $this->InspectRequest->save($status, array('validate' => false))){
				throw new Exception(__('保存失敗::') . print_r($params, true));
			}

			$this->redirect("/");
		}



	}
}