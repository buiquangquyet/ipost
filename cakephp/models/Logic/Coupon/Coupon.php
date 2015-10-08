<?php

App::uses('BasicInfoLogic', 'Model');

/**
* クーポン情報のロジックを記述するモデルです。
* DB接続は行わないです。
*/

class Coupon extends BasicInfoLogic {

	protected $infoName = 'coupon_info';

	public function mergeCouponInfo($id, $blockInfo) {

		$couponInfo = $this->getData($id);
		$blockInfo['coupon'] = $couponInfo;

		return $blockInfo;
	}

	public function getData($id) {
		$basicInfo = parent::getData($id);
		$basicInfo = json_decode($basicInfo, true);
		return $basicInfo;
	}

	var $validate = array(
		'enable_flg' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'クーポンの表示・非表示を選択してください',
			),
		),
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'タイトルを指定してください',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 255),
				'message' => 'クーポンは255文字以内で入力してください',
			),
		),
		'policy' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => '利用条件を指定してください',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 1024),
				'message' => '利用条件は1024文字以内で入力してください',
			),
		),
		'discount' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => '割引率は数値で入れてください。',
				'allowEmpty' => true
			),
		),
	);

	public function set($inputData, $two = null) {

		// 配列だったら戻る
		if (!is_array($inputData)) {

			// 入力された値によって、バリデータを変更
			// もし、期間フラグが立っていたら、開始日と終了日の整合性と日付かどうかをチェックする。
			if ($inputData['term_flg'] === '1' && $inputData['coupon_type'] === '0') {

				$this->validate['start_datetime'] = array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => '開始日を設定してください。',
					),
					'date' => array(
						'rule' => array('date', 'ymd'),
						'message' => '開始日を正しく指定してください。',
					),
				);

				$this->validate['end_datetime'] = array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => '終了日を設定してください。',
					),
					'date' => array(
						'rule' => array('date', 'ymd'),
						'message' => '終了日を正しく指定してください。',
					),
				);

			}

			// もし、クーポンの種類が期間限定の時は、表示日数が必須で、かつ数値入力になっているか確認
			if ($inputData['coupon_type'] === '1') {

				$this->validate['display_days'] = array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => '掲載期間を設定してください。',
					),
					'numeric' => array(
						'rule' => 'numeric',
						'message' => '掲載期間は数値で入れてください。',
					),
				);
			}
		}

		// 入力チェック用にパラメータを設定
		parent::set($inputData, $two);
	}

	public function deleteData($userId, $target) {

		// 現状のデータを取得します。
		$dataInfo = $this->getData($userId);

		// 対象の位置の情報を削除し、1つ詰めて、再度登録します。
		unset($dataInfo[$target]);
		$conf = Configure::read('coupon_info');
		$initialCouponInfoList = array_shift($conf);
		$dataInfo[] = $initialCouponInfoList;

		// 添字振り直し
		$dataInfo = array_values($dataInfo);

		// 保存。其の前にバリデーション外す
		$this->validate = array();
		$this->saveData($userId, $dataInfo);

	}

	/**
	* Saveする時にJSON情報を編集する
	*/
	protected function formatEachLogic($info, $data) {
		// ループして、情報を登録
		$info = json_decode($info, true);

		if (isset($data['pos'])) {
			$info[$data['pos']] = array_merge($info[$data['pos']], $data);
		} else {
			$info = $data;
		}
		return json_encode($info);
	}

}