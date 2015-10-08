<?php
use Fuel\Core\Model_Crud;

/**
 * Model 都道府県マスター
 *
 * @author     Kouji Itahana
 */

class Model_Master_Prefectures extends Model_Crud
{
    /**
     * @var  string  $_table_name  The table name
     */
    protected static $_table_name = 'M_PREFECTURES';

    /**
     * Select用Array生成
     *
     * @return array
     */
    public static function list_opt_array()
    {
        $opt = array('' => '----- 都道府県を選択 -----');
        $list = self::find_all();
        foreach ($list as $entry)
        {
            $opt[$entry->pre_code] = $entry->pre_name;
        }
        return $opt;
    }
}