<?php
use Fuel\Core\Model_Crud;

/**
 * Model ヘルプカテゴリーマスター
 *
 * @author     Yoshitaka Kitagawa
 */

class Model_Master_Support_Help_Category extends Model_Crud_Master
{
    /**
     * @var  string  $_table_name  The table name
     */
    protected static $_table_name = 'M_SUPPORT_HELP_CATEGORY';

    /**
     * Select用Array生成
     *
     * @return array
     */
    public static function list_opt_array()
    {
        $opt = array('' => '----- 対象者を選択 -----');
        $list = self::find_all();
        foreach ($list as $entry)
        {
            $opt[$entry->id] = $entry->name;
        }
        return $opt;
    }

    /**
     * タイプ名称取得
     *
     * @param string id
     * @return string
     */
    public static function get_type_name($id)
    {
        $item = self::find_by_pk($id);
        return isset($item['name']) ? $item['name'] : '';
    }

}