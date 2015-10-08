iPost Enterprise運営事務局でございます。
この度はiPost Enterpriseへご登録いただきまして誠に有難うございます。
以下の登録内容にて登録が完了しました。

■登録内容 -----------------
お名前: <?php echo $user_name;?>

メールアドレス: <?php echo $email;?>

-------------------------

以下のiPost Enterprise管理画面URLへアクセスしていただき下記のユーザーID/パスワードにてログインしてください。
iPost Enterprise管理画面ではアプリ制作を進めていただけます。
オリジナリティ溢れる素晴らしいアプリが制作できるiPost Enterpriseを是非体感してください！

■iPost Enterprise管理画面情報 --------
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
    echo "iPost Enterprise管理画面URL: " . $login_url . "?lang=" . $lang . "\n\n";
}
?>

パスワード: <?php echo $password;?>

-------------------------

※ご不明な点がございましたら下記のiPost Enterprise運営事務局までお気軽お尋ねください。

-------------------------
 iPost Enterprise運営事務局
 support3@hiropro.co.jp
