<?php

App::uses('AppController', 'Controller');

/**
* 基底クラスです。
* 他の基底クラスとの違いは、Authコンポーネントの承認時に利用するモデルと、
* ログインアクションとかになります。
* 管理画面を実装するときは、このAppAdminControllerを継承してください。
* ログインの機能が提供されます。
*/
class AppPreviewController extends AppController {
    public $components = array(
        'Session',
        'Cookie',
        'Security',
    );

    // ユーザIDの情報
    protected $userId = '';

//     protected $lang = 'ja';
    var $language, $availableLanguages;

    // 前処理
    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'admin/preview';

        /* $langValue = $this->Cookie->read('lang');
        if (!empty($langValue)) {
            $this->lang = $langValue;
        }

        Configure::write('Config.language', $this->lang);
        Configure::load('ipost.php');

        // ユーザIDを取得する。
        if (!isset($this->request->query['user_id'])) {
        	throw new Exception(__('ユーザIDが指定されていません。'));
	    }
        $this->userId = $this->request->query['user_id'];
        $this->set('userId', $this->userId); */

        Configure::load('ipost.php');

        // ユーザIDを取得する。
        if (!isset($this->request->query['user_id'])) {
        	throw new Exception(__('ユーザIDが指定されていません。'));
        }
        $this->userId = $this->request->query['user_id'];
        $this->set('userId', $this->userId);
        if (! empty($this->userId)) {
        	try {
        		$this->loadModel('User');
        		$userInfo = $this->User->getInfo($this->userId);
        		$allow = $userInfo[0]['UserLang'][0]['allow_flg']?$userInfo[0]['UserLang'][0]['allow_flg']:0;
        		if($allow) {
        			$languages = Configure::read('multilanguages');//$userInfo[0]['UserLang'][0]['lang'];
        			$lang = $languages[$userInfo[0]['UserLang'][0]['lang']];
        			$this->setLang($lang);
        		}
        	} catch (Exception $ex) {
        		$this->Session->setFlash(__('ユーザが削除されております。'), 'flash_alert', array());
        	}
        }

        if($this->Session->check('Config.language')) { // Check for existing language session
        	$this->language = $this->Session->read('Config.language'); // Read existing language
        } else {
        	$this->language = Configure::read('defaultLanguage'); // No language session => get default language from Config file
        }
        $this->setLang($this->language); // call protected method setLang with the lang shortcode
        if (isset($this->request->query['lang'])) {
            $this->setLang($this->request->query['lang']);
        }

        // サイドメニューの取得
        $this->getSidemenu();

        // ヘッダ取得
        $this->getHeader();

        // フッタメニューの取得
        $this->getFooter();

        // バックグラウンド情報の設定
        $this->getBackground();
    }

    /**
    * 背景情報の取得
    */
    private function getBackground() {

        $this->loadModel('Background');
        $backgroundInfo = $this->Background->getPreviewData($this->userId);
        $this->set('backgroundInfo', $backgroundInfo);
    }

    /**
    * サイドメニューの情報を取得する。
    */
    private function getSidemenu() {

    	$this->loadModel('Sidemenu');
    	$sidemenuInfo = $this->Sidemenu->getPreviewData($this->userId);
    	$this->set('sidemenuInfo', $sidemenuInfo);

    }

    /**
    * ヘッダ部分の情報を取得スル。
    */
    private function getHeader() {
        $this->loadModel('Header');
        $headerInfo = $this->Header->getPreviewData($this->userId);
        $this->set('headerInfo', $headerInfo);
    }

    /**
    * フッタ部分の情報を取得する。
    */
    private function getFooter() {

    	$this->loadModel('Footer');
    	$footerInfo = $this->Footer->getPreviewData($this->userId);
    	$this->set('footerInfo', $footerInfo);

    }
}