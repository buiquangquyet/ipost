<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>iPost公式サイト</title>

<meta name="google-site-verification" content="qAFYD6iUAVASEcrvBUDUa08npgU6hpjK5OxK-wxo-xU" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes," />

<!-- Favicon Icon -->
<link href="/assets/img/favicon/ipost.png?{time()}" rel="icon" type="image/png" />

<link rel="stylesheet" type="text/css" href="/assets/css/demo_style.css" media="all" />
<link rel="stylesheet" href="/assets/css/normalize.css">
<link rel="stylesheet" href="/assets/css/styles.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="/assets/js/jquery.mobile-menu.js"></script>
<script> 
               $(function(){
                    $("body").mobile_menu({
                         menu: ['#main-nav ul', '#secondary-nav ul'],
                menu_width: 180,
                prepend_button_to: '#mobile-bar'
                    });
               });
              
               $('#menu_close').click(function(){
                    alert('menu_close');
                    });
              
          </script>
          
          
</head>
<body>


<div id="head">
<p><img src="/assets/img/logo_demo.png" alt="お店のロゴ" class="shop_logo" /></p>
</div>


<nav id="mobile-bar"></nav>
              
<nav id="main-nav">
    <ul class="menu">
    <li id="menu_close_li"><a href="javascript:void(0);" id="menu_close">× ｃｌｏｓｅ</a></li>
    <li><a href="/demo">トップ</a></li>
    <li><a href="/demo/news">ニュース</a></li>
    <li><a href="/demo/coupon">クーポン</a></li>
    <li><a href="/demo/menu">メニュー</a></li>
    </ul>
</nav>


<div class="clear"></div>

