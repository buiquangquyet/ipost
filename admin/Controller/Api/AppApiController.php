<?php

App::uses('AppController', 'Controller');

/**
* 基底クラスです。
* 他の基底クラスとの違いは、Authコンポーネントの承認時に利用するモデルと、
* ログインアクションとかになります。
* APIを実装するときは、このAppAdminControllerを継承してください。
* ログインの機能が提供されます。
*/
class AppApiController extends AppController {

	// コンポーネント読み込み
	public $components = array(
		'Session',
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'User', //ユーザー情報のモデル
					'fields' => array('username' => 'email'), //認証をusernameからemailカラムに変更
					'scope' => array('User.status' => USER_STATUS_ENABLE), // ステータスが有効な人だけ有効
				)
			),
			'loginAction' => array('controller' => 'Auth','action' => 'login'), //ログインを行なうaction
			'loginRedirect' => array('controller' => 'AdminTop', 'action' => 'index'), //ログイン後のページ
			'logoutRedirect' => array('controller' => 'Auth', 'action' => 'login') //ログアウト後のページ
		),
		'Security',
	);

	/**
	* 前処理。
	*/
	public function beforeFilter() {
		parent::beforeFilter();
	}

	/**
	* 画像を一時領域に保存します。
	*/
	public function registTmpImage($fileName, $fullPath) {
		// 画像のサイズを変更する。

		// 一時保存エリアに移動しておく
		// まずはファイルの拡張子を取得する。
		// ファイル名を生成して、tmpのディレクトリへ移動する。
		$ext = pathinfo($fileName, PATHINFO_EXTENSION);
		$tmpFileName = Security::hash(time() . rand(), 'sha1', true) . '.' . $ext;
		$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('画像の一時ファイル移動先-->') . WWW_ROOT . MEDIA_TMP_DIR . '/' . $tmpFileName, 'debug');
		if (!move_uploaded_file($fullPath, WWW_ROOT . MEDIA_TMP_DIR . '/' . $tmpFileName)) {
			throw new Exception(__('ファイルの移動に失敗しました。'));
		}

		return $tmpFileName;
	}

	/**
	* 画像をユーザのディレクトリに移動します。
	*/
	public function moveImage() {
		$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('画像を登録開始-->') . print_r($this->request->data, true), 'debug');

		// 引数チェック　空っぽだったら例外
		if (empty($this->request->data['tmpFileName'])) {
			throw new Exception(json_encode(__('画像が指定されていません')));
		}

		// 引数に指定してあるファイル名が存在するか確認します。存在しなければ例外
		$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('画像をチェック-->') . WWW_ROOT . MEDIA_TMP_DIR . '/' . $this->request->data['tmpFileName'], 'debug');
		$fileExists = file_exists(WWW_ROOT . MEDIA_TMP_DIR . '/' . $this->request->data['tmpFileName']);
		if (!$fileExists) {
			throw new Exception(json_encode(__('画像の一時ファイルが見つかりません。')));
		}


		// ファイルをユーザのディレクトリに移動する
		// もし、ユーザのディレクトリが存在しなければ作成してから移動する。
		$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('ディレクトリチェック-->') . WWW_ROOT . MEDIA_UPLAOD_DIR_BASE . '/' . AuthComponent::user('id'), 'debug');
		$dirExists = file_exists(WWW_ROOT . MEDIA_UPLAOD_DIR_BASE . '/' . AuthComponent::user('id'));
		if (!$dirExists) {
			// ユーザのディレクトリが無いので作成。作成失敗したら例外
			$mkDirResult = mkdir(WWW_ROOT . MEDIA_UPLAOD_DIR_BASE . '/' . AuthComponent::user('id'));
			if (!$mkDirResult) {
				throw new Exception(json_encode(__('ユーザディレクトリの作成に失敗しました')));
			}
		}

		//　画像の拡張子を取得する
		$ext = pathinfo(WWW_ROOT . MEDIA_TMP_DIR . '/' . $this->request->data['tmpFileName'], PATHINFO_EXTENSION);

		// 移動
		$userFileName = Security::hash(time() . rand(), 'sha1', true) . '.' . $ext;
		$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('移動先ファイル-->') . WWW_ROOT . MEDIA_UPLAOD_DIR_BASE . '/' . AuthComponent::user('id') . '/' . $userFileName, 'debug');
		$moveResult = rename(WWW_ROOT . MEDIA_TMP_DIR . '/' . $this->request->data['tmpFileName'], WWW_ROOT . MEDIA_UPLAOD_DIR_BASE . '/' . AuthComponent::user('id') . '/' . $userFileName);
		if(!$moveResult) {
			throw new Exception(json_encode(__('ファイルの移動に失敗しました。')));
		}

		return $userFileName;
	}
}