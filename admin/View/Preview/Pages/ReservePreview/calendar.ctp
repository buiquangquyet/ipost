
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no" />
<title>iPost Enterprise</title>

<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<?php
echo $this->Html->css('preview.calendar');
?>





<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>




</head>

<body>



	<style type="text/css">
	body{
		color: #636363;
		font-family: "ヒラギノ角ゴ Pro W3", "Hiragino Kakugo Pro W3", Helvetica, Verdana, "ＭＳ Ｐゴシック", "MS P Gothic", "メイリオ", "Meiryo", Osaka, sans-serif;
				background: #FFFFFF;
	}
	h1 {
		padding: 10px 0px;
		color: #636363;
		background-color: #EBEBEB;
		padding-left: 4%;
		letter-spacing: 0.1em;
		font-weight: bold;
		font-size: 14px;
	}
	h2 {
		margin: 20px 4% 0px;
		padding-bottom: 10px;
		border-bottom: 1px solid #eee;
		font-size: 14px;
	}

	#appointment{
		width:240px;
	}
	table {
		/*width: 92%;*/
		width: 266px;
		color: #636363;
		/*margin: 4%;*/
		margin: auto;
		display: inline-block;
		font-family: "ヒラギノ角ゴ Pro W3", "Hiragino Kakugo Pro W3", Helvetica, Verdana, "ＭＳ Ｐゴシック", "MS P Gothic", "メイリオ", "Meiryo", Osaka, sans-serif;
		  font-size: 12px;
	}
tbody {/*
width: 100%;
line-height: 1.5;
margin-bottom: 20px;
*/}
table tr {
	border-bottom: 1px dotted #EEE;
}
table th {
	border-bottom: 1px solid #EEE;
	text-align: center;
	padding: 10px 0px;
	color: #6D6D6D;
}
table td {
	border-bottom: 1px dotted #EEE;
	text-align: center;
	padding: 9px 9px;
	color: #747474;
}
table td:first-child, table td:last-child{
	background-color: #FAFAFA;
}
th.#month span{line-height: 26px;}
a.prev-month,
a.next-month{
	display: inline-block;
	padding: 5px 10px;
}
.sun{
	color:#F66;
}
.sat{
	color:#6CF;
}
.c_g{
	color:#B9B9B9;
}

#month{
	color: #6D6D6D;
	line-height: initial;
	font-size: 14px;
}
.day{
	background: #B0E2DC;
	font-weight:bold;
	color: #fff;
}
#week{
	background: #F8F8F8;
}
.fl{float:left;}
.fr{float:right;}
.ml_4p{margin-left:4%;}
.mr_4p{margin-right:4%;}

@media screen and (min-width: 0px) and (max-device-width: 320px) {
	.calendar-box{
		width: 266px;
		margin: 4%;
		background:#FFFFFF;
	}
}
@media screen and (min-width: 321px) {
	.calendar-box{
		width: 266px;
		margin: 4% auto;
		background:#FFFFFF;
	}
}
</style>


<div id="appointment">

	<h1><i class="fa fa-calendar"></i>appointment</h1>
	<h2><?php echo __('予約カレンダー')?></h2>

	<div class="calendar-box">
		<table id="calendar" cellpadding="2" cellspacing="1">
			<tbody></tbody>
		</table>
	</div>
</div>


<script type="text/javascript">
$(function(){
    // 今日の日付データ取得
    var myDate = new Date();
    setupCalendar(myDate);
});

function setupCalendar(myDate){
    // 現在の日時の取得
    var nowDate = new Date();
    var nowYear = nowDate.getFullYear();
    var nowMonth = nowDate.getMonth();
    var nowToday = nowDate.getDate();

    // 曜日テーブル定義
    var myWeekTbl = new Array("SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT");
    // 英語表記
    var myMonthTbl= new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    // var myMonthTbl= new Array("1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月");
    // 月ごとの末日テーブル定義
    var myMonthDayTbl= new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

    // 年を取得
    var myYear = myDate.getFullYear();

    // うるう年だったら...
    if(((myYear % 4) == 0 && (myYear % 100) != 0) || (myYear % 400) == 0){
        // 2月を29日とする
        myMonthDayTbl[1] = 29;
    }
    // 月を取得(0月～11月)
    var myMonth = myDate.getMonth();
    // 今日の'日'を退避
    var myToday = myDate.getDate();
    // 日付を'１日'に変えて、
    myDate.setDate(1);
    // '１日'の曜日を取得
    var myWeek = myDate.getDay();
    // カレンダーの行数
    var myTblLine = Math.ceil((myWeek + myMonthDayTbl[myMonth]) / 7);
    // 表のセル数分定義
    var myTable = new Array(7 * myTblLine);

    // myTableを掃除する
    for (i = 0; i < 7 * myTblLine; i++){
    	myTable[i] = "&nbsp;";
    }
    // 日付を埋め込む
    for (i = 0 ; i < myMonthDayTbl[myMonth]; i++){
    	myTable[i + myWeek] = i + 1;
    }

    // ***********************
    //      カレンダーの表示
    // ***********************
    $("#appointment table#calendar tbody").html("");
    $("#appointment table#calendar tbody").append("<tr><th colspan=\"7\" id=\"month\"></th></tr>");
    // 先月
    $("#appointment table#calendar tbody th").append("<a href=\"javascript:void(0);\" class=\"prev-month fa fa-angle-left fl ml_4p\" onclick=\"prevMonth("+myYear+","+myMonth+")\">&nbsp;</a>");
    // 当月
    $("#appointment table#calendar tbody th").append("<span>"+myMonthTbl[myMonth]+" <i>"+myYear+"</i></span>");
    // 次月
    $("#appointment table#calendar tbody th").append("<a href=\"javascript:void(0);\" class=\"next-month fa fa-angle-right fr mr_4p\" onclick=\"nextMonth("+myYear+","+myMonth+")\">&nbsp;</a>");

    // 曜日
    $("#appointment table#calendar tbody").append("<tr id=\"week\"></tr>");
    for (i = 0; i < 7; i++){
    	if(i == 0){
            // 日曜のセルの色
            $("#appointment table#calendar tbody tr#week").append("<th class=\"sun\">"+myWeekTbl[i]+"</th>");

        } else if(i == 6){
            // 土曜のセルの色
            $("#appointment table#calendar tbody tr#week").append("<th class=\"sat\">"+myWeekTbl[i]+"</th>");

        } else {
        	$("#appointment table#calendar tbody tr#week").append("<th>"+myWeekTbl[i]+"</th>");
        }
    }

    // 表の「行」のループ
    for (i = 0; i < myTblLine; i++){
        $("#appointment table#calendar tbody").append("<tr class=\"week-"+(i+1)+"\"></tr>"); // 行の開始

        // 表の「列」のループ
        for (j = 0; j <7 ; j++){
            // 書きこむ内容の取得
            myDat = myTable[j + (i * 7)];
            var selectDate = myYear+"-"+(myMonth+1)+"-"+myDat;
            if(nowYear == myYear && nowMonth == myMonth && myDat == myToday){
                // 今日のセルの色
                $("#appointment table#calendar tbody tr.week-"+(i+1)).append("<td class=\"day\" onclick=\"selectedDay('"+selectDate+"')\">"+myDat+"</td>");

            } else {
                // 平日のセルの色
                $("#appointment table#calendar tbody tr.week-"+(i+1)).append("<td onclick=\"selectedDay('"+selectDate+"')\">"+myDat+"</td>");
            }
        }
    }
}

/**
* 前の年月を取得
*/
function prevMonth(year, month){
	if(month < 1){
		month = 12;
		year -= 1;
	}
	moveMonth(year, month);
}

/**
* 次の年月を取得
*/
function nextMonth(year, month){
	var next = month + 2;
	if(next > 12){
		next = 1;
		year += 1;
	}
	moveMonth(year, next);
}

function moveMonth(year, month){
    // 今日の日付データ取得
    var myDate = new Date();
    // 移動先の月
    myDate.setYear(year);
    myDate.setMonth(month - 1);

    setupCalendar(myDate);
}

/**
* メーラー起動
*/
function selectedDay(selectDate){
	var date = selectDate.split("-");
	if (date[2] == "" || date[2] == " ") return;

	selectDate = selectDate.replace('-', "<?php echo __('年') ?>");
	selectDate = selectDate.replace('-', "<?php echo __('月')?>");
	selectDate = selectDate + "<?php echo __('日')?>";

	var res = confirm("<?php echo __("下記の日付にて予約メールを送信いたしますか？")?>"+"\n\n"+selectDate);
    // 選択結果で分岐
    if(res == true){
    	alert('<?php echo __('メーラーが起動します。')?>');

    	var address = '<?php echo $reserveData['email']; ?>';
    	var subject = '<?php echo __('【重要】予約希望メール')?>';
    	var body = valueBody(selectDate);

    	location.href = 'mailto:' + address + '?subject=' + subject + '&body=' + body;
    }
}

/**
* メール本文設定
*/
function valueBody(selectDate){
	var value = '<?php echo __("■予約希望日%0D%0A")?>' + selectDate + '<?php echo str_replace("\r\n", '%0D%0A', $reserveData['mail_body']); ?>';
	return value;
}

/**
* GETパラメータ取得
*/
function getParam(){
	var url   = location.href;
	parameters    = url.split("?");
	params   = parameters[1].split("&");
	var paramsArray = [];
	for ( i = 0; i < params.length; i++ ){
		neet = params[i].split("=");
		paramsArray.push(neet[0]);
		paramsArray[neet[0]] = neet[1];
	}
	var categoryKey = paramsArray["key"];
	return categoryKey;
}
</script>


</body>
</html>

