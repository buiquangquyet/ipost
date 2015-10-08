<?php

App::uses('AppPreviewController', 'Controller');

class BlockPreviewController extends AppPreviewController {

	/**
	 * 画面表示.
	 */
	public function index() {

		// モデルのロード
		$this->loadModel('MenuConfig');
		$menuInfo = $this->MenuConfig->getInfo($this->userId);

		// menuの分岐
		if(!empty($menuInfo) && $menuInfo["MenuConfig"]["use_flg"] == 1
				&& ($menuInfo["MenuConfig"]["mode"] == 1 || $menuInfo["MenuConfig"]["mode"] == 2)){
			$this->set('menuMode', $menuInfo["MenuConfig"]["mode"]);
		}

		$this->loadModel('Block');
		$jsonData = $this->Block->getPreviewData($this->userId);
		$this->set('Block', $jsonData);

	}
}