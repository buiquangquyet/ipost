<?php
/**
 * Shopクラス
 *
 * Shopに関する処理はこちらのクラスへ実装
 *
 * @author    K.ITAHANA
 */
class Shop
{
    /**
     * 設定ファイル名(※.php不要)
     */
    const CONF_NAME = 'shop';

    /**
     * @var array shop-config-params
     */
    protected static $_conf = null;

    /**
     * @var string client-id
     */
    protected static $_client_id = null;

    /**
     * @var Model_Crud
     */
    protected static $_model_client = null;

    /**
     * @var Model_Crud Client Record
     */
    protected static $_rec_client = null;

    /**
     * @var Model_Crud Shop Profile Record
     */
    protected static $_rec_shop_status = null;

    /**
     * @var Inspect
     */
    protected static $_inspect = null;

    /**
	 * Initialize
	 */
	public static function _init()
	{
	    \Config::load(self::CONF_NAME, true);
	}

    /**
     * コンストラクタ
     *
     * @param String $client_id
     */
	function __construct($client_id)
	{
	    if (is_null($client_id) or empty($client_id))
	    {
            throw new Exception('client id is null.');
	    }
        self::$_client_id = $client_id;

        self::$_conf = \Config::load(self::CONF_NAME, true);
	}

	/**
	 * Modelクラス：初期設定
	 *
	 * ※Shop毎にDB参照先を切り替えています
	 */
	public function init_models()
	{
	    $shard = $this->get_shop_shard();
	    if (is_null($shard) or empty($shard))
	    {
	        throw new Exception('client shard info is null.');
	    }
	    \Model_Crud_Shard::set_connection($shard);

	    $shard_payment = $this->get_payment_shard();
	    if (is_null($shard_payment) or empty($shard_payment))
	    {
	        throw new Exception('payment shard is null.');
	    }
	    \Model_Crud_Shard_Payment::set_connection($shard_payment);
	}

    /**
     * シャーディング情報
     *
     * @return string
     */
    protected function get_shop_shard()
    {
        $model = $this->get_client_model();
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
    protected function get_payment_shard()
    {
        $model = $this->get_client_model();
        if (is_null($model))
        {
            return null;
        }
        return $model->shard_payment;
    }

    /**
     * クライアントID取得
     * @return string
     */
    public function get_client_id()
    {
        return self::$_client_id;
    }

    /**
     * Modelインスタンス取得：クライアント
     *
     * @return Model_User_Client
     */
    public function get_client_model()
    {
        if (is_null(self::$_rec_client))
        {
            self::$_rec_client = Model_User_Client::find_by_pk($this->get_client_id());
        }
        return self::$_rec_client;
    }

    /**
     * Modelインスタンス取得：Shopステータス
     *
     * @return Model_Shop_Status
     */
    public function get_shop_status_model()
    {
        if (is_null(self::$_rec_shop_status))
        {
            self::$_rec_shop_status = Model_Shop_Status::find_one_by('client_id', static::get_client_id());
        }
        return self::$_rec_shop_status;
    }

    /**
     * 担当パートナーID取得
     *
     * @return string
     */
    public function agent_id()
    {
        $model = static::get_client_model();
        return $model->agent_id;
    }

    /**
     * ショップが公開ステータスかどうか判定
     *
     * @return boolean true:公開ステータス/false:非公開ステータス
     */
    public function is_opened()
    {
        return static::$_conf['status_open'] == static::status();
    }

    /**
     * 審査申請の可否
     *
     * @return boolean true:申請可/false:申請不可
     */
    public function is_allow_inspect()
    {
        $inspect = static::inspect();
        return $inspect->is_inspect_allow();
    }

    /**
     * アプリ審査申請中？
     *
     * @return boolean true:申請中/false
     */
    public function in_inspect()
    {
        return static::status() == Model_Shop_Status::STATUS_INSPECTED;
    }

    /**
     * アプリ審査通過済？
     *
     * @return boolean true:通過済/false
     */
    public function is_inspect_pass()
    {
        return static::inspect()->is_inspect_pass();
    }

    /**
     * ショップステータス取得
     *
     * @return int
     */
    public function status()
    {
        $model = static::get_shop_status_model();
        if (is_null($model))
        {
            return Model_Shop_Status::STATUS_INIT;
        }

        return intval($model->status);
    }

    /**
     * ショッププロファイルModel取得
     *
     * @return int
     */
    public function profile()
    {
        $model = static::get_client_profile_model();
        if (is_null($model))
        {
            return Model_Shop_Profile::forge();
        }

        return $model;
    }

    /**
     * ショップステータス名称取得
     */
    public function status_name()
    {
        $model = \Model_Master_Shop_Status::get_select(static::status(), true);
        return $model->comment;
    }

    /**
     * ショップステータス更新
     *
     * @param int $new-status
     * @return boolean
     */
    public function update_status($status)
    {
        try
        {
            $model = static::get_shop_status_model();
            $model->status = $status;
            if ( ! $model->save(false))
            {
                throw new Exception('update shop status failed.');
            }
        }
        catch (\Exception $e)
        {
            Log::error('update shop status failed.');
            return false;
        }

        return true;
    }

    /**
     * ショップステータス更新：初期ステータス
     *
     * @return boolean
     */
    public function update_status_init()
    {
        return static::update_status(Model_Shop_Status::STATUS_INIT);
    }

    /**
     * ショップステータス更新：審査申請中
     *
     * @return boolean
     */
    public function update_status_inspected()
    {
        return static::update_status(Model_Shop_Status::STATUS_INSPECTED);
    }

    /**
     * ショップステータス更新：ユーザー決済待機（※審査通過済）
     *
     * @return boolean
     */
    public function update_status_payment_wait()
    {
        return static::update_status(Model_Shop_Status::STATUS_PAYMENT_WAIT);
    }

    /**
     * ショップステータス更新：決済完了（※弊社公開処理待ち）
     *
     * @return boolean
     */
    public function update_status_payment_comp()
    {
        return static::update_status(Model_Shop_Status::STATUS_PAYMENT_COMP);
    }

    /**
     * ショップステータス更新：公開中
     *
     * @return boolean
     */
    public function update_status_ok()
    {
        return static::update_status(Model_Shop_Status::STATUS_OK);
    }

    /**
     * ショップステータス更新：BAN処理
     *
     * @return boolean
     */
    public function update_status_ban()
    {
        return static::update_status(Model_Shop_Status::STATUS_BAN);
    }

    /**
     * ショップステータス更新：一時停止（※マスター管理者による公開停止処理用）
     *
     * @return boolean
     */
    public function update_status_stop()
    {
        return static::update_status(Model_Shop_Status::STATUS_STOP);
    }

    /**
     * ショップステータス更新：有効期限切れ（※再決済の必要あり）
     *
     * @return boolean
     */
    public function update_status_expired()
    {
        return static::update_status(Model_Shop_Status::STATUS_EXPIRED);
    }

    /**
     * ショップステータス更新：退会
     *
     * @return boolean
     */
    public function update_status_leave()
    {
        return static::update_status(Model_Shop_Status::STATUS_LEAVE);
    }

    /**
     * JPaymentからの決済完了通知時のショップステータス更新処理
     *
     * @return boolean
     */
    public function update_status_after_payment()
    {
        $status = static::status();

        // ステータス：公開中(500) => 処理なし
        if ($status == Model_Shop_Status::STATUS_OK)
        {
            return true;
        }

        try
        {
            // ステータス：決済待機(300) => 更新：決済完了(400)
            if ($status == Model_Shop_Status::STATUS_PAYMENT_WAIT)
            {
                static::update_status_payment_comp();
            }

            // ステータス：有効期限切れ(800) => 更新：公開中(500)
            if ($status == Model_Shop_Status::STATUS_EXPIRED)
            {
                static::update_status_ok();
            }
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
        }
    }

    /**
     * 購入可否
     *     判定基準：ショップステータス
     * @return boolean
     */
    public function is_allow_buy_status()
    {
        $status = static::status();
        return $status == Model_Shop_Status::STATUS_PAYMENT_WAIT;
    }

    /**
     * 有効期限判定
     *
     * @return bool true:期限有効/false:期限切れ
     */
    public function is_alive_expired()
    {
        $model = static::get_shop_status_model();
        if (is_null($model))
        {
            return false;
        }

        if ( ! property_exists($model, 'expired_at') or is_null($model->expired_at))
        {
            return false;
        }

        // 有効期限判定
        $now    = new DateTime();
        $expire = new DateTime($model->expired_at);

        return $now <= $expire;
    }

    /**
     * 有効期限取得
     *
     * @return Datetime
     */
    public function expired_at()
    {
        $model = static::get_shop_status_model();
        if (is_null($model))
        {
            return null;
        }

        return new DateTime($model->expired_at);
    }

    /**
     * 有効期限切れの警告日時
     *
     * @return DateTime
     */
    public function expired_warning_datetime()
    {
        $conf = \Config::load('payment', true);

        $expired_at = $this->expired_at();
        if (is_null($expired_at))
        {
            return new DateTime();
        }

        $expire_unixtime = $expired_at->getTimestamp();

        $waning_unixtime = $expire_unixtime - $conf['expired_warning'];
        $warning = new DateTime();
        $warning->setTimestamp($waning_unixtime);

        return $warning;
    }

    /**
     * 有効期限切れ警告期間判定
     *
     * @return boolean true:警告期間/false:警告期間外
     */
    public function expired_warning()
    {
        $current = new DateTime();
        $warning = $this->expired_warning_datetime();
        return $current >= $warning;
    }

    /**
     * 購入可能商品の有無判定
     *
     * @return boolean true:あり/false:なし
     */
    public function exists_allow_sale_item()
    {
        $sale_item_list = Model_Master_Sale_Item::find_all();
        foreach ($sale_item_list as $sale_item)
        {
            $item = \Saleitem::instance(static::get_client_id(), $sale_item->iid);
            if ($item->check_allow_buy())
            {
                return true;
            }
        }
        return false;
    }

    /**
     * 購入履歴有無の判定
     *
     * @return boolean true:あり/false:なし
     */
    public function exists_payment_history()
    {
        $list = Model_Payment_History::find_by(array('client_id' => static::get_client_id()));
        if (is_null($list))
        {
            return false;
        }
        return true;
    }

    /**
     * 住所から緯度・経度を取得 (by Google Map API V3)
     *
     * @param string address
     * @return array lat:緯度/lng:経度
     */
    public function geocode($address)
    {
        $rs = array('lat' => '', 'lng' => '');

        if (empty($address))
        {
            return $rs;
        }

        try
        {
            $address = urlencode($address);
            $conf = \Config::load('original', true);
            $geo_search_url = $conf['geo_search_url'];
            $geo_search_url = str_replace('%%%address%%%', $address, $geo_search_url);
            $geo_data = file_get_contents($geo_search_url);
            $data = Format::forge($geo_data, 'XML')->to_array();

            if (isset($data['status']) and $data['status'] == 'OK')
            {
                $geo_location = $data['result']['geometry']['location'];
                $lat = $geo_location['lat'];
                $lng = $geo_location['lng'];
                $rs['lat'] = $lat;
                $rs['lng'] = $lng;
            }
        }
        catch (\Exception $e)
        {
            Log::error('geocode getting failed.');
        }

        return $rs;
    }

    /**
     * Inspectインスタンス取得
     *
     * @return Inspect
     */
    private function inspect()
    {
        if (is_null(static::$_inspect))
        {
            static::$_inspect = new Inspect(self::$_client_id);
        }
        return static::$_inspect;
    }

}

/* end of file auth.php */
