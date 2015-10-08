<?php
class EmailConfig {

	public $default = array(
		'transport' => 'Mail',
		// 'from' => array('kitagawa@hiropro.co.jp' => 'サターン'),
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);

	public $localhost = array(
		'transport' => 'Smtp',
        'host' => 'localhost',
		'port' => 25,
	);

	public $sakura = array(
        'transport' => 'Smtp',
        'host' => 'hiropro.sakura.ne.jp', // 初期ドメイン
        'port' => 587,
        'username' => 'kitagawa@hiropro.co.jp', // ユーザ名：
        'password' => 'naga1538', // メールパスワード
	);

	public $smtp = array(
		'transport' => 'Smtp',
		'from' => array('site@localhost' => 'My Site'),
		'host' => 'localhost',
		'port' => 25,
		'timeout' => 30,
		'username' => 'user',
		'password' => 'secret',
		'client' => null,
		'log' => false,
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);

	public $fast = array(
		'from' => 'you@localhost',
		'sender' => null,
		'to' => null,
		'cc' => null,
		'bcc' => null,
		'replyTo' => null,
		'readReceipt' => null,
		'returnPath' => null,
		'messageId' => true,
		'subject' => null,
		'message' => null,
		'headers' => null,
		'viewRender' => null,
		'template' => false,
		'layout' => false,
		'viewVars' => null,
		'attachments' => null,
		'emailFormat' => null,
		'transport' => 'Smtp',
		'host' => 'localhost',
		'port' => 25,
		'timeout' => 30,
		'username' => 'user',
		'password' => 'secret',
		'client' => null,
		'log' => true,
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);

}
