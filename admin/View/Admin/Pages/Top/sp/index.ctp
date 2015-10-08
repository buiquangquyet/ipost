<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes," />
<title>iPostアプリ管理画面</title>
	<?php
		echo $this->Html->meta('icon');

		// テンプレート読み込み


		// jQueryのCDNから読み込み
		echo $this->Html->script('//code.jquery.com/jquery-1.11.0.min.js');
		echo $this->Html->script('jquery-ui.min');
		echo $this->Html->script('jquery.ui.datepicker-ja.min');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js');
		echo $this->Html->script('https://www.gstatic.com/swiffy/v6.0/runtime.js');
		echo $this->Html->script('form');
		echo $this->Html->script('module');

        // プログラム内からの内容の読み込み
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

<!-- Favicon Icon -->
<link href='common/sp/head.png' rel="shortcut icon" type="image/png" />
    <link rel="stylesheet" type="text/css" href="http://mc.i-post.jp/anami/ipost_appli_phone/css/style_phone.css" media="all" />
    <link rel="stylesheet" href="http://mc.i-post.jp/anami/ipost_appli_phone/css/normalize.css">
    <link rel="stylesheet" href="http://mc.i-post.jp/anami/ipost_appli_phone/css/styles.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="http://mc.i-post.jp/anami/ipost_appli_phone/js/jquery.mobile-menu.js"></script>
    <script>
       $(function(){
            $("body").mobile_menu({
                 menu: ['#main-nav ul', '#secondary-nav ul'],
        menu_width: 200,
        prepend_button_to: '#mobile-bar'
            });
       });

       $('#menu_close').click(function(){
            alert('menu_close');
            });
    </script>
</head>
<body>
<p id="top"></p>
<div id="head">

    <p class="head_logo"><?php echo $this->Html->image('common/sp/head.png', array('alt' => 'head', 'class'=>"logo")); ?></p>
	<p><a href="/"><?php echo $this->Html->image('common/sp/home_btn.png', array('alt' => 'home', 'class'=>"home_btn")); ?></a></p>


</div><!-- (/head) -->
<div class="clear"></div>

<section>
    <div class="sechead_news b_g">
        <h2 class="sechead_h2"><span>NEWS</span></h2>
    </div>
    <div class="secbody">
        <ul>
            <li><a href="./news"><span class="list_sec">ニュースを配信する</span><span class="blue_arrow"><?php echo $this->Html->image('common/sp/blue_arrow2.png', array('alt' => 'allow')); ?></span></a></li>
        </ul>
    </div>
</section>

<div id="foot">
<div id="foot_bottom">
<p>Copyright © 2015 HIROPRO, Inc. All Rights Reserved.</p>
</div><!-- (/foot_bottom) -->
</div><!-- (/foot) -->

</body>
</html>