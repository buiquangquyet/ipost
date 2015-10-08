<?php
/**
* リジェクト内容に関するクラスです。
* @author    Yoshitaka Kitagawa
*/
class Reject extends AppModel {
	public $useTable = false; // このモデルはデータベース・テーブルを使いません

	/**
	* バリデーション設定
	*/
	public $validate = array(
		'type' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'リジェクト理由の種類を選択してください',
			),
		),
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'リジェクト理由のタイトルを入力してください',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 255),
				'message' => 'リジェクト理由のタイトルは255文字以内で入力してください',
			),
		),
		'body' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'リジェクト理由の内容を入力してください',
			),
		),
	);

}
