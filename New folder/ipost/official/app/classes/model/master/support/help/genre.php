<?php
use Fuel\Core\Model_Crud;

/**
 * Model ヘルプ質問ジャンルマスター
 *
 * @author     Yoshitaka Kitagawa
 */

class Model_Master_Support_Help_Genre extends Model_Crud_Master
{
  /**
   * @var  string  $_table_name  The table name
   */
  protected static $_table_name = 'M_SUPPORT_HELP_GENRE';


  /**
   * Finds all records in the table.  Optionally limited and offset.
   *
   * @param   int     $limit     Number of records to return
   * @param   int     $offset    What record to start at
   * @return  null|object        Null if not found or an array of Model object
   */
  public static function find_all($limit = null, $offset = 0, $alive = true)
  {
    $config = array('limit' => $limit,
            'offset' => $offset,
            'order_by' => array('position' => 'asc')
          );
    // $alive ? $config['where'] = array(array('del', '=', 0)) : null;
  return static::find($config);
  }

  /**
   * Select用Array生成
   *
   * @return array
   */
  public static function list_opt_array()
  {
    $opt = array('' => '----- ジャンルを選択 -----');
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