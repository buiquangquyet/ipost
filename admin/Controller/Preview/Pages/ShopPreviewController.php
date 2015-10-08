<?php

App::uses('AppPreviewController', 'Controller');

class ShopPreviewController extends AppPreviewController {

    /**
     * 画面表示.
     */
    public function index() {
    }

    public function profile() {
        // ショップ情報取得して、セット
        $this->loadModel('Shop');
        $jsonData = json_decode($this->Shop->getData($this->userId), true);
        $this->set('Shop', $jsonData);
    }
}