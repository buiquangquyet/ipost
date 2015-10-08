<?php

App::uses('AppPreviewController', 'Controller');

class MenuPreviewController extends AppPreviewController {

	public function index() {

		// モデルのロード
		$this->loadModel('MenuTopItem');
		// メニュートップ画像の取得
		$menuTop = $this->MenuTopItem->getItems($this->userId);
		$this->set('menuTop', $menuTop);

		// 商品データの取得
		// モデルのロード
		$this->loadModel('MenuItem');
		$menuItems = $this->MenuItem->getItems($this->userId);
		$this->set('menuItems', $menuItems);

	}


	public function easy() {

		// モデルのロード
		$this->loadModel('MenuTopItem');
		// メニュートップ画像の取得
		$menuTop = $this->MenuTopItem->getItems($this->userId);
		$this->set('menuTop', $menuTop);

		// 商品データの取得
		// モデルのロード
		$this->loadModel('MenuItem');
		$menuItems = $this->MenuItem->getItems($this->userId);
		$this->set('menuItems', $menuItems);

	}


	public function advance(){

		// モデルのロード
		$this->loadModel('MenuTopItem');
		// メニュートップ画像の取得
		$menuTop = $this->MenuTopItem->getItems($this->userId);
		$this->set('menuTop', $menuTop);

		// 商品データの取得
		// モデルのロード
		$this->loadModel('MenuCategory');
		$menuCategorys = $this->MenuCategory->getItems($this->userId);
		$this->set('menuCategorys', $menuCategorys);
	}


	public function detail(){

		$key = $this->request->query['key'];

		// 商品データの取得
		// モデルのロード
		$this->loadModel('MenuItem');
		$menuItem = $this->MenuItem->getInfo($key);

		$this->set('menuItem', $menuItem);
	}
}