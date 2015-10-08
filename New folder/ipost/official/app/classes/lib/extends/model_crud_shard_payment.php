<?php
/**
 * Model_Crud拡張クラス
 *
 * @author K.ITAHANA
 */
class Model_Crud_Shard_Payment extends \Fuel\Core\Model_Crud
{

	/**
	 * @var string   $_connection   The database connection to use
	 */
	protected static $_connection = null;

    /**
     * DB接続設定キー値をセット
     *
     * @param string $conn
     */
    public static function set_connection($conn)
    {
        self::$_connection = $conn;
    }

}
