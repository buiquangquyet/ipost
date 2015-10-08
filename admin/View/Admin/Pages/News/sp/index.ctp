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
<link href="http://mc.i-post.jp/anami/ipost_appli_phone/images/logo.png" rel="shortcut icon" type="image/png" />

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

<!-- パンくずリスト -->
<div id="topicpath">
    <div id="head_2">
        <div class="f_right">
		<?php echo $this->Html->link('<i class="fa fa-sign-out logout_c"><p class="logout">'.__('ログアウト').'</p></i>', array('controller' => 'auth', 'action' => 'logout'), array('class' => 'fa-logout logout_bg maru', 'escape' => false)); ?>
		<div class="head_navi_txt01 sm_non"></div>
	</div>
        <?php echo $this->Html->link('<i class="fa fa-sign-out logout_c"></i>', array('controller' => 'auth', 'action' => 'logout'), array('class' => 'fa-logout logout_bg maru', 'escape' => false)); ?>


    </div><!-- (/head_2) -->
    <br class="clear">
</div>


<div class="clear"></div>

<div class="sechead_news">
    <h2 class="sechead_h2_detail"><span>NEWS</span></h2>
</div>

<div class="main">


<!-- ニュースを配信する -->
<div class="message_box km">
    <div class="edit_title_news">
        <h2><a name="news_new"><?php echo __('ニュースの新規登録'); ?></a></h2>
    </div>
    <hr class="green_line">
    <!--
    <p class="edit_p">最低１つのニュースは配信準備が必要になっております。<br>
	PUSH通知機能は、アプリが公開状態になりましたらご利用できます。<br>
    <span class="red">※簡易申請時に必須の項目です。</span></p>
	-->

<?php echo $this->Form->create(false, array('type' => 'file', 'action' => 'regist', 'novalidate' => true, 'id' => 'new', 'name' => 'new_form')); ?>

    <div class="news_box">
      <p class="news_title fw_b"><?php echo __('タイトル'); ?><span class="red">【必須】</span></p>
      <input type="text" required id="form_title" class="km" name="title" value="" />
      <p class="setsu">文字数：全角20文字以内を推奨</p>
    </div>


    <div class="news_box">
      <p class="news_title fw_b"><?php echo __('本文'); ?><span class="red">【必須】</span></p>
      <textarea type="text" required id="form_body" class="km" name="body" value="" /></textarea>
    </div>


    <p class="photo_edit_p"><span class="fw_b"><?php echo __('画像の選択'); ?></span></p>
<!--
    <div class="top_image_box">
        <?php echo $this->Html->image("/img/common/noimage/noimage_menu_news.png", array('class' => 'top_image km', 'id' => 'ImageViewer_new')); ?>
    </div>
-->

    <?php echo $this->Form->file("image", array('class' => 'wau pt_10 ImageSelect', 'label' => false, 'pos' => 'new')); ?>
    <p class="small_p"><?php echo __('ファイルサイズ：3MBまで'); ?><br>
    <?php echo __('横幅&nbsp;640px&nbsp;以上の大きさを推奨'); ?><br>
    <?php echo __('高さの指定はありません。'); ?></p>


    <div class="news_box">
      <p class="news_title fw_b"><?php echo __('PUSH通知'); ?></p>
      <p class="desc"><?php echo __('ニュースを配信した時に、お客様に通知するかどうかを選べます。'); ?></p>
      <label class="form_notice_1"><input type="radio" required id="form_notice_1" name="notice" value="1" checked="checked" /><?php echo __('する'); ?></label>
      <label class="form_notice_0"><input type="radio" required id="form_notice_0" name="notice" value="0" /><?php echo __('しない'); ?></label>
	</div>

    <!-- (/edit_box) -->

	<div class="edit_box" onclick="document.new_form.submit();return false;"><a href="" class="edit_btn mo"><?php echo __('配信'); ?></a></div>

<?php echo $this->Form->end(); ?>

</div><!--(/message_box)-->

</div><!-- （/main） -->

<?php echo $this->Html->scriptStart(array('inline' => false)) ?>

  $(document).ready(function(){
    // DatePickerの初期化
    $(".calendar").datepicker({dateFormat:'yy-mm-dd'});
  });

  function toggleLinkTypeForm(targetForm, id) {

    formName = ['0', '1', '3']; //0 なし 1 画像 3 YOUTUBE

    for(i=0; i< formName.length; i++) {
      if (targetForm == 0) {

        $('#image_ext_1_' + id).hide();
        $('#image_ext_3_' + id).hide();

      } else if (targetForm == formName[i]) {

        $('#image_ext_' + formName[i] + '_' + id).show();

      } else {

        $('#image_ext_' + formName[i] + '_' + id).hide();

      }
    }
  }

  function postData(id) {
    $('#' + id).submit();
  }

  function toggleForm(target, id) {
    $('#' + target + '_result_' + id).toggle();
    $('#' + target + '_form_' + id).toggle();
  }


$(function () {
  $('.ImageSelect').on('change', function() {
    if (! this.files.length) {
      return;
    }

    var file = this.files[0];
    if (! file.type.match('image.*')) {
      alert('<?php echo __('画像を選択してください'); ?>');
      return;
    }

    if (! file.size > (3 * 1024 * 1024)) {
      alert('<?php echo __('サイズが大きすぎます'); ?>');
      return;
    }

    pos = $(this).attr('pos');
    var reader = new FileReader();
    reader.onload = (function(theFile) {
      return function(e) {
        $('#ImageViewer_' + pos).each(function() {
          $(this).attr('src', e.target.result);
        });
      };
    })(file);

    reader.readAsDataURL(file);
  });
});
<?php echo $this->Html->scriptEnd(); ?>

<div id="foot">
<div id="foot_bottom">
<p>Copyright © 2015 HIROPRO, Inc. All Rights Reserved.</p>
</div><!-- (/foot_bottom) -->
</div><!-- (/foot) -->

</body>
</html>