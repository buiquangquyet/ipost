<?php
/**
 * Shopクラス
 *
 * Shopに関する処理はこちらのクラスへ実装
 *
 * @author    K.ITAHANA
 */
class Maintenance
{
    /**
     * 設定ファイル名(※.php不要)
     */
    const CONF_NAME = 'maintenance';

    /**
     * @var array shop-config-params
     */
    protected static $_conf = null;

    /**
	 * Initialize
	 */
	public static function _init()
	{
	}

    /**
     * コンストラクタ
     */
	function __construct()
	{
        self::$_conf = \Config::load(self::CONF_NAME, true);
	}

}

/* end of file auth.php */
