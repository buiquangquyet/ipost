<?php
if(!is_cli()) {
	define('SITE_URL', getHttpProtocol() . '://' . $_SERVER['SERVER_NAME'] . '/');
	define('ADMIN_SITE_URL', getHttpProtocol() . '://' . $_SERVER['SERVER_NAME'] .'/');
	define('SSO_SERVER_URL', SITE_URL . 'sso-server');
}
else {
	define('SITE_URL', '/');
}

define('REMEMBER_ME_TS', 7*24*60*60); // 7 days
define('COOKIE_SALT', 'hvhv');
define('NONE_SEARCH_KEY', 'no_search');
define('HASH_ALGO', 'md5'); //password hash algorithm. Can be sha1
define('CARD_CODE_PREFIX', 'hvhvhv');
define('EMAIL_FROM', "abc@example.com");
define('EMAIL_NAME', "EXAMPLE.COM");
define('ERROR_CODE_LIMIT', 90);
define('ENCRYPTION_KEY', 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8cahvh');
define('CAPTCHA_DIR', getCaptchaDir());
define('ID_LANG', 1); // 1 - vietnam, 2 - english,

function getCaptchaDir($dir = null)
{
    /* if(!$dir)
        $dir = ROOT . '/captcha';

    if (! is_dir($dir) && ! mkdir($dir, 0777, true)) {
        throw new \Exception("The follow directory could not be made, please create it: {$dir}");
    }
    return $dir; */
}

function validate_ip($ip)
{
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
        return false;
    }
    return true;
}

function checkRemoteIp()
{
	// check remote ip
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	{
		$realIp=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	{
		$realIp=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
		$realIp=$_SERVER['REMOTE_ADDR'];
	}

	return $realIp;
}

function getHttpProtocol() {
	return 'https';
	if (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
		if ($_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
			return 'https';
		}
		return 'http';
	}
	/*apache + variants specific way of checking for https*/
	if (isset($_SERVER['HTTPS']) &&
	($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] == 1)) {
		return 'https';
	}
	/*nginx way of checking for https*/
	if (isset($_SERVER['SERVER_PORT']) &&
	($_SERVER['SERVER_PORT'] === '443')) {
		return 'https';
	}
	return 'http';
}

function d($data)
{
    echo '<pre>';
	v($data);die;
}

function dm($data)
{
	d(get_class_methods($data));
}

function v($data)
{
    echo '<pre>';
	var_dump($data);
}

function p($data)
{
    echo '<pre>';
	print_r($data);
}

function is_cli()
{
	return (php_sapi_name() === 'cli') ? true : false;
}

function is_dev()
{
	$bool = (APPLICATION_ENV == 'production') ? false : true;
	if(isset($_GET['dev']))
		$bool = true;

	if($bool) {
		ini_set('display_errors', true);
		error_reporting(E_ALL);
		ini_set('display_startup_errors', true);
		ini_set('track_errors', true);
		ini_set('html_errors ', true);
	}
	else
	{
		ini_set('display_errors', false);
	}
	return $bool;
}

function l($str, $file = '', $addNewline = true)
{
	if (is_array($str))
		$str = json_encode($str);

	if(is_object($str)) {
		$str = serialize($str);
	}

	if ($file == '')
		$file = ROOT_PATH . "/data/logs/".date('Y_m_d', time()).".txt";

	$fh = fopen($file, 'a+');
	fwrite($fh, $str);
	if ($addNewline)
		fwrite($fh, "\n");
	fclose($fh);
}

function censorText($text, $seperator = '')
{
    if ($seperator == '@') {
        $text = explode('@', $text);
        return $text[0]{0} . str_repeat('*', strlen($text[0]) - 2 ) . $text[0]{strlen($text[0])-1} . $seperator . str_repeat('*', strlen($text[1])-1) . $text[1]{strlen($text[1])-1};
    } else {
        return $text{0} . str_repeat('*', strlen($text) - 2 ) . $text{strlen($text)-1};
    }
}

function formatMoney($number, $fractional=false) {
	if ($fractional) {
		$number = sprintf('%.2f', $number);
	}
	while (true) {
		$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
		if ($replaced != $number) {
			$number = $replaced;
		} else {
			break;
		}
	}
	return $number;
}

function arrayMergeSum($a1, $a2, $a3 = array(), $a4 = array())
{
    $result = array();
    foreach (array_keys($a1 + $a2 + $a3 + $a4) as $key) {
        $result[$key] = (isset($a1[$key]) ? $a1[$key] : 0) + (isset($a2[$key]) ? $a2[$key] : 0) + (isset($a3[$key]) ? $a3[$key] : 0) + (isset($a4[$key]) ? $a4[$key] : 0);
    }

    return $result;
}