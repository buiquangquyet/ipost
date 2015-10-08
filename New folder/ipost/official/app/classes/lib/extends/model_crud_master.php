<?php
/**
 * Model_Crud拡張クラス: マスターテーブル用
 *
 * ・ローカルサーバー内のRedisのキャッシュを利用
 *
 * @author K.ITAHANA
 */
class Model_Crud_Master extends Model_Crud
{
    /**
     * @var プライマリーキー指定のカラム名
     */
    protected static $_primary_column = 'id';

    /**
     * Redis: 保存キー取得
     * @throws Exception
     * @return string
     */
    private static function cache_key()
    {
        if (isset(static::$_table_name))
        {
            return static::$_table_name;
        }
        else
        {
            throw new Exception('cache key is null.');
        }
    }

    /**
     * キャッシュエンジンへデータ保存
     */
    private static function save_cache()
    {
        try
        {
            $list = self::find_all();

            // キャッシュへ保存：全リスト
            Cache::set(self::cache_key(), $list);

            // キャッシュへ保存：1(redis-key)by1(record)
            foreach ($list as $record)
            {
                $key = self::cache_key().$record->id;
                Cache::set($key, $record);
            }
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
        }
    }

    /**
     * キャッシュエンジン内のデータクリア
     */
    private static function clear_cache()
    {
        try
        {
            $list = Cache::get(self::cache_key());
            if ( ! is_null($list))
            {
                Cache::delete(self::cache_key());
            }

            foreach ($list as $record)
            {
                $key = self::cache_key().$record->id;
                Cache::delete($key);
            }
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
        }
    }

    /**
     * 全レコード取得
     * @return Ambigous <\Fuel\Core\mixed, \Fuel\Core\Cache_Storage_Driver>
     */
    public static function get_all($clear_cache=false)
    {
        if ($clear_cache)
        {
            Cache::delete(self::cache_key());
        }
        $list = null;
        try
        {
            $list = Cache::get(self::cache_key());
        }
        catch (\Exception $e)
        {
            Log::info(static::$_table_name.' cache not found.');
            $list = self::find_all();
            // キャッシュへ保存
            self::save_cache();
        }

        return $list;
    }

    /**
     * プライマリーキー指定カラム値でデータ取得
     * @param unknown $id
     * @return NULL|Ambigous <\Fuel\Core\mixed, \Fuel\Core\Cache_Storage_Driver>
     */
    public static function get_select($id, $clear_cache=false)
    {
        if (is_null($id))
        {
            return null;
        }

        $rec = null;
        $key = self::cache_key().$id;
        if ($clear_cache)
        {
            Cache::delete($key);
        }

        try
        {
            $rec = Cache::get($key);
            if (is_null($rec))
            {
                $rec = self::find_one_by(static::$_primary_column, $id);
            }
        }
        catch (\Exception $e)
        {
            Log::info(static::$_table_name.' cache not found.');
            $rec = self::find_one_by(static::$_primary_column, $id);
            // キャッシュへ保存
            self::save_cache();
        }

        return $rec;
    }

}
