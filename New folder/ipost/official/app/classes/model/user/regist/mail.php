<?php
use Fuel\Core\Model_Crud;

/**
 * Model ユーザー仮登録メールアドレス保存用テーブル
 *
 * @author     Kouji Itahana
 */

class Model_User_Regist_Mail extends Model_Crud
{
    /**
     * @var  string  $_table_name  The table name
     */
    protected static $_table_name = 'USER_REGIST_MAIL';

    /**
     * @var  string  fieldname of created_at field, uncomment to use.
     */
    protected static $_created_at = 'created_at';

}