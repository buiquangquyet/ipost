<?php
App::uses('AppModel', 'Model');
/**
* メニューに関するモデルクラスです。
*/
class MenuCategory extends AppModel {
	public function getItems($userId) {
		$conditionList = array(
			'conditions' => array(
				'user_id' => $userId,
			),
			'order' => array(
				'position ASC',),
		);
		return $this->find('all', $conditionList);
	}

	public function getHighestPositionItems($userId) {

		$conditionList = array(
				'conditions' => array(
						'user_id' => $userId,
				),
				'order' => array(
						'position DESC',),
		);

		// アイテムの取得
		$itemData = $this->find('first', $conditionList);

		// アイテムのポジションを獲得
		if(!empty($itemData)){
			$position = $itemData['MenuCategory']['position'];
			$position = $position + 1;
		}else{
			// first default position
			$position = 1;
		}

		return $position;
	}

	public function addItem($itemList){
		// 現在の一番下のpositionを得る
		$position = $this->getHighestPositionItems($itemList['user_id']);
		// positionの設定
		$itemList["position"] = $position;

		// 保存
		if ( ! $this->save($itemList, array('validate' => false))){
			throw new Exception('モード選択失敗::' . print_r($params, true));
		}

		return;
	}

	public function editItem($itemList){

		// 保存
		if ( ! $this->save($itemList, array('validate' => false))){
			throw new Exception('モード選択失敗::' . print_r($params, true));
		}

		return;
	}

	public function deleteItem($id = null){

		// delete
		if (!$this->delete($id)){
			throw new Exception('削除ミス::' . print_r($params, true));
		}

		return;
	}

	// HSS add
	public function getCategory($userId, $catId) {

		if($catId) {
			$conditionList = array(
					'conditions' => array(
							'id' => $catId,
							'user_id' => $userId,
					)
			);
		} else {
			$conditionList = array(
					'conditions' => array(
							'user_id' => $userId,
					)
			);
		}


		return $this->find('all', $conditionList);
	}
}