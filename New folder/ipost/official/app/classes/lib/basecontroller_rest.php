<?php
use Parser\View;

/**
 * Basecontroller
 *
 * コントローラ基底クラス
 *
 * @author     Kouji Itahana
 */

class Basecontroller_Rest extends Controller_Rest
{
	/**
	 * @var  Template Object
	 */
	protected $_view = null;

	/**
	 * @var Config Original
	 */
	protected static $_config = null;

	/**
	 * @var Logined Flag
	 */
	protected static $_logined = false;

    /**
     * @var Shop ショップ管理オブジェクト
     */
    protected static $_shop = null;

    /**
     * @var string クライアントID
     */
    protected static $_client_id = null;

    /**
	 * @var Logined User-ID
	 */
	protected static $_logined_user_id = null;

    /**
     * @var カレントページ（※UI操作に使用)
     */
    protected static $_current_page = '';

	/**
	 * This method gets called before the action is called
	 */
	public function before()
	{
	    parent::before();

	    // 各種設定ファイルロード
	    $this->load_conf();

	    // メンテナンスモード
        $this->maintenance();

        // ログイン済専用ページ処理
	    $this->logined_action();

	    // 各コントローラ独自の前処理
	    if (method_exists(static::$this, 'before_controller'))
	    {
	        $this->before_controller();
	    }
	}

	/**
	 * This method gets called after the action is called
	 */
	public function after($response)
	{
	    if ($response instanceof \View)
	    {
	        $response->set('user_id', self::$_logined_user_id);
	        $response->set('logined', self::$_logined);

	        if (isset(static::$_current_page))
	        {
	            $response->set('current_page', static::$_current_page);
	        }

            foreach (self::$_config as $k => $v)
            {
                $response->set($k, $v);
            }

            foreach (\Config::load('original_image', true) as $k => $v)
            {
                $response->set($k, $v);
            }
	    }

	    $response = parent::after($response);
	    return $response;
	}

	/**
	 * 各種設定ファイルロード
	 */
	private function load_conf()
	{
	    self::$_config = \Config::load('original', true);
	    \Config::load('auth', true);
    }

    /**
     * メンテナンスモード
     *
     * メンテナンススイッチがONかつメンテ期間中なら503を返す
     */
    private function maintenance()
    {
        if (self::conf_get('maintenance_switch'))
        {
            $current = time();
            $m_start = strtotime(self::conf_get('maintenance_start_datetime'));
            $m_end   = strtotime(self::conf_get('maintenance_end_datetime'));
            if ($current >= $m_start and $current <= $m_end)
            {
                // APIなのでメンテナンスページを表示等はせず503を返す
                return Response::redirect('maintenance');
            }
        }
    }

    /**
     * ログイン済専用ページ処理
     */
	public function logined_action()
	{
	    $this->login_check();

	    if ( ! isset(static::$_logined_page) or ! static::$_logined_page) return;

	    if ( ! self::$_logined)
	    {
	        Response::redirect(self::conf_get('login_url_path'));
	    }
	}

	/**
	 * ログインチェック
	 *
	 * @return true:ログイン済/false:未ログイン
	 */
	public static function login_check()
	{
	    if (\Loginauth\Auth::instance()->exist_alive_session())
	    {
	        self::$_logined = true;
	        return true;
	    }
	    else
	    {
	        \Loginauth\Auth::instance()->logout();
	        return false;
	    }
	}

	/**
	 * ユーザーID取得
	 *
	 * ・ログイン済みの場合のみ取得可能
	 * @return string user-id
	 */
	protected static function get_user_id()
	{
	    if (is_null(self::$_logined_user_id) or empty(self::$_logined_user_id))
	    {
            self::$_logined_user_id = \Session::get(self::conf_get('session_user_id', 'auth'));
	    }
	    return self::$_logined_user_id;
	}

	/**
	 * 設定ファイルから指定キーの値を取得
	 *
	 * @return    string
	 */
	protected static function conf_get($key, $group='original')
	{
	    return \Config::get($group.'.'.$key);
	}

	/**
	 * Fieldset操作: 確認用へ変換
	 *
	 * @param  Fuel\Core\Fieldset
	 * @return Fuel\Core\Fieldset
	 */
	protected function convert_fieldset_confirm($fieldset)
	{
	    $config = Config::load('form_confirm');
	    $fieldset->set_config($config);

	    foreach ($fieldset->field() as $field)
	    {
	        $field->set_type('hidden');
	    }

	    return $fieldset;
	}

	/**
	 * POSTのみ許可
	 */
	protected function check_only_post()
	{
	    if (Input::method() == 'POST') return;

	    Log::error(__METHOD__.'Invalid access to only POST page.');
	    return Response::redirect('exception/404');
	}

	/**
	 * 住所自動入力用 js ロード
	 *
	 * @param View
	 * @return View
	 */
	protected function load_js_auto_address($view)
	{
	    Asset::js(array('ajaxzip2/jquery.js', 'ajaxzip2/ajaxzip2.js'), array(), 'ajaxzip2', false);
	    $this->set_view_js($view, Asset::render('ajaxzip2'));
	    $this->set_view_js($view, Asset::js('ajaxzip2/setup_data.js', array(), null, true));
	    return $view;
	}

	/**
	 * Viewへjsをセット
	 *
	 * @param View
	 * @param string|array set-value
	 * @return View
	 */
	protected function set_view_js($view, $value)
	{
	    $js = $view->get('js', array());

	    if (is_array($value))
	    {
	        foreach ($value as $v)
	        {
	            array_push($js, $v);
	        }
	    }
	    else
	    {
	        array_push($js, $value);
	    }

	    $view->set('js', $js, false);
	    return $view;
	}

	/**
	 * Viewへcssをセット
	 *
	 * @param View
	 * @param string|array set-value
	 * @return View
	 */
	protected function set_view_css($view, $value)
	{
	    $css = $view->get('css', array());

	    if (is_array($value))
	    {
	        foreach ($value as $v)
	        {
	            array_push($css, $v);
	        }
	    }
	    else
	    {
	        array_push($css, $value);
	    }

	    $view->set('css', $css, false);
	    return $view;
	}

	/**
	 * 都道府県を取得：都道府県コード指定
	 *
	 * @param int pref_code
	 * @return string pref_name
	 */
	protected function get_pref_name($code)
	{
	    if (empty($code))
	    {
	        return '';
	    }
	    $result = Model_Master_Prefectures::find_one_by('pre_code', intval($code));
	    return $result->pre_name;
	}

	/**
	 * 指定クライアントがゴールドパートナーの担当かどうか検証
	 *
	 * @param string client-id
	 * @return bool
	 */
	protected function valid_agent_child($client_id)
	{
	    if (empty($client_id)) return false;

	    $client = Model_View_Client::find_by(
	        array('id' => $client_id, 'agent_id' => self::get_user_id(), array('del', '=', 0)),
	        null,
	        null,
	        1);
	    return is_null($client) ? false : true;
	}

	/**
	 * Shardセットアップ（※クライアントIDに応じてDB参照先を切り替え）
	 * @param unknown $client_id
	 */
	protected function setup_shard($client_id)
	{
	    static::$_shop = new \Shop($client_id);
	    static::$_shop->init_models();
	}

	/**
	 * クライアントID取得＋Shardセットアップ
	 * ※ショップ系データを操作する際には本メソッドの処理が必須
	 *
	 * @return string クライアントID
	 */
	protected function setup_shop($client_id=null)
	{
	    // クライアントID取得
	    if (is_null($client_id))
	    {
	        $client_id = $this->param('client_id');
	    }

	    if (is_null($client_id) or empty($client_id) or ! is_numeric($client_id))
	    {
	        return null;
	    }

	    // Shardセットアップ
	    try
	    {
	        $this->setup_shard($client_id);
	    }
	    catch (\Exception $e)
	    {
	        return null;
	    }

	    return $client_id;
	}

	/**
	 * クライアントID取得/セット
	 *
	 * ・本メソッド利用時にはsetup_shopメソッドを先に実行しておく必要がある
	 *
	 * @return string
	 */
	protected function client_id($new=null)
	{
	    if ( ! is_null($new))
	    {
	         static::$_client_id = $new;
	    }
	    return static::$_client_id;
	}

}