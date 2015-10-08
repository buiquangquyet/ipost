<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes" />
<title><?php echo $title_for_layout; ?></title>

<!-- メタデータ・コンテンツ -->
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">

<?php
echo $this->Html->css('//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css');
echo $this->Html->css('bootstrap.min');
echo $this->Html->css('bootstrap-theme.min');
echo $this->Html->css('style');

echo $this->Html->script('//code.jquery.com/jquery-1.11.0.min.js');
echo $this->Html->script('//code.jquery.com/jquery-migrate-1.2.1.min.js');
echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('form');
echo $this->Html->script('module');

echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>
</head>

<body>

<!-- ▼ Header -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"><?php echo __('マスター管理画面'); ?><small>&nbsp;|&nbsp;<?php echo __('エンタープライズ'); ?></small></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <!-- ▼ Dropdown Menu -->
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-users"></i>&nbsp;<?php echo __('アカウント管理'); ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class=""><a href="/agent/list"><?php echo __('代理店一覧'); ?></a></li>
            <li class=""><a href="/agent/add"><?php echo __('代理店新規登録'); ?></a></li>
            <li class="divider"></li>
            <li class=""><a href="/client/list"><?php echo __('クライアント一覧'); ?></a></li>
            <li class=""><a href="/client/add"><?php echo __('クライアント新規登録'); ?></a></li>
            <li class="divider"></li>
            <li class=""><a href="/manager/list"><?php echo __('マスター一覧'); ?></a></li>
            <li class=""><a href="/manager/add"><?php echo __('マスター新規登録'); ?></a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-mobile"></i>&nbsp;<?php echo __('アプリ審査'); ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class=""><a href="/inspect/list"><?php echo __('審査申請アプリ一覧'); ?></a></li>
            <li class="divider"></li>
            <li class=""><a href="/support/reject/list"><?php echo __('リジェクト選択項目一覧'); ?></a></li>
            <li class=""><a href="/support/reject/add"><?php echo __('リジェクト選択項目登録'); ?></a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-pencil"></i>&nbsp;<?php echo __('販売管理'); ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class=""><a href="/bill/download"><?php echo __('発行IDダウンロード'); ?></a></li>
          </ul>
        </li>
<?php /*
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-phone"></i>&nbsp;<?php echo __('サポート'); ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class=""><a href="/support/info/list"><?php echo __('お知らせ一覧'); ?></a></li>
            <li class=""><a href="/support/info/add"><?php echo __('お知らせ新規登録'); ?></a></li>
            <li class="divider"></li>
            <li class=""><a href="/support/help/list"><?php echo __('ヘルプ一覧'); ?></a></li>
            <li class=""><a href="/support/help/add"><?php echo __('ヘルプ新規登録'); ?></a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-phone"></i>&nbsp;<?php echo __('代理店サポート'); ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class=""><a href="/support/agent/info/list"><?php echo __('お知らせ一覧'); ?></a></li>
            <li class=""><a href="/support/agent/info/add"><?php echo __('お知らせ新規登録'); ?></a></li>
            <li class="divider"></li>
            <li class=""><a href="/support/agent/help/list"><?php echo __('ヘルプ一覧(カテゴリ・ヘルプ内容)'); ?></a></li>
            <li class=""><a href="/support/agent/help/add"><?php echo __('ヘルプ新規登録'); ?></a></li>
            <li class="divider"></li>
            <li class=""><a href="/support/agent/faq/list"><?php echo __('よくある質問一覧'); ?></a></li>
            <li class=""><a href="/support/agent/faq/add"><?php echo __('よくある質問新規登録'); ?></a></li>
          </ul>
        </li>
*/ ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-bar-chart"></i>&nbsp;<?php echo __('統計表示'); ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class=""><a href="/statistics/app"><?php echo __('アプリ公開数'); ?></a></li>
            <li class=""><a href="/statistics/download"><?php echo __('ダウンロード数'); ?></a></li>
            <li class=""><a href="/statistics/pref"><?php echo __('都道府県ごと'); ?></a></li>
          </ul>
        </li>

      </ul>
      <!-- ▲ Dropdown Menu -->

      <!-- Navigation Right -->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/auth/logout"><i class="fa fa-sign-out"></i>&nbsp;<?php echo __('ログアウト'); ?></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</div>
<!-- ▲ Header -->

<!-- ▼ Container -->
<div class="container">
<?php echo $this->fetch('content'); ?>
</div>
<!-- ▲ Container -->

<!-- ▼ Footer -->
<div class="footer" role="footer">
  <div class="container">
      <ul class="footer-links">
      <li>Copyright © <?php echo date('Y');?> HIROPRO, Inc. All Rights Reserved</li>
    </ul>
  </div>
</div>
<!-- ▲ Footer -->

</body>
</html>
