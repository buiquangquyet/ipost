<?php
use Fuel\Core\Model_Crud;

/**
 * Model 地方マスター
 *
 * @author     Yoshitaka Kitagawa
 */

class Model_Master_Regions extends Model_Crud
{
    /**
     * @var  string  $_table_name  The table name
     */
    protected static $_table_name = 'M_REGIONS';

    /**
     * Select用Array生成
     *
     * @return array
     */
    public static function list_opt_array()
    {
        $opt = array('' => ' 地方を選択 ');
        $list = self::find_all();
        foreach ($list as $entry)
        {
            $opt[$entry->reg_id] = $entry->reg_name;
        }
        return $opt;
    }
}