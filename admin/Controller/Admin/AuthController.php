<?php

App::uses('AppAdminController', 'Controller');


class AuthController extends AppAdminController {

	/**
	 * 前処理
	 */
	public function beforeFilter() {
		parent::beforeFilter();

		$this->layout = 'admin/login';

		// loginアクションをログインしなくても利用できるように設定
		$this->Auth->allow('login');
	}

	public function login() {

		// POSTだった場合は、ログイン処理を行います。
		// ログイン成功すれば、ログイン成功した後のページヘリダイレクト
		// 失敗した場合は、エラーメッセージを設定してもう一度ログイン画面を表示します。
		if ($this->request->is('post')) {
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . $this->request->data['User']['email'] . __('  ログインPOSTされました'), 'debug');
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . $this->request->data['User']['password'] . __('  ログインPOSTされました'), 'debug');

			if($this->Auth->login()) {

				// ログインが成功したので、最終ログイン日付を更新する
				$this->loadModel('User');
				$this->User->updateLastLogin();

				// ログイン成功時の処理
				$this->redirect(array(
					'controller' => $this->Auth->loginRedirect['controller'],
					'action'     => $this->Auth->loginRedirect['action']
				));
			} else {

				$this->log(__LINE__ . '::' . __METHOD__ . '::' .__('ログイン失敗'), 'debug');

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
		$this->Session->setFlash(__('ログアウトしました'), 'default', array('class' => 'alert alert-success'));
		$this->redirect('login');
	}
}
