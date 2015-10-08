<?php

App::uses('BasicInfoLogic', 'Model');
App::uses('AppModel', 'Model');
class ShopSetting extends BasicInfoLogic {
	protected $infoName = 'shop_setting_info';

	/**
	 * 各ロジックごとにデータを整形する場合には、オーバーライドしてください。
	 *
	 * @param
	 */
	protected function formatEachLogic($info, $data) {
		$info = json_decode($info);
		$info->profile = $data;
		return json_encode($info);
	}

	var $validate = array(
		'shop_name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'お店の名前を入力してください',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 255),
				'message' => 'お店の名前は255文字以内で入力してください',
			),
		),
		'zip_code' => array(
			'between' => array(
				'rule' => array('between', 7, 7),
				'message' => '郵便番号は3桁と4桁で入力してください',
			),
			'postal' => array(
				'rule' => array('custom', '/^[0-9]+$/'),
				'message' => '郵便番号の形式が正しくありません',
			),
		),
		'pref' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => '都道府県を選択してください',
			),
		),
		'city' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => '市区町村を入力してください',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 255),
				'message' => '市区町村は255文字以内で入力してください',
			),
		),
		'address_opt1' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => '住所（番地）を入力してください',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 255),
				'message' => '住所（番地）は255文字以内で入力してください',
			),
		),
		'address_opt2' => array(
			// 'notEmpty' => array(
			// 	'rule' => 'notEmpty',
			// 	'message' => '住所（建物）を入力してください',
			// ),
			'maxLength' => array(
				'rule' => array('maxLength', 255),
				'message' => '住所（建物）は255文字以内で入力してください',
			),
		),
		'tel' => array(
			'maxLength' => array(
				'rule' => array('maxLength', 11),
				'message' => '電話番号は11文字以内で入力してください',
			),
			'tel' => array(
				'rule' => array('custom', '/^\d+$/'),
				'message' => '電話番号の形式が正しくありません',
			),
		),
		'fax' => array(
			'maxLength' => array(
				'rule' => array('maxLength', 11),
				'message' => 'FAXは11文字以内で入力してください',
			),
			'fax' => array(
				'rule' => array('custom', '/^\d+$/'),
				'message' => 'FAXの形式が正しくありません',
			),
		),
		'mobile_tel' => array(
			'maxLength' => array(
				'rule' => array('maxLength', 11),
				'message' => '携帯電話は11文字以内で入力してください',
			),
			'mobile_tel' => array(
				'rule' => array('custom', '/^\d+$/'),
				'message' => '携帯電話の形式が正しくありません',
			),
		),
		'email' => array(
			'email' => array(
				'rule' => 'email',
				'message' => 'メールアドレスの形式が正しくありません',
				'allowEmpty' => true,
			),
			'maxLength' => array(
				'maxLength' => array('maxLength', 255),
				'message' => 'メールアドレスは255文字以内で入力してください',
			),
		),
		'url' => array(
			'maxLength' => array(
				'rule' => array('maxLength', 255),
				'message' => 'ホームページアドレスは255文字以内で入力してください',
			),
			'url' => array(
				'rule' => 'url',
				'message' => 'URLの形式で入力してください',
				'allowEmpty' => true,
			),
		),
		'online_shop' => array(
			'maxLength' => array(
				'rule' => array('maxLength', 255),
				'message' => 'オンラインショップURLは255文字以内で入力してください',
			),
			'url' => array(
				'rule' => 'url',
				'message' => 'URLの形式で入力してください',
				'allowEmpty' => true,
			),
		),
		'open_hours' => array(
			'maxLength' => array(
				'rule' => array('maxLength', 255),
				'message' => '営業時間は255文字以内で入力してください',
			),
		),
		'holiday' => array(
			'maxLength' => array(
				'rule' => array('maxLength', 255),
				'message' => '営業時間は255文字以内で入力してください',
			),
		),
	);

	public function set($inputData, $two = null) {

		// 入力チェック用にフィールドを作成
		if (! empty($inputData['zip_code1']) || ! empty($inputData['zip_code2'])) {
			$inputData['zip_code'] = $inputData['zip_code1'] . $inputData['zip_code2'];
		}

		// 入力チェック用に条件を削除
		if (empty($inputData['pref']) && empty($inputData['city'])
				&& empty($inputData['address_opt1']) && empty($inputData['address_opt2'])) {
			$this->validator()->remove('pref', 'notEmpty');
			$this->validator()->remove('city', 'notEmpty');
			$this->validator()->remove('address_opt1', 'notEmpty');
			$this->validator()->remove('address_opt2', 'notEmpty');
		}

		// 入力チェック用にフィールドを作成
		if (! empty($inputData['tel1']) || ! empty($inputData['tel2']) || ! empty($inputData['tel3'])) {
			$inputData['tel'] = $inputData['tel1'] . $inputData['tel2'] . $inputData['tel3'];
		}

		// 入力チェック用にフィールドを作成
		if (! empty($inputData['fax1']) || ! empty($inputData['fax2']) || ! empty($inputData['fax3'])) {
			$inputData['fax'] = $inputData['fax1'] . $inputData['fax2'] . $inputData['fax3'];
		}

		// 入力チェック用にフィールドを作成
		if (! empty($inputData['mobile_tel1']) || ! empty($inputData['mobile_tel2']) || ! empty($inputData['mobile_tel3'])) {
			$inputData['mobile_tel'] = $inputData['mobile_tel1'] . $inputData['mobile_tel2'] . $inputData['mobile_tel3'];
		}

		// 入力チェック用にパラメータを設定
		parent::set($inputData, $two);
	}
}
