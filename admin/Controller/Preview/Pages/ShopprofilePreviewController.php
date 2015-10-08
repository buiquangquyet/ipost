<?php

App::uses('AppPreviewController', 'Controller');

class ShopprofilePreviewController extends AppPreviewController {

    /**
     * 画面表示.
     */
    public function index() {
        $this->redirect(array('controller' => 'ShopPreview', 'action' => 'profile?user_id='. $this->userId));
    }
}