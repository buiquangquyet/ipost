<?php

App::uses('AppImageModel', 'Model');

/**
 * 基本情報に関する基本クラスです.
 *
 * @author Rei.Hasegawa
 */
class ImageLogic extends AppImageModel {
	public $useTable = false;

	/**
	 * @param $data
	 * @return null
	 */
	public function get($data) {
		if (! array_key_exists('image_id', $data)) {
			return null;
		}

		$this->loadModel('Image');
		$image = $this->Image->get($data['image_id']);
		if (array_key_exists('Image', $image)) {
			return $image['Image'];
		}

		return null;
	}


	public function saveImage($userId, $data){
		if(isset($data['image_id']) && $data['image_id'] && $data['image']['tmp_name']=='') {
			$this->loadModel('Image');
			$rs = $this->Image->getImageInfo($data['image_id']);
			return $rs;
		}
		// からの時は何もしない
		if (empty($data['image']['tmp_name'])) {
			return;
		}

		$this->log(print_r($data,true), 'debug');

		// イメージの種類を取得する。リサイズ。
		if(!empty($data['imageType'])) {
			$resizeType = $data['imageType'];
		} else {
			$resizeType = 'normal';
		}
		$data['image']['tmp_name'] = $this->resize($data['image']['tmp_name'], $data['image']['type'], $resizeType);

		$image = $this->extractionImageData($data);
		$this->set($image);
		if (! $this->validates()) {
			throw new ValidateException(json_encode($this->validationErrors));
		}

		$this->loadModel('Image');
		$imageInfo['Image']['image_id'] = substr(md5(time()), rand(0, 20), 10);
		$imageInfo['Image']['file_name'] = $image['name'];
		$imageInfo['Image']['file'] = $image['file'];
		$imageInfo['Image']['mime'] = $image['type'];
		$imageInfo['Image']['lang'] = Configure::read('Config.language');
		$imageInfo = $this->Image->save($imageInfo);
		return $imageInfo;
	}

	public function saveData($userId, $data) {

		$imageInfo = $this->saveImage($userId, $data);

		// 元の情報をマージ
		$imageInfo['orgParams'] = $data;

		$this->loadModel('BasicInfo');
		$basicInfo = $this->BasicInfo->getInfo($userId, $this->infoName);

		$postData = $this->formatEachLogic($basicInfo['BasicInfo']['info'], $imageInfo);

		$basicInfo['BasicInfo']['info'] = $postData;
		unset($basicInfo['BasicInfo']['modified']);

		$this->BasicInfo->save($basicInfo);
	}

	public function extractionImageData($data) {
		$extData = $data['image'];
		$extData['file'] = file_get_contents($extData['tmp_name']);
		return $extData;
	}

	// Hss add function
	public function getApiImage($data) {
		if (! array_key_exists('image_id', $data)) {
			return null;
		}

		$this->loadModel('Image');
		$conditions = array(
				'conditions' => array(
						'image_id' => $data['image_id'],
						'status' => 1,
				)
		);

		$image = $this->Image->find('all', $conditions);
		if (array_key_exists('Image', $image[0])) {
			return $image[0]['Image'];
		}

		return null;
	}
}
