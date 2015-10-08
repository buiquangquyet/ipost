<?php
/**
 * 独自Validationクラス
 *
 * @package app
 * @author  Kouji Itahana
 */

class ExValidation
{
    /**
     * マスター管理者アカウント: login_idユニークチェック
     *
     * @param string login_id
     * @return bool true:NG(既に登録あり)/false:OK(未登録)
     */
    public static function _validation_unique_master_login_id($login_id)
    {
        if ( ! empty($login_id))
        {
            return \Model_User_Master::exists_login_id($login_id);
        }

        return false;
    }

    /**
     * ゴールドパートナーアカウント: login_idユニークチェック
     *
     * @param string login_id
     * @return bool true:NG(既に登録あり)/false:OK(未登録)
     */
    public static function _validation_unique_agent_login_id($login_id)
    {
        if ( ! empty($login_id))
        {
            return \Model_User_Agent::exists_login_id($login_id);
        }

        return false;
    }

    /**
     * クライアントアカウント: login_idユニークチェック
     *
     * @param string login_id
     * @return bool true:NG(既に登録あり)/false:OK(未登録)
     */
    public static function _validation_unique_client_login_id($login_id)
    {
        if ( ! empty($login_id))
        {
            return \Model_User_Client::exists_login_id($login_id);
        }

        return false;
    }

    /**
     * ゴールドパートナーID: 存在チェック
     *
     * @param string agent_id
     * @return bool true:登録あり/false:未登録
     */
    public static function _validation_exists_agent_id($agent_id)
    {
        if ( ! empty($agent_id))
        {
            return is_null(\Model_User_Agent::find_by_pk($agent_id)) ? false : true;
        }

        return false;
    }

    /**
     * 販売商品IDの正当性チェック
     *
     * @param string id
     * @return bool true:OK/false:NG
     */
    public static function _validation_exists_saleitem_id($id)
    {
        if ( ! empty($id))
        {
            return is_null(Model_Master_Sale_Item::find_by_pk($id)) ? false : true;
        }

        return false;
    }
}