<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes" />
<title><?php echo $title_for_layout; ?></title>
<base href="<?php echo $this->html->url('/', true);?>"/>
<?php
echo $this->Html->css('bootstrap.css');
echo $this->Html->css('style.css');
echo $this->Html->css('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
echo $this->Html->css('jquery.mmenu.all.css');
echo $this->Html->css('sub.css');

echo $this->Html->script('//code.jquery.com/jquery-1.11.0.min.js');
echo $this->Html->script('//code.jquery.com/jquery-migrate-1.2.1.min.js');
echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery.mmenu.min.all');
echo $this->Html->script('module');

// プログラム内からの内容の読み込み
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>

<script type="text/javascript">
 $(function() {
  $("#menu").mmenu({});
 });
</script>
</head>

<body>
<nav id="menu">
  <ul>
    <li><a href="/"><i class="fa fa-home">&nbsp;&nbsp;</i><?php echo __('Home'); ?></a></li>
    <li><a href="client/list"><i class="fa fa-paperclip">&nbsp;&nbsp;</i><?php echo __('クライアント管理'); ?></a>
      <ul>
        <li><a href="client/list"><?php echo __('アカウント一覧'); ?></a></li>
        <li><a href="client/add"><?php echo __('アカウント新規登録'); ?></a></li>
      </ul>
    </li>
    <li><a href="statistics/appli"><i class="fa fa-mobile">&nbsp;&nbsp;</i><?php echo __('アプリケーション'); ?></a>
      <ul>
        <li><a href="statistics/appli"><?php echo __('アプリ公開数'); ?></a></li>
        <li><a href="statistics/download"><?php echo __('ダウンロード数一覧'); ?></a></li>
      </ul>
    </li>
    <li>
      <a href="inspect/list"><i class="fa fa-file-text">&nbsp;</i><?php echo __('審査申請アプリ一覧'); ?></a>
    </li>
    <li><a href="agent/info"><i class="fa fa-building">&nbsp;&nbsp;</i><?php echo __('代理店情報'); ?></a></li>
    <li><a href="country"><i class="fa fa-life-ring"></i>&nbsp;&nbsp;<?php echo __('国管理'); ?></a></li>
  </ul>
</nav>

<div class="header clearfix">
  <div class="res_btn_wrap">
    <a href="#menu" id="res_btn"><i class="fa fa-bars"></i></a>
  </div>

  <div class="logo_img">
    <a href="/"><img src="/img/common/logo.png"></a>
  </div>

  <div class="logout_wrap">
    <a href="auth/logout" class="fa-logout logout_bg maru"><i class="fa fa-sign-out logout_c"></i></a>
    <div class="head_navi_txt01 sm_non"><?php echo __('ログアウト'); ?></div>
  </div>
</div>

<div class="all clearfix">
  <div class="sub_nav">
    <div class="fl clearfix">
      <ul id="sub_nav_icon">
        <li onclick="location.href(locationRoot());"><i class="fa fa-home"></i></li>
        <li href="#tabmenu1" data-toggle="tab"><i class="fa fa-user"></i></li>
        <li href="#tabmenu2" data-toggle="tab"><i class="fa fa-bar-chart"></i></li>
        <li href="#tabmenu3" data-toggle="tab"><i class="fa fa-file-text"></i></li>
        <li href="#tabmenu4" data-toggle="tab"><i class="fa fa-building"></i></li>
        <li href="#tabmenu5" data-toggle="tab"><i class="fa fa-life-ring"></i></li>
      </ul>
    </div>

    <div class="tab-content">
      <ul class="sidebar-group tab-pane <?php if($controller == 'top' || $controller == 'client' || $controller == 'shop') echo ' active'; else {} ?>" id="tabmenu1">
        <li class="navigation-header sub_nav_title"><i class="fa fa-user ml_20">&nbsp;</i><?php echo __('ユーザー管理'); ?></li>
        <li class="navigation-header sub_nav_subtitle"><?php echo __('クライアント管理'); ?></li>
        <li class="sub_nav_menu1"><a href="client/list"><?php echo __('アカウント一覧'); ?></a></li>
        <li class="sub_nav_menu1"><a href="client/add"><?php echo __('新規登録'); ?></a></li>
      </ul>

      <ul class="sidebar-group tab-pane<?php if($controller == 'statistics') echo ' active'; else {} ?>" id="tabmenu2">
        <li class="navigation-header sub_nav_title"><i class="fa fa-bar-chart ml_20">&nbsp;</i><?php echo __('統計表示'); ?></li>
        <li class="navigation-header sub_nav_subtitle"><?php echo __('アプリケーション'); ?></li>
        <li class="sub_nav_menu1"><a href="statistics/appli"><?php echo __('アプリ公開数'); ?></a></li>
        <li class="sub_nav_menu1"><a href="statistics/download"><?php echo __('ダウンロード数一覧'); ?></a></li>
      </ul>
      <ul class="sidebar-group tab-pane<?php if($controller == 'inspect' || $controller == 'store' || $controller == 'appli') echo ' active'; else {} ?>" id="tabmenu3">
        <li class="navigation-header sub_nav_title"><i class="fa fa-file-text ml_20">&nbsp;</i><?php echo __('審査申請'); ?></li>
        <li class="sub_nav_menu1"><a href="inspect/list"><?php echo __('審査申請アプリ一覧'); ?></a></li>
      </ul>
      <ul class="sidebar-group tab-pane<?php if($controller == 'agent') echo ' active'; else {} ?>" id="tabmenu4">
        <li class="navigation-header sub_nav_title"><i class="fa fa-bar-chart ml_20">&nbsp;</i><?php echo __('代理店管理'); ?></li>
        <li class="sub_nav_menu1"><a href="agent/info"><?php echo __('代理店情報'); ?></a></li>
      </ul>
      <ul class="sidebar-group tab-pane<?php if($controller == 'country') echo ' active'; else {} ?>" id="tabmenu5">
        <li class="navigation-header sub_nav_title"><i class="fa fa-life-ring ml_20">&nbsp;</i><?php echo __('国管理'); ?></li>
        <li class="sub_nav_menu1"><a href="country"><?php echo __('国管理'); ?></a></li>
      </ul>
    </div>
  </div>

  <?php echo $this->fetch('content'); ?>
</div>

<script>
function locationRoot(){location.href = "/";}
</script>

</body>
</html>
