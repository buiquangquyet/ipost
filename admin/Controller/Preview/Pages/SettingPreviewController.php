<?php

App::uses('AppPreviewController', 'Controller');

class SettingPreviewController extends AppPreviewController {

    /**
     * 画面表示.
     */
    public function index() {
        // ショップ情報取得して、セット
        $this->loadModel('Shop');
        $jsonData = json_decode($this->Shop->getData($this->userId), true);
        $this->set('Shop', $jsonData);
    }
}