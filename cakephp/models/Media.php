<?php

/**
* 各種情報を取得するためのモデルです。
* dtb_mediasを操作するモデルです。
*/

App::uses('AppModel', 'Model');

class Media extends AppModel {

	public function get($userId, $mediaId) {

		$conditionList = array(
			'conditions' => array(
				'id'      => $mediaId,
				'user_id' => $userId,
				//'lang'    => Configure::read('Config.language'),
			),
		);

		return $this->find('first', $conditionList);
	}

	public function forceGet($mediaId) {

		$conditionList = array(
				'conditions' => array(
						'id'      => $mediaId,
						//'user_id' => $userId,
				),
		);

		return $this->find('first', $conditionList);
	}

	/**
	* 登録されているメディア情報を取得します。
	* IDにはプライマリーキーを指定してください。配列入れると、IN検索になります。
	*/
	public function getMediaPath($id) {

		// 情報を取得する。内容をチェックして、条件に当てはまらなかったら
		// 例外を出します。
		$conditionList = array(
			'fields' => array(
				'id',
				'webroot_path'
				),
			'conditions' => array(
				'id' => $id,
				'status' => MEDIA_STATUS_ENABLE,
				'lang'    => Configure::read('Config.language'),
			),
		);

		$mediaInfo = $this->find('list', $conditionList);
		return $mediaInfo;
	}

	public function getInfo($userId, $type) {

		$conditionList = array(
			'conditions' => array(
				'user_id' => $userId,
				'type' => $type,
				'lang'    => Configure::read('Config.language'),
			),
		);

		return $this->find('first', $conditionList);
	}

	/**
	* メディアを登録します
	* ファイルパスを元に以下の情報を取得します。
	* ・フルパス
	* ・webrootのパス
	* ・ファイル名
	* ・mime
	* 返却はオートインクリメントのIDです。
	*/
	public function registMedia($userId, $fileName) {

		// mimeの取得
		$fileInfoObj = finfo_open(FILEINFO_MIME_TYPE);
		$mimeType = finfo_file($fileInfoObj, WWW_ROOT . MEDIA_UPLAOD_DIR_BASE . '/' . AuthComponent::user('id') . '/' . $fileName);
		finfo_close($fileInfoObj);

		// 条件の生成
		$insertInfo = array(
			'user_id' => AuthComponent::user('id'),
			'full_path' => WWW_ROOT . MEDIA_UPLAOD_DIR_BASE . '/' . AuthComponent::user('id') . '/' . $fileName,
			'webroot_path' => $this->webroot . MEDIA_UPLAOD_DIR_BASE . '/' . AuthComponent::user('id') . '/' . $fileName,
			'file_name' => $fileName,
			'mime_type' => $mimeType,
			'lang'    => Configure::read('Config.language'),
			);

		// 保存
		$this->save($insertInfo, array('validation' => false));

		// IDを取得する
		return $this->getLastInsertID();
	}

	public function getImageById($mediaId) {

		$conditionList = array(
			'conditions' => array(
				'id'      => $mediaId,
				//'lang'    => Configure::read('Config.language'),
			),
		);

		return $this->find('first', $conditionList);
	}
}