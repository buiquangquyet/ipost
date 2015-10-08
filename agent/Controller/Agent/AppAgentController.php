<?php
App::uses('AppController', 'Controller');

class AppAgentController extends AppController {
    public $components = array(
        'Session',
        'Cookie',
        'Security',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User', //ユーザー情報のモデル
                    'fields' => array('username' => 'email'), //認証をusernameからemailカラムに変更
                    'scope' => array(
                        'User.status' => USER_STATUS_ENABLE, // ステータスが有効な人だけ有効
                        'User.type' => USER_TYPE_OYA // タイプが親の人だけ有効
                    ),
                )
            ),
            'loginAction'    => array('controller' => 'auth', 'action' => 'login'), //ログインを行なうaction
            'loginRedirect'  => array('controller' => 'top',  'action' => 'index'), //ログイン後のページ
            'logoutRedirect' => array('controller' => 'auth', 'action' => 'login') //ログアウト後のページ
        ),
    	'Paginator',
    	'PhpExcel'
    );

    public function beforeFilter() {
        parent::beforeFilter();
		error_reporting(0);
        $loginUserInfo = $this->Auth->user();
        $this->set('loginUserInfo', $loginUserInfo);

        $userId = AuthComponent::user('id');

        if ( ! empty($userId)) {
            try {
                $this->loadModel('User');
                $userInfo = $this->User->getInfo($userId);

            } catch (Exception $ex) {
                $this->log(__LINE__ . '::' . __METHOD__ . '::' . 'ログインに失敗しました。 ' . $ex->getMessage(), 'error');
                $this->Session->setFlash(__('ユーザが削除されております。'), 'flash_alert', array());
                $this->Auth->logout();
            }

        } else {
            // $this->Session->setFlash(__('ログインが無効になりました。'), 'flash_alert', array());
            $this->Auth->logout();
        }

        $this->layout = 'agent/default';

        // 言語設定。設定がされていたら、Cookieに設定してリダイレクト
        if (! empty($this->request->query['lang'])) {
            $this->Cookie->write('lang', $this->request->query['lang']);
            $this->redirect('/');
            return;
        }

        // クッキーに情報が入っていたら、情報を切り替え
        $langValue = $this->Cookie->read('lang');
        if (! empty($langValue)) {
            $this->lang = $langValue;
        }

        Configure::write('Config.language', $this->lang);
        Configure::load('ipost.php');

        $this->set('controller', $this->request->param('controller'));
    }

    /**
     * @param $displayData
     * @return mixed
     */
    protected function processingForDisplay($displayData) {
        return $displayData;
    }

    /**
    * メール送信処理
    */
    public function sendEmail($to, $subject, $template, $body=null) {
         // メールライブラリ読み込み
        App::uses( 'CakeEmail', 'Network/Email');
        $email = new CakeEmail();
        $res = $email->config(array('log' => 'emails'))
            ->template($template, 'default')
            ->viewVars($body)
            ->from(array('support3@hiropro.co.jp' => __('iPost Enterprise運営事務局')))
            ->to($to)
            ->subject($subject)
            ->send();
    }

}
