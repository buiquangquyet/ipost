<?php

App::uses('AppController', 'Controller');

/**
* 基底クラスです。
* 他の基底クラスとの違いは、Authコンポーネントの承認時に利用するモデルと、
* ログインアクションとかになります。
* 管理画面を実装するときは、このAppAdminControllerを継承してください。
* ログインの機能が提供されます。
*/
class AppAdminController extends AppController {

    // 言語指定
    public $lang = 'ja';
    var $language, $availableLanguages;

    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User', //ユーザー情報のモデル
                    'fields' => array('username' => 'email'), //認証をusernameからemailカラムに変更
                    'scope' => array(
                        'User.status' => USER_STATUS_ENABLE, // ステータスが有効な人だけ有効
                        'User.type'   => USER_TYPE_KO, // タイプが子の人だけ有効
                    ),
                )
            ),
            'loginAction'    => array('controller' => 'auth', 'action' => 'login'), //ログインを行なうaction
            'loginRedirect'  => array('controller' => 'top',  'action' => 'index'), //ログイン後のページ
            'logoutRedirect' => array('controller' => 'auth', 'action' => 'login') //ログアウト後のページ
        ),
        'Security',
        'Cookie'
    );

    public function beforeFilter() {
        parent::beforeFilter();

        $loginUserInfo = $this->Auth->user();
        $this->set('loginUserInfo', $loginUserInfo);

        $userId = AuthComponent::user('id');

		$languages = Configure::read('multilanguages');//$userInfo[0]['UserLang'][0]['lang'];
        if (! empty($userId)) {
            try {
                $this->loadModel('User');
                $userInfo = $this->User->getInfo($userId);
				$lang = $languages[$userInfo[0]['User']['lang']];
				$this->setLang($lang);
            } catch (Exception $ex) {
                $this->Session->setFlash(__('ユーザが削除されております。'), 'flash_alert', array());
                $this->Auth->logout();
            }
        } else {
            //$this->Session->setFlash(__('ログインが無効になりました。'), 'flash_alert', array());
            $this->Auth->logout();
        }

        $this->layout = 'admin/default';

        Configure::load('ipost.php');
        if($this->Session->check('Config.language')) { // Check for existing language session
        	$this->language = $languages[$this->Session->read('Config.language')]; // Read existing language
        } else {
        	$this->language = $languages[Configure::read('defaultLanguage')]; // No language session => get default language from Config file
        }

        ///////////////////////////////////////////////////////
        // 言語設定。設定がされていたら、Cookieに設定してリダイレクト
        if (!empty($this->request->query['lang'])) {
        	// クッキーに情報が入っていたら、情報を切り替え
        	$langValue = $this->request->query['lang'];
        	if (!empty($langValue)) {
        		$this->language = $langValue;
        	}
        	$this->setLang($languages[$this->language]);
        }
        ////////////////////////////////////////////////////////////
        $this->setLang($this->language); // call protected method setLang with the lang shortcode
    }

//     protected function setLang($lang) { // protected method used to set the language
//     	$this->Session->write('Config.language', $lang); // write our language to session
//     	Configure::write('Config.language', $lang); // tell CakePHP that we're using this language
//     }

    /**
     * @param $displayData
     * @return mixed
     */
    protected function processingForDisplay($displayData) {
        return $displayData;
    }
}