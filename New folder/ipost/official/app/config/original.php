<?php
/**
 * 各種設定ファイル
 *
 * ・アプリ内の各所で利用する汎用的な設定項目は本ファイルへ記述
 * ・config.phpと分ける目的で本ファイルを設置
 * ・設定内容に特に決まりはないがパッケージ化したものなどはそちらの専用ファイルへ記述
 */

return array(
    /**
     * ログインページURL(※相対パス)
     */
    'login_url_path' => 'auth/login',

    /**
     * DB: Deleteフラグ値
     */
    'delete_flg' => 1,

    /**
     * imageパス
     */
    'img_path' => '/assets/img/',

    /**
     * cssパス
     */
    'css_path' => '/assets/css/',

    /**
     * jsパス
     */
    'js_path' => '/assets/js/',

    /**
     * TOPスライド画像：最大エントリ数
     */
    'top_image_max' => 5,

    /**
     * COUPN画像：最大エントリ数
     */
    'coupon_image_max' => 5,

    /**
     * Google Map API V3: 検索先URLテンプレート
     */
    'geo_search_url' => 'http://maps.googleapis.com/maps/api/geocode/xml?sensor=true&address=%%%address%%%',

    /**
     * お知らせ表示件数
     */
    'info_limit' => 10,

    /**
     * リジェクト表示件数
     */
    'reject_limit' => 10,

    /**
     * SSH:設定
     *     host: domain or IP Address
     */
    'ssh_setting' => array(
        'img_gateway' => array(
            'host'     => '127.0.0.1',
            'port'     => 22,
            'username' => 'root',
            'password' => 'CeoxnZ34k'
        ),
    ),
);
