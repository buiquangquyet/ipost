<?php

App::uses('AppformName', 'View/Helper');


/**
* バリデーションエラーの内容を確認し、
* エラーが有るフォーム名の場合はhas-error(bootstrapのエラーの表示クラス)
* を表示します。コントローラー側からモデル名->validateErrorsを引き渡してください。
*/
class ValidateErrorHelper extends AppHelper {
	/**
	* エラークラスを表示します。
	* 引数にフォームの名前を設定してください。エラーがある場合は、
	* has-errorという文字列を返却します。
	*/
	public function dispErrorClass($modelName, $formName) {

		if(!empty($this->_View->Form->validationErrors[$modelName][$formName])) {
			// 存在するときは、has-errorを返却する
			return 'has-error';
		} else {
			// 見つからない時は、そのまま空の文字列を返却する
			return '';
		}
	}
}