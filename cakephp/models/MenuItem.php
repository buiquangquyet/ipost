<?php
App::uses('AppModel', 'Model');
/**
* メニューに関するモデルクラスです。
*/
class MenuItem extends AppModel {

	/**
	* アイテムIDを元にアイテム情報を取得します。
	* @param number $itemId 指定ID
	* @return array
	*/
	public function getInfo($itemId) {
		$conditionList = array(
			'conditions' => array(
				'id' => $itemId,
			),
		);
		return $this->find('first', $conditionList);
	}

	public function getItems($userId, $parentId=null) {

		$conditionList = array(
			'conditions' => array(
				'user_id' => $userId,
				'parent_id' => $parentId,
				'enable' => 1
				//'lang' => Configure::read('Config.language')
			),
			'order' => array(
				'position ASC',),
		);
        if (empty($parentId)) {
            unset($conditionList['conditions']['parent_id']);
        }
		return $this->find('all', $conditionList);
	}

	// Hss add
	public function getItemsSimple($userId, $parentId=null) {

		$conditionList = array(
				'conditions' => array(
						'user_id' => $userId,
						'parent_id' => 0,
						//'lang' => Configure::read('Config.language')
				),
				'order' => array(
						'position ASC',),
		);
		return $this->find('all', $conditionList);
	}

	// Hss add
	public function getItemsByLang($userId, $parentId=null) {

		$conditionList = array(
				'conditions' => array(
						'user_id' => $userId,
						'parent_id' => $parentId,
						'lang' => Configure::read('Config.language')
				),
				'order' => array(
						'position ASC',),
		);
		if (empty($parentId)) {
			unset($conditionList['conditions']['parent_id']);
		}
		return $this->find('all', $conditionList);
	}

	/**
	* トップ用のselect用のリストを取得します。
	*/
	public function getItemLists($userId) {
		$masterStatus = Configure::read('MenuEnableStatus');
		$conditions = array(
			'fields' => array(
				'id',
				'title'
				),
			'conditions' => array(
				'user_id' => $userId,
				'enable' => $masterStatus['enable'],
				)
			);
		return $this->find('list', $conditions);
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
			$position = $itemData['MenuItem']['position'];
			$position = $position + 1;
		}else{
			// first default position
			$position = 1;
		}

		return $position;
	}

	public function downPosition($userId,$parent_id,$position) {

		// そのparent_idのアイテムをごっそり取ってくる
		$conditionList = array(
				'conditions' => array(
						'user_id' => $userId,
				),
				'order' => array(
						'position ASC',),
		);

		$itemList =  $this->find('all', $conditionList);

		// 引数で入ってきたpositionがあるか探す
		foreach($itemList as $item){

			// 既に下ろすIDがある状態で２周目に来た場合、そいつを上に上げる
			if(!empty($down_id)){
				$up_id  = $item["MenuItem"]["id"];
				$up_pos = $item["MenuItem"]["position"];
				break;
			}

			if($item["MenuItem"]["position"] == $position){
				// idを確保する
				$down_id  = $item["MenuItem"]["id"];
				$down_pos = $item["MenuItem"]["position"];
			}
		}


		// 入れ替えるIDが双方決定していた場合に入れ替えを実施する
		if(!empty($down_id) && !empty($up_id)){

			$params = array();
			$params['MenuItem']['id']       = $up_id;
			$params['MenuItem']['position'] = $down_pos;

			if ( ! $this->save($params['MenuItem'], array('validate' => false))){
				throw new Exception('利用再開失敗::' . print_r($params, true));
			}

			$params = array();
			$params['MenuItem']['id']       = $down_id;
			$params['MenuItem']['position'] = $up_pos;

			if ( ! $this->save($params['MenuItem'], array('validate' => false))){
				throw new Exception('利用再開失敗::' . print_r($params, true));
			}
		}



		// 入れ替えたポジ同士のアイテムを保存


		// 終わり



	}

	public function addItem($itemList){

		// なにもない場合は0円にせざるをえない
		if(empty($itemList["price"])){
			$itemList["price"] = 0;
		}

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
		// なにもない場合は0円にせざるをえない
		if(empty($itemList["price"])){
			$itemList["price"] = 0;
		}
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

	/**
	 * 指定したIDの一覧を取得します。
	 * 第二引数はブロックの情報です。
	 */
	public function mergeMenuInfo($userId, $blockInfo) {

		$masterStatus = Configure::read('MenuEnableStatus');

		// ID一覧を生成
		$menuList = array_filter($blockInfo['menus'], 'strlen');

		$itemIdList = array_values($menuList);

		$conditions = array(
				'conditions' => array(
						'user_id' => $userId,
						'enable' => $masterStatus['enable'],
						'id' => $itemIdList,
				),
		);

		$dataList = $this->find('all', $conditions);

		$blockInfo['menus'] = $dataList;

		return $blockInfo;
	}
}