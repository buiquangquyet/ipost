<?php
use Fuel\Core\Model_Crud;

/**
 * Model リンクマスター
 *
 * @author     Kouji Itahana
 */

class Model_Master_Link extends Model_Crud
{
    /**
     * @var  string  $_table_name  The table name
     */
    protected static $_table_name = 'M_LINK';

    /**
     * Select用Array生成
     *
     * @return array
     */
    public static function list_opt_array()
    {
        $opt = array('' => '----- 内部リンク先を選択 -----');
        $list = self::find_all();
        foreach ($list as $entry)
        {
            $opt[$entry->id] = $entry->name;
        }
        return $opt;
    }
}