<?php
App::uses('AppModel', 'Model');
/**
* メニューに関するモデルクラスです。
*/
class MenuConfig extends AppModel {

	const MENU_MODE_EASY    = 1; // かんたんモード
	const MENU_MODE_ADVANCE = 2; // カスタマイズモード

	const MENU_USE_OFF = 0; // 利用しない
	const MENU_USE_ON  = 1; // 利用する

	public function getInfo($userId) {

		$conditionList = array(
			'conditions' => array(
				'user_id' => $userId,
			),
		);

		return $this->find('first', $conditionList);
	}


	public function saveMode($userId, $mode) {
		// メニューのモードを保存する
		$params['MenuConfig']['user_id'] = $userId;
		$params['MenuConfig']['mode']    = $mode;
		$params['MenuConfig']['use_flg'] = 1;

		// トランザクションをONにして登録開始。
		$this->begin();

		if ( ! $this->save($params['MenuConfig'], array('validate' => false))){
			throw new Exception('モード選択失敗::' . print_r($params, true));
		}

		$this->commit();

	}

	public function stopMode($userId){

		$data = $this->getInfo($userId);

		// use_flgを折る
		$params['MenuConfig']['id']      = $data["MenuConfig"]["id"];
		$params['MenuConfig']['use_flg'] = 0;

		if ( ! $this->save($params['MenuConfig'], array('validate' => false))){
			throw new Exception('利用停止失敗::' . print_r($params, true));
		}

		return;
	}


	public function resetMenu($userId){

		// 削除を実施する
		//$this->user_id = $userId;
		//$this->delete();

		$param = array('MenuConfig.user_id' => $userId);
		if ($this->deleteAll($param)) {
			// 成功
		}

		//var_dump($this->deleteAll($param));
		//exit;

		return;
	}

	public function resume($userId){

		$data = $this->getInfo($userId);

		// use_flgを折る
		$params['MenuConfig']['id']      = $data["MenuConfig"]["id"];
		$params['MenuConfig']['use_flg'] = 1;

		if ( ! $this->save($params['MenuConfig'], array('validate' => false))){
			throw new Exception('利用再開失敗::' . print_r($params, true));
		}

		return;
	}
}