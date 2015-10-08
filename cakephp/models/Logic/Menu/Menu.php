<?php

App::uses('AppModel', 'Model');

/**
* メニュー情報のロジックを記述するモデルです。
*/

class Menu extends AppModel {

	/**
	*　対象ユーザの全部のメニューを取得します。
	*/
	public function getAllMenu($userId) {

		$masterStatus = Configure::read('MenuEnableStatus');

		$conditions = array(
			'fields' => array(
				'id',
				'title'
				),
			'conditions' => array(
				'user_id' => $userId,
				'status' => $masterStatus['enable'],
				)
			);

		return $this->find('list', $conditions);
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
				'status' => $masterStatus['enable'],
				'id' => $itemIdList,
				),
			);

		$dataList = $this->find('all', $conditions);

		$blockInfo['menus'] = $dataList;

		return $blockInfo;
	}
}