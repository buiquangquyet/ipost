<?php
/**
 * アプリケーション独自設定ファイル
 */

// ----------------------------------------------------------------------
// - 対応言語
// ----------------------------------------------------------------------
$config ['LanguagesList'] = [
    'en' => 'English', //English
    'ja' => 'Japanese', //Japanese
    'vi' => 'Vietnamese', //Vietnamese
    //'zh' => 'Chines', //Chines
];

// ----------------------------------------------------------------------
// - ヘッダー設定利用マスター情報
// ----------------------------------------------------------------------

$config['ColorInfo'] = array(
    'c' => array(
        'c_01', 'c_02', 'c_03', 'c_04', 'c_05', 'c_06', 'c_07', 'c_08', 'c_09', 'c_10',
        'c_11', 'c_12', 'c_13', 'c_14', 'c_15',
    ),
    'g' => array(
        'g_01', 'g_02', 'g_03', 'g_04', 'g_05', 'g_06', 'g_07', 'g_08', 'g_09', 'g_10',
        'g_11', 'g_12', 'g_13', 'g_14', 'g_15',
    ),
);

// ----------------------------------------------------------------------
// - フッダー設定利用マスター情報
// ----------------------------------------------------------------------

// フッターメニュータイプリスト
$config['FooterMenuTypeList'] = array(
    ''             => '未使用',
    'top'          => 'トップ',
    'news'         => 'ニュース',
    'menu'         => 'メニュー',
    'coupon'       => 'クーポン',
    'setting'      => '設定',
    'tel'          => '電話',
    'mail'         => 'メール',
    'map'          => '地図',
    'shopprofile'  => '店舗情報',
);

// 説明付きアイコンリスト
$config['DescriptionWithIconList'] = array(
    array('description' => 'トップ',       'icon' => 'A'),
    array('description' => 'セッティング', 'icon' => 'B'),
    array('description' => 'HTML',         'icon' => 'C'),
    array('description' => 'クーポン',     'icon' => 'D'),
    array('description' => '通知',         'icon' => 'E'),
    array('description' => 'マップ',       'icon' => 'F'),
    array('description' => 'メニュー',     'icon' => 'G'),
    array('description' => 'カート',       'icon' => 'H'),
    array('description' => 'ショップ',     'icon' => 'I'),
    array('description' => '電話',         'icon' => 'J'),
    array('description' => 'コイン',       'icon' => 'K'),
    array('description' => 'ニュース',     'icon' => 'L'),
    array('description' => 'ギャラリー',   'icon' => 'N'),
    array('description' => 'ユーザー',     'icon' => 'M'),
    array('description' => 'メール',       'icon' => 'O'),
    array('description' => 'シェア',       'icon' => 'P'),
    array('description' => '通知',         'icon' => 'Q'),
    array('description' => 'スマホ',       'icon' => 'R'),
);
// PHPの5.5と5.3の互換性対策
if (! function_exists('array_column')) {
    function array_column($iconList, $columnName) {
        $returnList = array();
        foreach($iconList as $info) {
            $returnList[] = $info[$columnName];
        }
        return $returnList;
    }
}

// 説明付きアイコンリストからアイコンだけを抽出
$config['IconList'] = array_column($config['DescriptionWithIconList'], 'icon');

// ----------------------------------------------------------------------
// - 店舗情報設定利用マスター情報
// ----------------------------------------------------------------------

/**
 * 都道府県一覧を取得します。
 */
$config['PrefList'] = array(
    ''   => __('都道府県を選択'),
    '1'  => __('北海道'),
    '2'  => __('青森県'),
    '3'  => __('岩手県'),
    '4'  => __('宮城県'),
    '5'  => __('秋田県'),
    '6'  => __('山形県'),
    '7'  => __('福島県'),
    '8'  => __('茨城県'),
    '9'  => __('栃木県'),
    '10' => __('群馬県'),
    '11' => __('埼玉県'),
    '12' => __('千葉県'),
    '13' => __('東京都'),
    '14' => __('神奈川県'),
    '15' => __('新潟県'),
    '16' => __('富山県'),
    '17' => __('石川県'),
    '18' => __('福井県'),
    '19' => __('山梨県'),
    '20' => __('長野県'),
    '21' => __('岐阜県'),
    '22' => __('静岡県'),
    '23' => __('愛知県'),
    '24' => __('三重県'),
    '25' => __('滋賀県'),
    '26' => __('京都府'),
    '27' => __('大阪府'),
    '28' => __('兵庫県'),
    '29' => __('奈良県'),
    '30' => __('和歌山県'),
    '31' => __('鳥取県'),
    '32' => __('島根県'),
    '33' => __('岡山県'),
    '34' => __('広島県'),
    '35' => __('山口県'),
    '36' => __('徳島県'),
    '37' => __('香川県'),
    '38' => __('愛媛県'),
    '39' => __('高知県'),
    '40' => __('福岡県'),
    '41' => __('佐賀県'),
    '42' => __('長崎県'),
    '43' => __('熊本県'),
    '44' => __('大分県'),
    '45' => __('宮崎県'),
    '46' => __('鹿児島県'),
    '47' => __('沖縄県'),
);

// ----------------------------------------------------------------------
// - 使用しているカラーコードマスター情報
// ----------------------------------------------------------------------
$config['ColorCode'] = array(
    '01' => array(
    	'c' => ['color' => '941F22', 'sub_color' => 'CC3B44', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => '920106', 'gradation2' => 'ca7679', 'bar_gradation1' => 'D7261B', 'bar_gradation2' => '7D181D', 'sub_gradation' => 'C51F22', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
    '02' => array(
    	'c' => ['color' => 'DD2D21', 'sub_color' => 'EC6E6F', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => 'ed2c1f', 'gradation2' => 'ffaca8', 'bar_gradation1' => 'E50011', 'bar_gradation2' => 'A20007', 'sub_gradation' => 'EA1328', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
    '03' => array(
    	'c' => ['color' => 'AE4092', 'sub_color' => 'D28AB3', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => 'b03b93', 'gradation2' => 'f0a3d9', 'bar_gradation1' => 'AE4092', 'bar_gradation2' => '631875', 'sub_gradation' => 'AE4092', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
    '04' => array(
    	'c' => ['color' => 'E24882', 'sub_color' => 'F09ABD', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => 'e5377a', 'gradation2' => 'ffa9c8', 'bar_gradation1' => 'E24882', 'bar_gradation2' => 'A81834', 'sub_gradation' => 'E24882', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
    '05' => array(
    	'c' => ['color' => 'EB5F35', 'sub_color' => 'F4A430', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => 'ff8a01', 'gradation2' => 'ffd6b5', 'bar_gradation1' => 'EB5F35', 'bar_gradation2' => 'BA1A00', 'sub_gradation' => 'EB5F35', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
    '06' => array(
    	'c' => ['color' => 'F5BB00', 'sub_color' => 'E4D40B', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => 'fdaf06', 'gradation2' => 'ffe598', 'bar_gradation1' => 'F5BB00', 'bar_gradation2' => 'C7671E', 'sub_gradation' => 'F5BB00', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
    '07' => array(
    	'c' => ['color' => '86C68A', 'sub_color' => 'B4DAB2', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => '70c475', 'gradation2' => 'cef6cf', 'bar_gradation1' => '86C68A', 'bar_gradation2' => '4C834D', 'sub_gradation' => '86C68A', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
    '08' => array(
    	'c' => ['color' => '00AA84', 'sub_color' => '6EC3B0', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => '19a883', 'gradation2' => 'acf8df', 'bar_gradation1' => '00AA84', 'bar_gradation2' => '006548', 'sub_gradation' => '00AA84', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
    '09' => array(
    	'c' => ['color' => '29493E', 'sub_color' => '639383', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => '2b4d42', 'gradation2' => '66887b', 'bar_gradation1' => '29483E', 'bar_gradation2' => '02150C', 'sub_gradation' => '29483E', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
    '10' => array(
    	'c' => ['color' => '2679BF', 'sub_color' => '6CA8DB', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => '3f65be', 'gradation2' => '96b7e0', 'bar_gradation1' => '2679BF', 'bar_gradation2' => '105579', 'sub_gradation' => '2679BF', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
    '11' => array(
    	'c' => ['color' => '4296D2', 'sub_color' => '79CAF2', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => '0285cc', 'gradation2' => 'b2d4f0', 'bar_gradation1' => '4296D2', 'bar_gradation2' => '336991', 'sub_gradation' => '4296D2', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
    '12' => array(
    	'c' => ['color' => '6B403A', 'sub_color' => '94736F', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => '6f4741', 'gradation2' => 'b19895', 'bar_gradation1' => '6B403A', 'bar_gradation2' => '3F221E', 'sub_gradation' => '6B403A', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
    '13' => array(
    	'c' => ['color' => 'AE7D50', 'sub_color' => 'C7B580', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => 'ab7a4b', 'gradation2' => 'dcbea2', 'bar_gradation1' => 'AE7D50', 'bar_gradation2' => '6E492B', 'sub_gradation' => 'AE7D50', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
    '14' => array(
    	'c' => ['color' => '8B8F96', 'sub_color' => 'C1C1C6', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => '6b6b6b', 'gradation2' => 'b7b8ba', 'bar_gradation1' => '8B8F96', 'bar_gradation2' => '5E5A57', 'sub_gradation' => '8B8F96', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
    '15' => array(
    	'c' => ['color' => '2B2B2B', 'sub_color' => '8F8F90', 'text' => 'FFFFFF', 'view' => 'FFFFFF'],
        'g' => ['gradation1' => '030303', 'gradation2' => '777777', 'bar_gradation1' => '6B6B6B', 'bar_gradation2' => '000000', 'sub_gradation' => '000000', 'text' => 'FFFFFF', 'view' => 'FFFFFF']),
);



// ======================================================================
// = 初期設定値
// ======================================================================

// ----------------------------------------------------------------------
// - ブロック初期設定値
// ----------------------------------------------------------------------
$config['block_info'] = array(
    'image' => array('del' => 0, 'images' => array(
            array(
                'image_type' => '0', // 0:未設定 1:画像 3:youtube
                'image' => '', // イメージのID
                'youtube' => '', // youtubeID
                'link_type' => '0', // 0:設定ない 1:url指定 2:アプリ内リンク
                'url' => '', // リンク先
                'link_app' => '', // アプリ内リンク先
                'date' => '-', // 更新日付
            ),
            array(
                'image_type' => '0', // 0:未設定 1:画像 3:youtube
                'image' => '', // イメージのID
                'youtube' => '', // youtubeID
                'link_type' => '0', // 0:設定ない 1:url指定 2:アプリ内リンク
                'url' => '', // リンク先
                'link_app' => '', // アプリ内リンク先
                'date' => '-', // 更新日付
            ),
            array(
                'image_type' => '0', // 0:未設定 1:画像 3:youtube
                'image' => '', // イメージのID
                'youtube' => '', // youtubeID
                'link_type' => '0', // 0:設定ない 1:url指定 2:アプリ内リンク
                'url' => '', // リンク先
                'link_app' => '', // アプリ内リンク先
                'date' => '-', // 更新日付
            ),
            array(
                'image_type' => '0', // 0:未設定 1:画像 3:youtube
                'image' => '', // イメージのID
                'youtube' => '', // youtubeID
                'link_type' => '0', // 0:設定ない 1:url指定 2:アプリ内リンク
                'url' => '', // リンク先
                'link_app' => '', // アプリ内リンク先
                'date' => '-', // 更新日付
            ),
            array(
                'image_type' => '0', // 0:未設定 1:画像 3:youtube
                'image' => '', // イメージのID
                'youtube' => '', // youtubeID
                'link_type' => '0', // 0:設定ない 1:url指定 2:アプリ内リンク
                'url' => '', // リンク先
                'link_app' => '', // アプリ内リンク先
                'date' => '-', // 更新日付
            ),
        ),
    ),
    'topic' => array('del' => 0, 'message' => ''),
    'news' => array('del' => 0),
    'menu' => array('del' => 0, 'menus' => array( // からのメニューが5つ。
        '',
        '',
        '',
        '',
        '',
        ),
    ),
    'map' => array('del' => 0),
    'coupon' => array('del' => 0),
    'webview' => array('del' => 0, 'url' => ''),
    'sns' => array('del' => 0, 'snsinfo' => array('sns_1' => '','sns_2' => '','sns_3' => '','sns_4' => '','sns_5' => '')),
    'tel' => array('del' => 0),
    'cms' => array('del' => 0, 'height' => '640'),
    'margin' => array('del' => 0, 'margin' => '10')
);


// ----------------------------------------------------------------------
// - ショップステータス初期設定値
// ----------------------------------------------------------------------

$config['shop_status_info'] = array(
    'status' => '100',
    'expired' => '',
);

// ----------------------------------------------------------------------
// - ストア初期設定値
// ----------------------------------------------------------------------

$config['store_info'] = array(
    'image' => array(
        'icon' => '', // アプリアイコン
        'publicity' => '', // GooglePlay宣伝用画像
    ),
    'text' => array( // 文字情報
        'app_name' => '', // アプリ名
        'store_name' => '', // ストアでの表示名
        'description' => '', // ストア説明文
        'keyword' => '', // AppStoreキーワード
    ),
    'category' => array( // カテゴリー
        'apple1' => '', // AppStore主カテゴリー
        'apple2' => '', // AppleStore副カテゴリー
        'android' => '', // AndroidPlayカテゴリー
    ),
    'url' => array( // アプリURL
        'apple' => '', // AppStoreアプリのURL
        'google' => '', // GooglePlayアプリのURL
    ),
);

// ----------------------------------------------------------------------
// - ヘッダー初期設定値
// ----------------------------------------------------------------------

// {"header":{"color":"","image":""}}
$config['header_info'] = array(
    'header' => array(
        'image' => '',
        'color' => '',
    ),
);

// ----------------------------------------------------------------------
// - フッダー初期設定値
// ----------------------------------------------------------------------

$config['footer_info'] = array(
    array('name' => '', 'type' => '', 'icon' => ''),
    array('name' => '', 'type' => '', 'icon' => ''),
    array('name' => '', 'type' => '', 'icon' => ''),
    array('name' => '', 'type' => '', 'icon' => ''),
    array('name' => '', 'type' => '', 'icon' => ''),
);

// ----------------------------------------------------------------------
// - サイドメニュー初期設定値
// ----------------------------------------------------------------------
$config['sidemenu_info'] = array(
    'top' => array('enable' => 1, 'name' => __('トップ'), 'icon' => 'A'),
    'news' => array('enable' => 1, 'name' => __('ニュース'), 'icon' => 'L'),
    'menu' => array('enable' => 1, 'name' => __('メニュー'), 'icon' => 'G'),
    'coupon' => array('enable' => 1, 'name' => __('クーポン'), 'icon' => 'D'),
    'shopprofile' => array('enable' => 1, 'name' => __('店舗情報'), 'icon' => 'I'),
    'setting' => array('enable' => 1, 'name' => __('セッティング'), 'icon' => 'B'),
    'tel' => array('enable' => 1, 'name' => __('電話する'), 'icon' => 'J'),
    'mail' => array('enable' => 1, 'name' => __('メールする'), 'icon' => 'O'),
    'map' => array('enable' => 1, 'name' => __('マップ'), 'icon' => 'F'),
    );

// ----------------------------------------------------------------------
// - サイドメニュー初期設定値
// ----------------------------------------------------------------------

$config['side_info'] = array(
    array('name' => 'トップ', 'key' => 'top', 'file_name' => 'A', 'enable' => '1', 'position' => '1'),
    array('name' => 'ニュース', 'key' => 'news', 'file_name' => 'L', 'enable' => '1', 'position' => '2'),
    array('name' => 'メニュー', 'key' => 'menu', 'file_name' => 'G', 'enable' => '1', 'position' => '3'),
    array('name' => 'クーポン', 'key' => 'coupon', 'file_name' => 'D', 'enable' => '1', 'position' => '4'),
    array('name' => '店舗情報', 'key' => 'shopprofile', 'file_name' => 'I', 'enable' => '1', 'position' => '5'),
    array('name' => 'セッティング', 'key' => 'setting', 'file_name' => 'B', 'enable' => '1', 'position' => '6'),
    array('name' => '電話する', 'key' => 'tel', 'file_name' => 'J', 'enable' => '1', 'position' => '7'),
    array('name' => 'メールする', 'key' => 'mail', 'file_name' => 'O', 'enable' => '1', 'position' => '8'),
    array('name' => 'マップ', 'key' => 'map', 'file_name' => 'F', 'enable' => '1', 'position' => '9'),
);

// ----------------------------------------------------------------------
// - 背景初期設定値
// ----------------------------------------------------------------------

// {"background":{"color":"","image":""}}
$config['background_info'] = array(
    'background' => array(
        'image' => '',
        'color' => '',
    ),
);

// ----------------------------------------------------------------------
// - スプラッシュ初期設定値
// ----------------------------------------------------------------------

// {"splash":{"image":"","movie":""}}
$config['splash_info'] = array(
    'splash' => array(
        'image' => '',
        'movie' => '',
    ),
);

// ----------------------------------------------------------------------
// - 店舗情報初期設定値
// ----------------------------------------------------------------------

$config['shop_info'] = array(
    'image' => '',
    'profile' => array(
        'shop_name'   => '',
        'zip_code1'   => '',
        'zip_code2'   => '',
        'tel1'         => '',
        'tel2'         => '',
        'tel3'         => '',
        'fax1'         => '',
        'fax2'         => '',
        'fax3'         => '',
        'address'     => '',
        'email'       => '',
        'url'         => '',
        'online_shop' => '',
        'open_hours'  => '',
        'holiday'     => '',
    ),
);

$config['web_info'] = array(
    'html'       => '',
    'css'        => '',
    'image_list' => array(),
);

// ----------------------------------------------------------------------
// - クーポン初期設定値
// ----------------------------------------------------------------------
$config['coupon_info'] = array(
    array('image' => '', 'enable_flg' => '', 'title' => '', 'policy' => '', 'coupon_type' =>'', 'term_flg' => '0', 'discount' => '', 'display_days' => '', 'start_datetime' => '', 'end_datetime' => '', 'hash' => ''),
    array('image' => '', 'enable_flg' => '', 'title' => '', 'policy' => '', 'coupon_type' =>'', 'term_flg' => '0', 'discount' => '', 'display_days' => '', 'start_datetime' => '', 'end_datetime' => '', 'hash' => ''),
    array('image' => '', 'enable_flg' => '', 'title' => '', 'policy' => '', 'coupon_type' =>'', 'term_flg' => '0', 'discount' => '', 'display_days' => '', 'start_datetime' => '', 'end_datetime' => '', 'hash' => ''),
    array('image' => '', 'enable_flg' => '', 'title' => '', 'policy' => '', 'coupon_type' =>'', 'term_flg' => '0', 'discount' => '', 'display_days' => '', 'start_datetime' => '', 'end_datetime' => '', 'hash' => ''),
    array('image' => '', 'enable_flg' => '', 'title' => '', 'policy' => '', 'coupon_type' =>'', 'term_flg' => '0', 'discount' => '', 'display_days' => '', 'start_datetime' => '', 'end_datetime' => '', 'hash' => ''),
    );

// ----------------------------------------------------------------------
// - 予約カレンダー初期設定値
// ----------------------------------------------------------------------

$config['reservation_calendar'] = array(
    'use'        => '0',
    'use_method' => '',
    'mail_body'  => '',
    'contact'    => array(
        'tel1'      => '',
        'tel2'      => '',
        'tel3'      => '',
        'email'     => '',
    ),
);

$config['news_list'] = array(
    'list' => array(),
);

$config['news_info'] = array(
    'use_media' => '0',
    'media'     => '',
    'title'     => '',
    'body'      => '',
    'push'      => '',
    'delivery'  => '',
    'date'      => '',
    'hour'      => '',
    'minute'    => '',
);

