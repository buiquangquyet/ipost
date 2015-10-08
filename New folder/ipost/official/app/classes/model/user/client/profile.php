<?php
use Fuel\Core\Model_Crud;

/**
 * Model クライアントプロフィール
 *
 * @author     Kouji Itahana
 */

class Model_User_Client_Profile extends Model_Crud
{
    /**
     * @var  string  $_table_name  The table name
     */
    protected static $_table_name = 'USER_CLIENT_PROFILE';

    /**
     * @var  string  fieldname of created_at field, uncomment to use.
     */
    protected static $_created_at = 'created_at';

    /**
     * @var  string  fieldname of updated_at field, uncomment to use.
     */
    protected static $_updated_at = 'updated_at';
}