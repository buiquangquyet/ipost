謝謝登錄iPost HK營運事務所。
以下登錄內容登錄完成

■登錄內容 -----------------
名字:<?php echo $user_name;?>
電郵地址:<?php echo $email;?>
-------------------------

請進入以下iPost HKURL, 利用用戶ID/密碼登入
iPost HKではアプリ制作を進めていただけます。
在iPost HK內可進行App程式製作

■iPost HK情報 --------
<?php
foreach ((array)$langs as $lang) {
    switch ($lang) {
        case 'jpn':
            echo "日文版 App\n";
            break;
        case 'eng':
            echo "廣東語版 App\n";
            break;
        case 'chi':
            echo "英語版 App\n";
            break;
        case 'vie':
            echo "越南語版 App\n";
            break;
    }
    echo "iPost HK管理畫面URL: " . $login_url . "?lang=" . $lang . "\n\n";
}
?>
密碼:<?php echo $password;?>
-------------------------

※如有不明之處,請與以下%%%admin_name%%%連絡。

-------------------------
 iPost HK運営事務局
 support@ipost-hk.com
