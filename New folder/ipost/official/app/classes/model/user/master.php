<?php
use Fuel\Core\Model_Crud;

/**
 * Model マスターユーザ
 *
 * @author     Kouji Itahana
 */

class Model_User_Master extends Model_Crud
{
    /**
     * @var  string  $_table_name  The table name
     */
    protected static $_table_name = 'USER_MASTER';

    /**
     * @var  string  fieldname of created_at field, uncomment to use.
     */
    protected static $_created_at = 'created_at';

    /**
     * @var  string  fieldname of updated_at field, uncomment to use.
     */
    protected static $_updated_at = 'updated_at';

	/**
	 * Finds all records in the table.  Optionally limited and offset.
	 *
	 * @param   int     $limit     Number of records to return
	 * @param   int     $offset    What record to start at
	 * @return  null|object        Null if not found or an array of Model object
	 */
	public static function find_all($limit = null, $offset = 0, $alive = true)
	{
	    $config = array('limit' => $limit, 'offset' => $offset);
	    $alive ? $config['where'] = array(array('del', '=', 0)) : null;
		return static::find($config);
	}

    /**
     * ログインIDユニークチェック
     *
     * @param string login_id
     * @return bool true:既に指定login_idで登録あり/false:未登録
     */
    public static function exists_login_id($login_id)
    {
        $user = self::find_one_by('login_id', $login_id);
        return is_null($user);
    }
}