<?php

/**
* トップ画面のAPIコントローラです。
*/

App::uses('AppAdminController', 'Controller');

class ApiBlockController extends AppAdminController {

	/**
	* 前処理
	*/
	public function beforeFilter() {
		$this->autoRender = false;

		// うーん。。。
        $this->Security->csrfCheck = false;
        $this->Security->validatePost = false;
		parent::beforeFilter();
	}

	/**
	* ログインユーザのトップ情報（シンプル）を取得します。
	* トップ情報はすべてjson形式で返却されます。
	*/
	public function json_get_top_simple_data() {

		try {
			//　ユーザの保持する情報を取得する
			$this->loadModel('DtbBasicInfo');
			$topSimpleInfo = $this->DtbBasicInfo->getData('topSimpleInfo', AuthComponent::user('id'));
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('基本情報から取得') . print_r($topSimpleInfo, true), 'debug');

			// 画像のID一覧を取得する。
			$this->loadModel('BlockLogic');
			$imageIdList = $this->BlockLogic->getSimpleTopImageIdList($topSimpleInfo);
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('画像ID一覧') . print_r($imageIdList, true), 'debug');

			// 画像の情報を取得する。
			$this->loadModel('DtbMedia');
			$mediaInfoList = $this->DtbMedia->getMediaPath($imageIdList);
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('画像情報一覧') . print_r($mediaInfoList, true), 'debug');

			// 情報をマージする
			$returnJson = $this->BlockLogic->margeSimpleInfo($topSimpleInfo, $mediaInfoList);

			// JSON形式で返却
			echo $returnJson;

		} catch(Exception $e) {
			$returnValue = array(
				'error_code' => API_CODE_ERROR,
				'message' => $e->getMessage(),
				);

			echo json_encode($returnValue);
		}
	}

	/**
	* 店舗の画像情報を登録します。
	*/
	public function shop_image_regist() {
		try {

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

			// DBに登録する
			$this->loadModel('DtbMedia');
			$this->DtbMedia->begin();
			$mediaId = $this->DtbMedia->registMedia(AuthComponent::user('id'), $userFileName);
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('メディア登録ID') . $mediaId, 'debug');

			$this->loadModel('DtbBasicInfo');
			$basicInfo = $this->DtbBasicInfo->getData('shopInfo', AuthComponent::user('id'));
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('基礎情報') . print_r($basicInfo, true) , 'debug');

			$this->loadModel('ShopLogic');
			$updateInfo = $this->ShopLogic->generateImageUpdateInfo($basicInfo, $mediaId);
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('登録情報') . print_r($updateInfo, true) , 'debug');

			$this->DtbBasicInfo->updateInfo($updateInfo);

			$this->DtbMedia->commit();

			// 結果を返却
			return $this->json_get_shop_data();

		} catch(Exception $e) {
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('画像を登録例外-->') . print_r($e->getMessage(), true), 'debug');

			//　例外発生したので、エラーを返却する
			$returnValueList = array(
				'code' => API_CODE_ERROR,
				'errorInfo' => json_decode($e->getMessage()),
				);

			echo json_encode($returnValueList);
		}
	}

	/**
	* 画像を一時的に登録します。
	* テンポラリに画像情報を登録しておきます。
	* 返却されるのは、URLのパスです。
	*/
	public function image_tmp_regist() {

		try {
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('画像を一時登録開始-->') . print_r($this->request->data, true), 'debug');

			// mimeの種類を確認する。許可しないやつなら例外
			// また、ファイルサイズも確認
			$this->loadModel('BlockLogic');
			$this->BlockLogic->setImageFilecheckValidation();
			$this->BlockLogic->set($this->request->data);
			if(!$this->BlockLogic->validates()) {
				throw new Exception(json_encode($this->BlockLogic->validationErrors));
			}

			// 画像のサイズを変更する。

			// 一時保存エリアに移動しておく
			// まずはファイルの拡張子を取得する。
			// ファイル名を生成して、tmpのディレクトリへ移動する。
			$ext = pathinfo($this->request->data['BlockLogic']['mediaFile']['name'], PATHINFO_EXTENSION);
			$tmpFileName = Security::hash(time() . rand(), 'sha1', true) . '.' . $ext;
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('画像の一時ファイル移動先-->') . WWW_ROOT . MEDIA_TMP_DIR . '/' . $tmpFileName, 'debug');
			if (!move_uploaded_file($this->request->data['BlockLogic']['mediaFile']['tmp_name'], WWW_ROOT . MEDIA_TMP_DIR . '/' . $tmpFileName)) {
				throw new Exception(__('ファイルの移動に失敗しました。'));
			}

			// 情報を返却する
			$returnValueList = array(
				'code' => API_CODE_SUCCESS,
				'pos' => $this->request->data['BlockLogic']['imgDataPos'],
				'url' => $this->webroot . '/' . MEDIA_TMP_DIR . '/' . $tmpFileName,
				'fileName' => $tmpFileName,
			);
			echo json_encode($returnValueList);

		} catch(Exception $e) {

			$this->log(__LINE__ . '::' . __METHOD__ . '::' .__('画像を一時登録例外-->') . print_r($e, true), 'debug');

			//　例外発生したので、エラーを返却する
			$returnValueList = array(
				'code' => API_CODE_ERROR,
				'pos' => $this->request->data['BlockLogic']['imgDataPos'],
				'errorInfo' => json_decode($e->getMessage()),
				);

			echo json_encode($returnValueList);
		}
	}

	/**
	* 店舗の画像を削除します。
	*/
	public function shop_image_delete() {

	}

	/**
	* 店舗情報を登録します。
	*/
	public function shop_regist() {
		try {
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('店舗登録情報-->') . print_r($this->request->data, true), 'debug');

			// バリデーション
			$this->loadModel('ShopLogic');
			$this->ShopLogic->setRegistValidation($this->request->data['ShopLogic']);
			$this->ShopLogic->set($this->request->data['ShopLogic']);
			if(!$this->ShopLogic->validates()) {
				throw new Exception(json_encode($this->ShopLogic->validationErrors));
			}

			// 登録の準備。まずは基本情報を取得する。その情報に今回追加する情報をマージする
			$this->loadModel('DtbBasicInfo');
			$this->DtbBasicInfo->begin();
			$basicInfo = $this->DtbBasicInfo->getData('shopInfo', AuthComponent::user('id'));
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('基礎情報') . print_r($basicInfo, true) , 'debug');

			// マージ
			$updateInfo = $this->ShopLogic->generateUpdateInfo($basicInfo, $this->request->data['ShopLogic']);
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('登録情報') . print_r($updateInfo, true) , 'debug');
			$this->DtbBasicInfo->updateInfo($updateInfo);
			$this->DtbBasicInfo->commit();

			//　値の返却
			return $this->json_get_shop_data();

		} catch(Exception $e) {
			$this->log(__LINE__ . '::' . __METHOD__ . '::' . __('店舗登録例外-->') . print_r($e->getMessage(), true), 'debug');

			//　例外発生したので、エラーを返却する
			$returnValueList = array(
				'code' => API_CODE_ERROR,
				'errorInfo' => json_decode($e->getMessage()),
				);

			echo json_encode($returnValueList);
		}
	}
}