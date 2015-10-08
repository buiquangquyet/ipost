<?php
App::uses('AppManagerController', 'Controller');
/**
* 代理店サポート関係のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class SupportAgentController extends AppManagerController {

    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /** //////////////////////////////////////////////////
    * お知らせ項目管理
    * @access  public
    */
    public function info_index() {
        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
        $this->render('info/index');
    }

    /**
    * お知らせ項目管理
    * @access  public
    */
    public function info_list() {
        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
        $this->render('info/list');
    }

    /**
    * お知らせ項目管理
    * @access  public
    */
    public function info_add() {
        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
        $this->render('info/add');
    }

    /** //////////////////////////////////////////////////
    * ヘルプ項目管理
    * @access  public
    */
    public function help_index() {
        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
        $this->render('help/index');
    }

    /**
    * お知らせ項目管理
    * @access  public
    */
    public function help_list() {
        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
        $this->render('help/list');
    }

    /**
    * お知らせ項目管理
    * @access  public
    */
    public function help_add() {
        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
        $this->render('help/add');
    }

    /** //////////////////////////////////////////////////
    * よくある質問項目管理
    * @access  public
    */
    public function faq_index() {
        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
        $this->render('faq/index');
    }

    /**
    * お知らせ項目管理
    * @access  public
    */
    public function faq_list() {
        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
        $this->render('faq/list');
    }

    /**
    * お知らせ項目管理
    * @access  public
    */
    public function faq_add() {
        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
        $this->render('faq/add');
    }

}
