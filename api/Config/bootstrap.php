<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */

/**
 * Custom Inflector rules can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. Make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */

/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter. By default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));

// ディレクトリの設定。大体以下のように分かれています。新しく追加するときは追加してください。
// Modelに関しては、共有するものは一番上のディレクトリに置いてください。
// それぞれ独自に使うやつだけディレクトリの下に置くといいと思います。
//
// API関係 アフィリエイトの計測とかする
// User関係 関連する企業の人が操作する
// Api関係 WGの人が操作をする
App::build(array(
	'Controller' => array(
		ROOT.DS.APP_DIR.DS.'Controller'.DS, // その他いろいろ共通のやつ
		ROOT.DS.APP_DIR.DS.'Controller'.DS.'Api'.DS,  // 管理画面のコントローラーが収まるディレクトリ
		ROOT.DS.APP_DIR.DS.'Controller'.DS.'Api'.DS.'Pages'.DS, // 管理画面のコントローラーが収まるディレクトリ
	),
	'Model' => array(
		CAKE_DIR.DS.'models'.DS, // その他いろいろ共通のやつ
		CAKE_DIR.DS.'models'.DS.'Logic'.DS, // APIのロジックのモデルが収まるディレクトリ
		CAKE_DIR.DS.'models'.DS.'Logic'.DS.'Sidemenu'.DS,
		CAKE_DIR.DS.'models'.DS.'Logic'.DS.'Header'.DS,     // ヘッダー設定用のモデルが収まるディレクトリ
		CAKE_DIR.DS.'models'.DS.'Logic'.DS.'Footer'.DS,     // フッダー情報設定用のモデルが収まるディレクトリ
		CAKE_DIR.DS.'models'.DS.'Logic'.DS.'Background'.DS, // 背景情報設定用のモデルが収まるディレクトリ
		CAKE_DIR.DS.'models'.DS.'Logic'.DS.'Splash'.DS,     // スプラッシュ情報設定用のモデルが収まるディレクトリ
		CAKE_DIR.DS.'models'.DS.'Logic'.DS.'Block'.DS,
		CAKE_DIR.DS.'models'.DS.'Logic'.DS.'News'.DS,
		CAKE_DIR.DS.'models'.DS.'Logic'.DS.'Menu'.DS,
		CAKE_DIR.DS.'models'.DS.'Logic'.DS.'Coupon'.DS,
		CAKE_DIR.DS.'models'.DS.'Logic'.DS.'Shop'.DS,
		CAKE_DIR.DS.'models'.DS.'Logic'.DS.'Web'.DS,        // ウェブ情報設定用のモデルが収まるディレクトリ
		//CAKE_DIR.DS.'models'.DS.'Logic'.DS.'Top'.DS, // Hss pending issue
	),
	'View' => array(
		ROOT.DS.APP_DIR.DS.'View'.DS,
		ROOT.DS.APP_DIR.DS.'View'.DS.'Api'.DS, // 管理画面のビューが収まるディレクトリ
		ROOT.DS.APP_DIR.DS.'View'.DS.'Api'.DS.'Pages'.DS, // 管理画面のコントローラーが収まるディレクトリ
	),
    'Plugin' => array(
        CAKE_DIR.DS.'plugins'.DS,
    ),
));

//プラグインの読み込み
CakePlugin::load('DebugKit'); // DebugKit

// ユーザのタイプパラメータ
define('USER_TYPE_NONE', 0); // マスター
define('USER_TYPE_OYA', 1); // 代理店（親）
define('USER_TYPE_KO', 2); // お店（子）

// ユーザのステータスパラメータ
define('USER_STATUS_KARI', 1); // 仮登録
define('USER_STATUS_ENABLE', 2); // 有効
define('USER_STATUS_DISABLE', 3); // 無効
define('USER_STATUS_DELETE', 9); // 削除

// システム名
define('SYSTEM_ADMIN_TITLE', 'iPost Enterprise');

// API返却値
define('API_CODE_SUCCESS', 1); // コード成功
define('API_CODE_ERROR', 2); //コードエラー

// メディアステータス
define('MEDIA_STATUS_ENABLE', 1); // 有効
define('MEDIA_STATUS_DISABLE', 2); // 無効

// メディアの一時保存領域
define('MEDIA_TMP_DIR', 'media_tmp');

// ユーザごとのメディア保存場所のベース
define('MEDIA_UPLAOD_DIR_BASE', 'upload');

// テーマのデフォ値指定
define('DEFAULT_THEME_HEADER', '08');
define('DEFAULT_THEME_BACKGROUND', '08');

// アプリケーション独自設定ファイル読込
Configure::load('ipost.php');

App::uses("ValidateException", "Lib/Error");

// ======================================================================
// = original method -- START.
// ======================================================================

/**
 * 指定したキーの値を取得する。2次元配列のみ対応
 * @param target_data 値を取り出したい多次元配列
 * @param column_key  値を返したいカラム
 * @param index_key   返す配列のインデックスとして使うカラム
 * return array       入力配列の単一のカラムを表す値の配列を返し
 */
// function array_column ($target_data, $column_key, $index_key = null) {

//     if (is_array($target_data) === FALSE || count($target_data) === 0) return FALSE;

//     $result = array();
//     foreach ($target_data as $array) {
//         if (array_key_exists($column_key, $array) === FALSE) continue;
//         if (is_null($index_key) === FALSE && array_key_exists($index_key, $array) === TRUE) {
//             $result[$array[$index_key]] = $array[$column_key];
//             continue;
//         }
//         $result[] = $array[$column_key];
//     }

//     if (count($result) === 0) return FALSE;
//     return $result;
// }

// ======================================================================
// = original method -- END.
// ======================================================================

/**
* 許可する拡張子の一覧
*/
function getAllowImageExt() {
	return array(
		'jpg',
		'jpeg',
		'png',
		'gif',
	);
}

/**
* 許可するmimeの一覧
*/
function getAllowImageMime() {
	return array(
		'image/jpeg',
		'image/png',
		'image/gif',
	);
}

/**
 * データベースの接続先を指定
 *
 * テスト : test
 * 開発用 : development
 * 公開用 : production
 */
Configure::write('database', 'development');
