<?php

App::uses('AppImageModel', 'Model');


/**
 * 基本情報に関する基本クラスです.
 *
 * @author Rei.Hasegawa
 */
class MediaLogic extends AppImageModel {
	public $useTable = false;
	protected $infoName = '';
	protected $mediaName = '';

	/**
	 * 継承先のクラスで $infoName が設定されているかを確認します.
	 *
	 * @throws Exception クラスの初期設定が完了していない場合
	 */
	private function checkInitializeSetting() {

		// クラスの設定が完了していない場合
		if (empty($this->infoName)) {
			throw new Exception('モジュールの初期設定が行われておりません。class_name => ' . get_class($this));
		}
	}

	/**
	 * @param $userId
	 * @param $data
	 * @return null
	 */
	public function get($userId, $data) {
		if (! array_key_exists('id', $data)) {
			return null;
		}

		$this->loadModel('Media');
		$media = $this->Media->get($userId, $data['id']);
		if (array_key_exists('Media', $media)) {
			return $media['Media'];
		}

		return null;
	}

	public function forceGet($data) {

		$this->loadModel('Media');
		$media = $this->Media->forceGet($data['id']);

		if (array_key_exists('Media', $media)) {
			return $media['Media'];
		}

		return null;
	}

	/**
	 * 基本情報にデータを保存します.
	 *
	 * @param string $data dtb_basic_infos.infoに保存するデータ
	 */
	public function saveData($userId, $data) {

		$this->checkInitializeSetting();

		$this->log(print_r($data,true), 'debug');

		// イメージの種類を取得する。リサイズ。
		if(!empty($data['imageType'])) {
			$resizeType = $data['imageType'];
		} else {
			$resizeType = 'normal';
		}
		$data['image']['tmp_name'] = $this->resize($data['image']['tmp_name'], $data['image']['type'], $resizeType);

		$media = $this->extractionMediaData($data);
		$this->set($media);
		if (! $this->validates()) {
			throw new ValidateException(json_encode($this->validationErrors));
		}

		$this->loadModel('Media');
		$mediaInfo = $this->Media->getInfo($userId, $this->mediaName);
		if (empty($mediaInfo)) {
			$mediaInfo['Media']['user_id'] = $userId;
			$mediaInfo['Media']['type']    = $this->mediaName;
		}

		$mediaInfo['Media']['file_name'] = $media['name'];
		$mediaInfo['Media']['file']      = $media['file'];
		$mediaInfo['Media']['mime']      = $media['type'];
		$imageInfo['Media']['lang'] = Configure::read('Config.language');
		unset($mediaInfo['Media']['modified']);

		$mediaInfo = $this->Media->save($mediaInfo);

		// モデルの読込
		$this->loadModel('BasicInfo');
		$basicInfo = $this->BasicInfo->getInfo($userId, $this->infoName);

		$postData = $this->formatEachLogic($basicInfo['BasicInfo']['info'], $mediaInfo);

		$basicInfo['BasicInfo']['info'] = $postData;
		unset($basicInfo['BasicInfo']['modified']);

		$this->BasicInfo->save($basicInfo);
	}

	/**
	 * 各ロジックごとにデータを整形する場合には、オーバーライドしてください。
	 *
	 * @param
	 */
	protected function formatEachLogic($info, $mediaInfo) {
		return $info;
	}

	/**
	 * 各ロジックごとに入力情報のパラメータ名が異なる場合には、オーバーライドしてください。
	 *
	 * @param $data
	 * @return mixed
	 */
	protected function extractionMediaData($data) {
		$extData = $data['image'];
		$extData['file'] = file_get_contents($extData['tmp_name']);
		return $extData;
	}

	public function getImageById($data) {
		if (! array_key_exists('id', $data)) {
			return null;
		}

		$this->loadModel('Media');
		$media = $this->Media->getImageById($data['id']);
		if (array_key_exists('Media', $media)) {
			return $media['Media'];
		}

		return null;
	}
}
