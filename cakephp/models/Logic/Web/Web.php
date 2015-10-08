<?php

App::uses('BasicInfoLogic', 'Model');

/**
* ヘッダ情報のロジックを記述するモデルです。
* DB接続は行わないです。
*/

App::uses('AppModel', 'Model');

class Web extends BasicInfoLogic {
	protected $infoName = 'web_info';
}