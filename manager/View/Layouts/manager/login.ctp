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
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('form');

echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>
</head>

<body class="pt_100">
<!-- ▼ Header -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/"><?php echo __('マスター管理画面'); ?><small>&nbsp;|&nbsp;<?php echo __('エンタープライズ'); ?></small></a>
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
