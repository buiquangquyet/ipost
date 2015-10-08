<?php

App::uses('AppPreviewController', 'Controller');

class MailPreviewController extends AppPreviewController {

    /**
     * 画面表示.
     */
    public function index() {
        $this->render('../Pages/TelPreview/index');
    }
}