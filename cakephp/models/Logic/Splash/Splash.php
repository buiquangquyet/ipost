<?php

App::uses('BasicInfoLogic', 'Model');

/**
* ヘッダ情報のロジックを記述するモデルです。
* DB接続は行わないです。
*/

App::uses('AppModel', 'Model');

class Splash extends BasicInfoLogic {
	protected $infoName = 'splash_info';
	protected $baseModel = 'Splash';

	/* // Hss add $lang for multilanguage
	public function getDataApi($userId, $lang=NULL) {
		// モデルの読込
		$this->loadModel('BasicInfo');

		// 基本情報の取得
		$basicInfo = $this->BasicInfo->getInfo($userId, $this->infoName);
		if($lang) $basicInfo = $this->BasicInfo->getInfo($userId, $this->infoName, $lang); // Hss add $lang for multilanguage

		if (! array_key_exists('BasicInfo', $basicInfo)) {
			// 基本情報が存在しない場合

			// 最低限の情報を生成
			$basicInfo = array(
					'user_id' => $userId,
					'type'    => $this->infoName,
					'info'    => json_encode(Configure::read($this->infoName)),
					'lang'    => $lang?$lang:Configure::read('Config.language'),
			);

			// 最低限の情報をテーブルに登録
			$this->BasicInfo->save($basicInfo);

			// 再度情報の取得を実施
			//$createData = $this->getData($userId);
			//return json_encode($createData);
			return json_encode(Configure::read($this->infoName));
		}

		// 必要な情報を返却
		return $basicInfo['BasicInfo']['info'];
	} */
}