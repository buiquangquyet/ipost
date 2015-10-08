
<!doctype html>
<!--[if IE]><html class="ie"><![endif]-->
<!--[if !IE]><html class=""><![endif]-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="wclassth=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="x-ua-compatible" content="IE=9">
  <meta http-equiv="x-ua-compatible" content="IE=EmulateIE9">

  <title>iPost Preview</title>

  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="robots" content="" />

  <?php
    echo $this->Html->meta('icon');

    // テンプレート読み込み
    echo $this->Html->css('preview.reset');
    echo $this->Html->css('preview.jquery.sidr.dark.css');
    echo $this->Html->css('preview.font');
    echo $this->Html->css('preview.base');
    echo $this->Html->css('preview.store');

    // jQueryのCDNから読み込み
    echo $this->Html->script('//code.jquery.com/jquery-1.11.0.min.js');
    echo $this->Html->script('jquery.carouFredSel-6.2.1-packed');
    echo $this->Html->script('jquery.sidr.min');

    // プログラム内からの内容の読み込み
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
  ?>

  <style type="text/css">
  #navigation{
    display: none;
  }
  </style>




  <script type="text/javascript">
  $(function(){
    $('#menu-trigger').sidr({
      side: 'right',
      source: '#navigation',
    });
  });
  </script>

  <?php if ($backgroundInfo['background']['image'] != '') { ?>
  <style type="text/css">
  div.smartphone-wrap{
    background-image: url(<?php echo $this->Html->url(array('controller' => 'media', 'action' => "{$backgroundInfo['background']['image']}"));?>);
    background-size: 240px 426px;
    background-repeat: no-repeat;
  }
  </style>
  <?php } ?>


</head>
<body>

<?php echo $this->fetch('content'); ?>

</body>
</html>
