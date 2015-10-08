<?php
$lang = Configure::read('Config.language');
if($lang == 'vie' || $lang == 'vi') {
	$reserveDefaultMail = <<<EOM

■ Thời gian
[00:00 đến 00:00]

■ Số người
1 Người

■ Tên / âm

■ Số điện thoại

■ Các yêu cầu khác


EOM;

} elseif($lang == 'eng' || $lang == 'en') {
	$reserveDefaultMail = <<<EOM

■ Time
[00:00 to 00:00]

■ Number of people
1 person

■ Name / phonetic

■ Phone number

■ Other requests


EOM;

} else {
	$reserveDefaultMail = <<<EOM

■時間
[00:00〜00:00]

■人数
1名

■名前／ふりがな

■電話番号

■その他ご要望


EOM;

}
