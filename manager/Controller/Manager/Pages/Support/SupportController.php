<?php
App::uses('AppManagerController', 'Controller');
/**
* サポート関係のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class SupportController extends AppManagerController {

    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /** //////////////////////////////////////////////////
    * リジェクト項目管理
    * @access  public
    */
    public function reject_index() {
        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
        $this->render('reject/index');
    }

    /**
    * リジェクト項目管理
    * @access  public
    */
    public function reject_list() {
        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
        $this->render('reject/list');
    }

    /**
    * リジェクト項目管理
    * @access  public
    */
    public function reject_add() {
        $this->Session->setFlash(__('まだ機能はできていないです。'), 'default', array('class' => 'alert alert-info'));
        $this->render('reject/add');
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

}
