<?php
App::uses('AppAdminController', 'Controller');

class BlockController extends AppAdminController {

	/**
	 * 前処理
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Security->validatePost = false;
	}

	/**
	 * トップ画面表示 簡単な方
	 */
	public function index() {
		//load cấu hình
		$jsonData = $this->Block->getData(AuthComponent::user('id'));
		//truyền lại vào request
		$this->request->data = array('Block' => $jsonData);
		//truyền ra view
		$this->set('Block', $jsonData);

		// 商品データの取得
		// モデルのロード
		//load mode('MenuItem') cakephp/model/Menuitem
		$data = $this->loadModel('MenuItem');
		//get Menuitem with user_id pre option "Khối menu đề xuất sản phẩm"
		$menuItems = $this->MenuItem->getItems(AuthComponent::user('id'));
		$this->set('menuItems', $menuItems);
		// Hss add
		//load model('MenuConfig') cakephp/model/MenuConfig
		//get array info
		$this->loadModel('MenuConfig');
		$simpleConfig = $this->MenuConfig->getInfo(AuthComponent::user('id'));
		//render option "Khối menu đề xuất sản phẩm"
		$menuItemsList = array();
		$menuItemsList = array('' => __('選択なし'));

		foreach($menuItems as $item){
			if ($simpleConfig['MenuConfig']['mode'] == 1 && $item['MenuItem']['parent_id'] == 0) {
				$menuItemsList[$item['MenuItem']['id']] = $item['MenuItem']['title'];
			} elseif($simpleConfig['MenuConfig']['mode'] == 2 && $item['MenuItem']['parent_id'] != 0) {
				$menuItemsList[$item['MenuItem']['id']] = $item['MenuItem']['title'];
			}
		}
		
		$this->set('menuItemsList', $menuItemsList);

		//var_Dump($menuItemsList);
		//var_Dump($menuList);


		// メニューの一覧を取得して、追加
		//load Menu/Menu.php chưa biết làm gì
		$this->loadModel('Menu');
		$menuList = $this->Menu->getAllMenu(AuthComponent::user('id'));
		$menuList = array('' => __('選択なし')) + $menuList;
		$this->set('menuList', $menuList);

		//var_Dump($menuList);
	}

	/**
	 * 有効にする。
	 */
	public function enable() {
		//Model(Block/Block.php)->enable(user_id,$request);
		$this->Block->enable(AuthComponent::user('id'), $this->request->data);
		$this->redirect('index#' . key($this->request->data['Block']));
	}

	/**
	 * 登録する。
	 *
	 */
	public function regist() {
		//model(block/block)->regit->update
		$this->Block->regist(AuthComponent::user('id'), $this->request->data);
		$this->redirect('index#' . key($this->request->data['Block']));

	}

	/**
	 * イメージの削除
	 */
	public function deleteImage() {
		//delete Image 
		$this->Block->deleteImage(AuthComponent::user('id'), $this->request->query['id']);
		$this->redirect('index#image');
	}

	/**
	 * ブロックの位置情報を変更します。
	 */
	public function movePos() {
		//di chuyển thay đổi position
		// 対象のIDが上か、下か、どこに移動するのかわたされてくるので、それを元に情報を変更する。
		$this->Block->movePos(AuthComponent::user('id'), $this->request->query['target'], $this->request->query['type']);

		// リダイレクト
		$this->redirect('index#' . $this->request->query['target']);
	}
}