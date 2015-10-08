<?php
$lang = Configure::read('Config.language');
if($lang == 'vie' || $lang == 'vi') {
	$reserveDefaultUsage = <<<EOM

Dùng nút dưới đây để gọi điện thoại hoặc gửi mail.

Trong trường hợp muốn gửi mail, hãy tiến hành gửi sau khi đã nhập nội dung cần thiết vào ô "Nội dung mail".

Cũng có trường hợp cửa hàng bị  nghẽn nên khách hàng sẽ nhận được câu trả lời muộn.

EOM;
} elseif($lang == 'eng' || $lang == 'en') {
	$reserveDefaultUsage = <<<EOM

Use the buttons below to call or send mail.

In case wants to send mail, please proceed to send after typing required content in the "Contents of mail".

There were also cases of blocked outlets so that customers will get the answer later.

EOM;
} else {
	$reserveDefaultUsage = <<<EOM

下記ボタンからの電話発信、または、メールの送信になります。

メール送信の場合は、本文に必要事項を記載の上送信してください。

お店の混雑具合によって、返信が遅くなる場合がございます。

EOM;
}