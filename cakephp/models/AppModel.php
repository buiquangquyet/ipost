<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	public $lang = 'jpn';

	/**
	* 画像ファイルの容量とかその辺りを確認するバリデーション
	*/
	public function setImageFileCheckValidation() {

		$this->validate = array(
			// 権限チェック
			'mediaFile' => array(
				'uploadError' => array(
					'rule' => 'uploadError',
					'message' => '画像ファイルのアップロードに失敗しました'
					),
				),
				'extension' => array(
					'rule' => array('extension', getAllowImageExt()),
					'message' => '拡張子が正しくありません',
				),
				'mimeType' => array(
					'rule' => array('mimeType',	getAllowImageMime()),
					'message' => 'ファイル形式が正しくありません'
				),
				'size' => array(
					'maxFileSize' => array(
						'rule' => array( 'fileSize', '<=', '3MB'),  // 3MB以下
						'message' => array('ファイルサイズが大きすぎます。')
					),
					'minFileSize' => array(
						'rule' => array( 'fileSize', '>',  0),    // 0バイトより大
						'message' => array('ファイルサイズが0バイトです')
					),
				),
			);
	}

	/**
	* トランザクション開始
	*/
	public function begin() {
		$dbs = ConnectionManager::getDataSource($this->useDbConfig);
		$dbs->begin($this);
	}

	/**
	* トランザクションコミット
	*/
	public function commit() {
		$dbs = ConnectionManager::getDataSource($this->useDbConfig);
		$dbs->commit($this);
	}

	/**
	* トランザクション開始
	*/
	public function rollback() {
		$dbs = ConnectionManager::getDataSource($this->useDbConfig);
		$dbs->rollback($this);
	}

	/**
	 *
	 * @param string $model_name
	 */
	protected function loadModel($model_name) {
		App::uses($model_name,'Model');
		$this->{$model_name} = new $model_name();
	}

}
