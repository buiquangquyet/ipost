<?php
App::uses('AppManagerController', 'Controller');
/**
* サポート＞ヘルプ画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class SupportHelpController extends AppManagerController {

    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();

        // listsメソッドを、listとして扱う
        if ($this->action == "list") {
            $this->action = "lists";
        }
    }

    /**
    * お知らせ項目管理
    * @access  public
    */
    public function lists() {
        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
        $this->render('list');
    }

    /**
    * お知らせ項目管理
    * @access  public
    */
    public function add() {
        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
    }

}
