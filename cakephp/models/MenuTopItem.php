<?php
App::uses('AppModel', 'Model');
/**
* メニューに関するモデルクラスです。
*/
class MenuTopItem extends AppModel {

	public $primaryKey = 'user_id';

	public function getItems($userId) {

		$conditionList = array(
			'conditions' => array(
				'user_id' => $userId,
			)
		);

		return $this->find('first', $conditionList);
	}

	public function addItem($itemList){

		/*
		// 既存のデータの存在確認
		$topData = $this->getItems($itemList['user_id']);

		// 既存データが有る場合、データ上書き扱いにする
		if(!empty($topData)){
			$itemList['id'] = $topData['MenuTopItem']['id'];
		}
		*/

		// 保存
		if ( ! $this->save($itemList, array('validate' => false))){
			throw new Exception('モード選択失敗::' . print_r($params, true));
		}

		return;
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
		$this->user_id = $userId;
		$this->delete();

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