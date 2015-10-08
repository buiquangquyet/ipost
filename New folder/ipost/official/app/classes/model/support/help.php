<?php
use Fuel\Core\Model_Crud;

/**
 * Model サポートヘルプ
 *
 * @author     Yoshitaka Kitagawa
 */

class Model_Support_Help extends Model_Crud
{
  /**
   * @var  string  $_table_name  The table name
   */
  protected static $_table_name = 'SUPPORT_HELP';

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
      $config = array('limit' => $limit,
                      'offset' => $offset,
                      'order_by' => array('category' => 'asc',
                                          'genre'    => 'asc'));
      // $alive ? $config['where'] = array(array('del', '=', 0)) : null;
    return static::find($config);
  }

/**
 * Get Support Help Category Name
 *
 * @param  int     $id Category Id
 * @return String  Category Name
 */
  public static function get_category_name($id)
  {
    return Model_Master_Support_Help_Category::get_type_name($id);
  }

/**
 * Get Support Help FAQ
 *
 * @param  int     $id Category Id
 * @return Array
 */
  public static function get_faq($c_id)
  {
    if (empty($g_id) or ! is_numeric($g_id))
    {
    return self::find_by(array(
                    'category' => '1',
                    'faq' => '1',
                  ));
    }

    return self::find_by(array(
                    'category' => '1',
                    'category' => $c_id,
                    'faq' => '1',
                  ));
  }

/**
 * Get Support Help Select Category List
 *
 * @param  int     $id Category Id
 * @return Array
 */
  public static function get_help_ipost($g_id=null)
  {
    if (empty($g_id) or ! is_numeric($g_id))
    {
    return Model_Support_Help::find_by(array(
                    'category' => '1',
                  ));
    }

    return Model_Support_Help::find_by(array(
                    'category' => '1',
                    'genre'    => $g_id,
                  ));
  }

/**
 * Get Support Help Select Category List
 *
 * @param  int     $id Category Id
 * @return Array
 */
  public static function get_help($c_id, $g_id)
  {
    if (empty($g_id) or ! is_numeric($g_id))
    {
    return Model_Support_Help::find_by(array(
                    'category' => $c_id,
                    'enable'   => 1
                  ));
    }
    return Model_Support_Help::find_by(array(
                    'category' => $c_id,
                    'genre'    => $g_id,
                    'enable'   => 1
                  ));
  }

/**
 * Get Support Help Genre Name
 *
 * @param  int     $id Genre Id
 * @return String  Genre Name
 */
  public static function get_genre_name($id)
  {
    return Model_Master_Support_Help_Genre::get_type_name($id);
  }
}