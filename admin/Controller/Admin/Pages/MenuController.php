<?php

App::uses('AppAdminController', 'Controller');



/**
 *  メニュー設定画面コントローラ.
 */
class MenuController extends AppAdminController {

	function beforeFilter() {
		parent::beforeFilter();

		//The request has been black-holed
		$this->Security->validatePost = false;
	}

	/**
	 * 画面表示
	 */
	public function index() {

		// モデルのロード
		$this->loadModel('MenuConfig');
		$menuInfo = $this->MenuConfig->getInfo(AuthComponent::user('id'));

		// 完全に初回起動時
		if(empty($menuInfo) && empty($this->params['url']['mode'])){
			$this->render('select');
			return;
		}

		// モードの選択が実施されている場合
		// getパラメータが来ている場合に処理
		if(empty($menuInfo) && !empty($this->params['url']['mode'])){

			// typeの獲得
			$type = $this->params['url']['mode'];

			// かんたんモードだった場合
			if($type == '1'){
				$this->MenuConfig->saveMode(AuthComponent::user('id'), $type);

				// かんたんモードへ転送する
				$this->redirect("./easy");
				return;
			}

			// アドバンスモードだった場合
			if($type == '2'){
				$this->MenuConfig->saveMode(AuthComponent::user('id'), $type);

				// アドバンスモードへ転送
				$this->redirect("./advance");
				return;
			}
		}

		// 利用の一時停止をしたい場合
		if(!empty($menuInfo) && !empty($this->params['url']['stop'])){

			// 一時停止したい
			$this->MenuConfig->stopMode(AuthComponent::user('id'));
			$this->redirect("./index");
			exit;
		}

		// 利用の再開をしたい場合
		if(!empty($this->params['url']['resume'])){
		//if(!empty($menuInfo) && !empty($this->params['url']['resume'])){

			// 一時停止したい
			$this->MenuConfig->resume(AuthComponent::user('id'));
			$this->redirect("./index");
			exit;
		}

		// リセットしたい場合
		if(!empty($this->params['url']['reset'])){
			// リセットしたい
			$this->MenuConfig->resetMenu(AuthComponent::user('id'));
			$this->redirect("./index");
			exit;
		}

		// モードの確認 ------------------------------

		// 0 : 利用してない　＆　設定もしてない
		if(!empty($menuInfo) && $menuInfo["MenuConfig"]["use_flg"] == 0 && $menuInfo["MenuConfig"]["mode"] == 0){
			$this->render('select');
			return;
		}

		// 0 : 利用停止状態（何モードなのかはわからないが）
		if(!empty($menuInfo) && $menuInfo["MenuConfig"]["use_flg"] == 0){
			$this->render('resume');
			return;
		}


		// 1 : menu easy mode 簡単モードへ移動
		if($menuInfo["MenuConfig"]["mode"] == 1){
			// かんたんモードへ転送する
			$this->redirect("./easy");
			return;
		}

		// 2 : menu advance mode へ移動
		if($menuInfo["MenuConfig"]["mode"] == 2){
			$this->redirect("./advance");
			return;
		}
		// -------------------------------------------

		return;

	}

	// かんたんモードのview表示メソッド
	public function easy(){

		// モデルのロード
		$this->loadModel('MenuTopItem');
		// メニュートップ画像の取得
		$menuTop = $this->MenuTopItem->getItems(AuthComponent::user('id'));
		$this->set('menuTop', $menuTop);

		// 商品データの取得
		// モデルのロード
		$this->loadModel('MenuItem');
		$menuItems = $this->MenuItem->getItemsSimple(AuthComponent::user('id')); //$this->MenuItem->getItems(AuthComponent::user('id'));
		$this->set('menuItems', $menuItems);

		// セット
		$this->render('easy');
	}


	public function menu_top_add(){
		// 画像のリサイズとIDの取得
		$this->loadModel('MenuImage');
		$imageInfo = $this->MenuImage->saveImage(AuthComponent::user('id'), $this->request->data);

		// メニューの登録項目の初期化
		$itemList = array();

		// 画像の投稿がある場合、image_idを保存する
		if(!empty($imageInfo['Image']['image_id'])){
			$itemList["image_id"] = $imageInfo['Image']['image_id'];
		}

		// 保存項目設定
		$itemList["user_id"] = AuthComponent::user('id');
		// モデルのロード
		$this->loadModel('MenuTopItem');
		// 保存
		$this->MenuTopItem->addItem($itemList);

		$this->redirect("./");
		return;
	}

	// コンテンツの追加
    //add content cho menu kieu easy
	public function easy_content_add(){
		// 画像のリサイズとIDの取得
        //add anh vao menuImage
		$this->loadModel('MenuImage');
        //add image table images
		$imageInfo = $this->MenuImage->saveImage(AuthComponent::user('id'), $this->request->data);

		// メニューの登録項目の初期化
        //khoi tao muc dk moi
		$itemList = array();
		// 画像の投稿がある場合、image_idを保存する
        //them image_id
		if(!empty($imageInfo['Image']['image_id'])){
			$itemList["image_id"] = $imageInfo['Image']['image_id'];
		}

		// 保存項目設定
		$languages = Configure::read('multilanguages');
		$itemList["user_id"]      =  AuthComponent::user('id');
		$itemList["parent_id"]    =  $this->request->data["parent_id"];
		$itemList["title"]        =  $this->request->data["title"];
		$itemList["price"]        =  $this->request->data["price"];
		$itemList["sub_title"]    =  $this->request->data["sub_title"];
		$itemList["description"]  =  $this->request->data["description"];
		$itemList["lang"]		  =  Configure::read('Config.language');
		$itemList["currency"]     =  $this->request->data["currency"];
		$itemList["enable"]       =  $this->request->data["enable"];

		// モデルのロード
		$this->loadModel('MenuItem');

		// 保存
        //add item into menu table (menu_item)
		$this->MenuItem->addItem($itemList);

		$this->redirect("./");
		return;
	}

	// コンテンツの編集
	public function easy_content_edit(){
		// 画像のリサイズとIDの取得
        //save image
		$this->loadModel('MenuImage');
		$imageInfo = $this->MenuImage->saveImage(AuthComponent::user('id'), $this->request->data);

		// メニューの登録項目の初期化
		$itemList = array();

		// 画像の投稿がある場合、image_idを保存する
        //add image_id to array itemlist
		if(!empty($imageInfo['Image']['image_id'])){
			$itemList["image_id"] = $imageInfo['Image']['image_id'];
		}

		// 保存項目設定
		$languages = Configure::read('multilanguages');
		$itemList["id"]           =  $this->request->data["id"];
		$itemList["user_id"]      =  AuthComponent::user('id');
		$itemList["parent_id"]    =  $this->request->data["parent_id"];
		$itemList["title"]        =  $this->request->data["title"];
		$itemList["price"]        =  $this->request->data["price"];
		$itemList["sub_title"]    =  $this->request->data["sub_title"];
		$itemList["description"]  =  $this->request->data["description"];
		$itemList["lang"]		  =  Configure::read('Config.language');
		$itemList["currency"]     =  $this->request->data["currency"];
		$itemList["enable"]       =  $this->request->data["enable"];

		// モデルのロード
		$this->loadModel('MenuItem');

		// 保存
        //edititem save()
		$this->MenuItem->editItem($itemList);

		$this->redirect("./");
		return;
	}

	// コンテンツの削除
	public function easy_content_delete(){
		// 指定IDのコンテンツを消す
	}

	// コンテンツの削除
	public function delete_item($id){

	//var_dump($id);exit;

		// 指定IDのコンテンツを消す

		// モデルのロード
		$this->loadModel('MenuItem');

		// 保存
		$this->MenuItem->deleteItem($id);

		$this->redirect("./");
	}

	// カテゴリの削除
	public function delete_category($id){

		// 指定IDのコンテンツを消す

		// モデルのロード
		$this->loadModel('MenuCategory');

		// 保存
		$this->MenuCategory->deleteItem($id);

		$this->redirect("./");
	}


	// コンテンツの上下の変更
	public function content_vertical_change(){

		// post値の取得
		$parent_id = $this->request->data["parent_id"];
		$position  = $this->request->data["position"];

		// モデルのロード
		$this->loadModel('MenuItem');

		// 上下変更
		$this->MenuItem->downPosition(AuthComponent::user('id'),$parent_id,$position);

		$this->redirect("./");
		return;
	}

	// カテゴリの追加

	// add new category table ('dtb_menu_categories')
	public function category_add(){
		// 画像のリサイズとIDの取得
		$this->loadModel('MenuImage');
        //model MenuImage->ImageLogic->saveImage
		$imageInfo = $this->MenuImage->saveImage(AuthComponent::user('id'), $this->request->data);
		// メニューの登録項目の初期化
		$itemList = array();
		// 画像の投稿がある場合、image_idを保存する
		if(!empty($imageInfo['Image']['image_id'])){
			$itemList["image_id"] = $imageInfo['Image']['image_id'];
		}

		// 保存項目設定
		$itemList["user_id"]      =  AuthComponent::user('id');
		$itemList["title"]        =  $this->request->data["title"];
		$itemList["sub_title"]    =  $this->request->data["sub_title"];
		$itemList["enable"]       =  $this->request->data["enable"];

		// モデルのロード
		$this->loadModel('MenuCategory');
		// 保存
        // postion of category Highest + 1
		$this->MenuCategory->addItem($itemList);
		$this->redirect("./");
		return;
	}

	// カテゴリの編集
    //edit category table ('dtb_menu_categories')
	public function category_edit(){

		// 画像のリサイズとIDの取得
		$this->loadModel('MenuImage');
        //add menuImage
		$imageInfo = $this->MenuImage->saveImage(AuthComponent::user('id'), $this->request->data);

		// メニューの登録項目の初期化
		$itemList = array();

		// 画像の投稿がある場合、image_idを保存する
		if(!empty($imageInfo['Image']['image_id'])){
			$itemList["image_id"] = $imageInfo['Image']['image_id'];
		}

		// 保存項目設定
		$itemList["user_id"]      =  AuthComponent::user('id');
		$itemList["id"]           =  $this->request->data["id"];
		$itemList["title"]        =  $this->request->data["title"];
		$itemList["sub_title"]    =  $this->request->data["sub_title"];
		$itemList["enable"]       =  $this->request->data["enable"];

		// モデルのロード
		$this->loadModel('MenuCategory');

		// 保存
		$this->MenuCategory->editItem($itemList);

		$this->redirect("./");
		return;
	}

	// アドバンスモードのview表示メソッド
	public function advance(){
		// モデルのロード
		$this->loadModel('MenuTopItem');
		// メニュートップ画像の取得
		$menuTop = $this->MenuTopItem->getItems(AuthComponent::user('id'));
		$this->set('menuTop', $menuTop);

		// 商品データの取得
		// モデルのロード
		$this->loadModel('MenuItem');
		$menuItems = $this->MenuItem->getItems(AuthComponent::user('id'));
		$this->set('menuItems', $menuItems);

		// 商品データの取得
		// モデルのロード
		$this->loadModel('MenuCategory');
		$menuCategorys = $this->MenuCategory->getItems(AuthComponent::user('id'));
		$this->set('menuCategorys', $menuCategorys);

		$this->render('advance');
	}
}