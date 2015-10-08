<?php
/**
 * 基本情報に関する基本クラスです.
 *
 * @author Rei.Hasegawa
 */
abstract class BasicInfoLogic extends AppModel {
	public $useTable = false;
	protected $infoName = '';

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
	 * 必要な情報を取得します.
	 *
	 * @return type
	 * @throws Exception
	 */
	public function getData($userId) {
		// 初期設定の確認
		$this->checkInitializeSetting();

		// モデルの読込
		$this->loadModel('BasicInfo');

		// 基本情報の取得
		// thu thap thong tin co ban lấy mã html
		$basicInfo = $this->BasicInfo->getInfo($userId, $this->infoName);


		// Hss add for get data from default language
		$this->loadModel('User');
		//get user info
		$userInfo = $this->User->getInfo($userId);
		//get lang user
		$lang = $userInfo[0]['User']['lang'];
		//
		$languages = Configure::read('codeMultilanguages');
		if (! array_key_exists('BasicInfo', $basicInfo)/*  && in_array($lang, $languages) */) {
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
		/* if (! array_key_exists('BasicInfo', $basicInfo)) {
			// 基本情報が存在しない場合

			// 最低限の情報を生成
			$basicInfo = array(
				'user_id' => $userId,
				'type'    => $this->infoName,
				'info'    => json_encode(Configure::read($this->infoName)),
				'lang'    => Configure::read('Config.language'),
			);

			// 最低限の情報をテーブルに登録
			$this->BasicInfo->save($basicInfo);

			// 再度情報の取得を実施
			//$createData = $this->getData($userId);
			//return json_encode($createData);
			return json_encode(Configure::read($this->infoName));
		} */

		// 必要な情報を返却
		return $basicInfo['BasicInfo']['info'];
	}

	// Hss add $lang for multilanguage
	public function getDataApi($userId, $lang) {
		// モデルの読込
		$this->loadModel('BasicInfo');

		// 基本情報の取得
		$basicInfo = $this->BasicInfo->getInfoApi($userId, $this->infoName, $lang); // Hss add $lang for multilanguage

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
	}

	/**
	 * 基本情報にデータを保存します.
	 *
	 * @param string $data dtb_basic_infos.infoに保存するデータ
	 */
	public function saveData($userId, $data) {

		// 初期設定の確認
		$this->checkInitializeSetting();

		$this->set($data);
		if (! $this->validates()) {
			throw new ValidateException(json_encode($this->validationErrors));
		}

		// モデルの読込
		$this->loadModel('BasicInfo');
		//lay thong tin co ban
		$basicInfo = $this->BasicInfo->getInfo($userId, $this->infoName);
		//get $basicInfo['BasicInfo']['info']
		$postData = $this->formatEachLogic($basicInfo['BasicInfo']['info'], $data);
		$basicInfo['BasicInfo']['info'] = $postData;
		//bỏ modified
		unset($basicInfo['BasicInfo']['modified']);
		return $this->BasicInfo->save($basicInfo);
	}

	public function getInfoName() {
		return $this->infoName;
	}

	/**
	 * 各ロジックごとにデータを整形する場合には、オーバーライドしてください。
	 *
	 * @param
	 */
	protected function formatEachLogic($info, $data) {
		return $info;
	}

	/**
	 * 対象のプレビューデータを取得します。
	 * @param int $userId
	 * @return Object
	 */
	public function getPreviewData($userId) {
		$data = json_decode($this->getData($userId), true);
		return $data;
	}
}
