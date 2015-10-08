<?php

/**
* トップ情報のロジックを記述するモデルです。
* DB接続は行わないです。
*/

App::uses('AppModel', 'Model');

class BlockLogic extends AppModel {

	var $useTable = false;
	
	/**
	* 店舗情報とイメージ情報をマージします。
	*/
	public function margeSimpleInfo($topInfo, $mediaInfoList) {

		// jsonの情報が何も無ければ、カラの画像だけ設定して戻る
		if (empty($topInfo['DtbBasicInfo']['info'])) {

			// noimageへ置換する
			$returnInfo = array();

			for($i=0; $i < 5; $i++) {
				$imageInfo = array(
					'url' => Router::url('/img/common/noimage/noimage_top_shop.png', true),
					'date' => '---- / -- / --',
					);

				$returnInfo['image_info_list'][] = $imageInfo;
			}

			return json_encode($returnInfo);
		}

		$topInfoObj = json_decode($topInfo['DtbBasicInfo']['info'], true);

		// 画像情報をマージする。
		// 画像情報が存在しなければ、noimageを返却する。
		if (empty($mediaInfoList) || empty($topInfoObj['image_id_list'])) {

			// noimageへ置換する
			$topInfoObj['image_url_list'] = array(
				'common/noimage/noimage_icon.png',
				);

		} else {

			// 置換する
			$urlList = array();

			foreach($topInfoObj['image_id_list'] as $imageId) {
				$urlList[] = $mediaInfoList[$imageId];
			}

			$topInfoObj['image_url_list'] = $urlList;
		}

		// jsonの形式にエンコードして返却する。
		return json_encode($topInfoObj);
	}

	/**
	* シンプル側の画像ID一覧を取得する。
	* JSON 形式で登録されている情報から、画像のID一覧を取得する。
	*/
	public function getSimpleTopImageIdList($topInfo) {

		// 何も無ければ、からの情報を戻す
		if (empty($shopInfo['DtbBasicInfo']['info'])) {
			return array();
		}

		// JSONを配列に変換する
		$shopInfoObj = json_decode($shopInfo['DtbBasicInfo']['info'], true);

		//　画像ID一覧を取得する。
		$returnIdList = array();
		foreach($shopInfoObj['image_id_list'] as $imageId) {
			$returnIdList[] = $imageId;
		}

		// 返却
		return $returnIdList;
	}

	/**
	* 保存するための情報を生成します。
	* ここでは、画像のIDを設定します。
	*/
	public function generateImageUpdateInfo($basicInfo, $mediaId) {

		// JSON形式　→　オブジェクトへ変換
		if (empty($basicInfo['DtbBasicInfo']['info'])) {
			$infoList = array();
		} else {
			$infoList = json_decode($basicInfo['DtbBasicInfo']['info'], true);
		}

		// 情報を混ぜる
		$infoList['image_id_list'] = array($mediaId);

		// 返却
		$basicInfo['DtbBasicInfo']['info'] = json_encode($infoList);
		return $basicInfo;
	}

	/**
	* 保存するための情報を生成します。
	* ここでは、店舗の情報をマージします。
	*/
	public function generateUpdateInfo($basicInfo, $updateInfo) {

		// JSON形式　→　オブジェクトへ変換
		if (empty($basicInfo['DtbBasicInfo']['info'])) {
			$infoList = array();
		} else {
			$infoList = json_decode($basicInfo['DtbBasicInfo']['info'], true);
		}

		// 情報を混ぜる
		$infoList['shop_info'] = $updateInfo;

		// 返却
		$basicInfo['DtbBasicInfo']['info'] = json_encode($infoList);
		return $basicInfo;
	}

	/**
	* 店舗情報を登録するバリデーション
	*/
	public function setRegistValidation() {

		$this->validate = array(
			'shop_name' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => 'お店の名前を入力してください'
					),
				'maxLength' => array(
					'rule' => array('maxLength', 255),
					'message', 'お店の名前は255文字以内で入力してください',
					),
				),
			);
	}
}