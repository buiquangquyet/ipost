<?php

App::uses('AppManagerController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class AuthController extends AppManagerController {
    public function beforeFilter() {
        parent::beforeFilter();

        // レイアウトファイルをログイン用に変更
        $this->layout = 'manager/login';

        // loginアクションをログインしなくても利用できるように設定
        $this->Auth->allow('login', 'regist');

        // ブラックホールコールバック指定
        $this->Security->blackHoleCallback = 'blackhole';
    }



    public function login() {
        // POSTだった場合は、ログイン処理を行います。
        // ログイン成功すれば、ログイン成功した後のページヘリダイレクト
        // 失敗した場合は、エラーメッセージを設定してもう一度ログイン画面を表示します。
        if ($this->request->is('post')) {
            $this->log(__LINE__ . '::' . __METHOD__ . '::' . $this->request->data['User']['email'] . '  ログインPOSTされました', LOG_DEBUG);
            $this->log(__LINE__ . '::' . __METHOD__ . '::' . $this->request->data['User']['password'] . '  ログインPOSTされました', LOG_DEBUG);

            if ($this->Auth->login()) {

                // ログインが成功したので、最終ログイン日付を更新する
                $this->loadModel('User');
                $this->User->updateLastLogin();

                // ログイン成功時の処理
                $this->redirect(array(
                    'controller' => $this->Auth->loginRedirect['controller'],
                    'action'     => $this->Auth->loginRedirect['action']
                ));

            } else {
                $this->log(__LINE__ . '::' . __METHOD__ . '::' . 'ログイン失敗', LOG_DEBUG);

                // ログイン失敗時の処理
                $this->Session->setFlash(__('ログインID or パスワードが間違っています'), 'default', array('class' => 'alert alert-danger'));
            }
        }

        // 特にPOSTではない場合は普通にビューを表示して終わる。
    }

    /**
     * ログアウト処理
     */
    public function logout() {
        $this->Auth->logout();
        $this->Session->setFlash(__('ログアウトしました'), 'default', array('class' => 'alert alert-info'));
        $this->redirect('login');
    }

    /**
     * アカウント発行
     */
    public function regist() {
        if ($this->request->is('post')) {
            $this->loadModel('User');
            $result = $this->User->saveData(null, $this->request->data);
            if ( ! $result) {
                $this->Session->setFlash(__('マスターの依頼登録に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('マスターを依頼登録しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'login'));
            }
        }
    }

    /**
     * ブラックホールコールバック
     */
    public function blackhole($type){
        switch($type){
            case 'csrf' :
                $this->Session->setFlash(__('不正な送信が行われました'), 'default', array('class' => 'alert alert-danger'));
                $this->redirect(array('controller' => 'auth', 'action' => $this->action));
                break;
            default :
                $this->redirect(array('controller' => 'top', 'action' => 'index'));
                break;
        }
    }

}
