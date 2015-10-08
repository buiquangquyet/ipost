<?php
namespace Support;
/**
 * Shardクラス
 *
 * DBシャーディング関連のユーティリティクラス
 *
 * @author    K.ITAHANA
 */
class Shard
{
    /**
     * クライアントID
     * @var string
     */
    protected static $_client_id = null;

    /**
     * Model_User_Clientインスタンス
     * @var Model_User_Client
     */
    protected static $_model_client = null;

    /**
     * @var array shop-config-params
     */
    protected static $_conf = null;

    /**
	 * Initialize
	 */
	public static function _init()
	{
	    // Initialization here.
	}

    /**
     * コンストラクタ
     */
	function __construct($client_id)
	{
	    self::$_client_id = $client_id;
	}

	/**
	 * シャーディング指定によってDB参照先切り替え処理
	 *
	 * @throws Exception
	 */
	public function setup()
	{
	    if (is_null(self::$_client_id))
	    {
            return;
	    }

	    $shard = $this->shop_shard();
	    if ( ! is_null($shard) and ! empty($shard))
	    {
	        \Model_Crud_Shard::set_connection($shard);
	    }

	    $shard_payment = $this->payment_shard();
	    if ( ! is_null($shard_payment) and ! empty($shard_payment))
	    {
	        \Model_Crud_Shard_Payment::set_connection($shard_payment);
	    }
	}

    /**
     * クライアントID取得
     * @return string
     */
    public function client_id()
    {
        return self::$_client_id;
    }

	/**
     * シャーディング情報
     *
     * @return string
     */
	private function shop_shard()
	{
	    $model = $this->client_model();
	    if (is_null($model))
	    {
	        return null;
	    }
	    return $model->shard;
	}

    /**
     * シャーディング情報：Payment
     *
     * @return string
     */
	private function payment_shard()
	{
	    $model = $this->client_model();
	    if (is_null($model))
	    {
	        return null;
	    }
	    return $model->shard_payment;
	}

    /**
     * Modelインスタンス取得：クライアント
     *
     * @return Model_User_Client
     */
	private function client_model()
	{
	    if (is_null(self::$_client_id))
	    {
	        return null;
	    }

	    if (is_null(self::$_model_client))
	    {
	        self::$_model_client = \Model_User_Client::find_by_pk($this->client_id());
	    }
	    return self::$_model_client;
	}

}

/* end of file auth.php */
