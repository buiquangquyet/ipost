<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		// テンプレート読み込み
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-theme.min');
		echo $this->Html->css('item');
		echo $this->Html->css('body');
		echo $this->Html->css('form');
		echo $this->Html->css('responsive');
		echo $this->Html->css('sub');
		echo $this->Html->css('system');
		echo $this->Html->css('jquery-ui.min');
		echo $this->Html->css('jquery-ui.theme.min');

		// jQueryのCDNから読み込み
		echo $this->Html->script('//code.jquery.com/jquery-1.11.0.min.js');
		echo $this->Html->script('jquery-ui.min');
		if($lang == 'vie' || $lang == 'vi') {
			echo $this->Html->script('jquery.ui.datepicker-vi.min');
		} elseif($lang == 'eng' || $lang == 'en') {
			echo $this->Html->script('jquery.ui.datepicker-en.min');
		} else {
			echo $this->Html->script('jquery.ui.datepicker-ja.min');
		}
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js');
		echo $this->Html->script('https://www.gstatic.com/swiffy/v6.0/runtime.js');
		echo $this->Html->script('form');
		echo $this->Html->script('module');
		echo $this->Html->script('jquery.validate');

        // プログラム内からの内容の読み込み
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
		<script>
			function inspect_commit() {
				if(window.confirm('<?php echo __('アプリ制作を申請します。よろしいですか？'); ?>')){
					url = '<?php echo Router::url(array('controller' => 'inspect', 'action' => 'commit')); ?>';
					window.location.href = url;
				}
			}
		</script>

</head>
<body>

	<!-- ▼ ヘッダー -->
	<div id="head_navi">

		<div class="gridContainer clearfix">
			<div id="navi">
				<div id="logo_box_l">
					<div class="manual_sp">
						<div class="fl">
							<?php echo $this->Html->link('<i class="fa fa-info logout_c"></i>', array('controller' => 'support', 'action' => 'manual'), array('class' => 'fa-logout logout_bg maru manual_btn', 'escape' => false)); ?>
							<div class="head_navi_txt01 sm_non"><?php echo __('マニュアル'); ?></div>
						</div>
					</div>
				</div>

				<div id="logo_box"><?php echo $this->Html->link(false, '/', array('id' => 'logo')); ?></div>

				<div id="logo_box_r">

					<div class="f_right">
						<?php echo $this->Html->link('<i class="fa fa-sign-out logout_c"></i>', array('controller' => 'auth', 'action' => 'logout'), array('class' => 'fa-logout logout_bg maru', 'escape' => false)); ?>
						<div class="head_navi_txt01 sm_non"><?php echo __('ログアウト'); ?></div>
					</div>

					<div class="manual_pc">
						<div class="f_right">
							<?php echo $this->Html->link('<i class="fa fa-info logout_c"></i>', array('controller' => 'support', 'action' => 'manual'), array('class' => 'fa-logout logout_bg maru manual_btn', 'escape' => false)); ?>
							<div class="head_navi_txt01 sm_non"><?php echo __('マニュアル'); ?></div>
						</div>
					</div>

				</div>

			</div>
			<div class="arrow_top"></div>
		</div>
	</div>

	<div class="c30"></div>
	<!-- ▲ -->

	<!-- ▼ Container -->
	<div class="gridContainer clearfix">
		<div id="l_box">

			<!-- ▼ Infomation ボックス -->
			<?php if($this->name != 'Inspect'){ ?>

<!--
			<div class="arrow_box_top sm_non">
				<h2><i class="fa fa-smile-o"></i>&nbsp;<?php echo __('お疲れ様でした！'); ?></h2>
				<div class="sinsei_txt">
					<?php echo __('アプリの準備が整いました！！<br>審査申請ボタンを押してください。なお、申請中は管理画面のすべての機能が一時的にご利用できなくなります。申請が完了するまで今しばらくお待ちください。'); ?>

				</div>

				<a href="/inspect" class="btn btn-warning btn-rounded" onclick="inspect_commit();return false;"><?php echo __('確認する'); ?></a>
				<div class="arrow2"></div>
			</div>
-->

			<div class="arrow_box_top sm_non">
				<h2><i class="fa fa-smile-o"></i>&nbsp;<?php echo __('アプリ申請'); ?></h2>
				<div class="sinsei_txt">
					<?php echo __('トップ、メニュー、店舗情報など、必要な情報の入力が完了したら、アプリの仮申請をしましょう'); ?>
				</div>

				<a href="/inspect" class="btn btn-warning btn-rounded" onclick="inspect_commit();return false;"><?php echo __('仮申請'); ?></a>
				<div class="arrow2"></div>
			</div>

			<div id="smart_phone_box">
				<!-- モーダルウィンドウ本体 -->
				<iframe src="<?php echo $this->Html->url(array('controller' => $this->name . 'Preview', 'action' => $this->action, '?' => array('user_id' => AuthComponent::user('id'))));?>" id="preview" name="preview" width="304" height="630" style="border-style:none;">
					<?php echo __('この部分はインラインフレームを使用しています。'); ?>

				</iframe>
			</div>



			<?php } else { ?>

			<?php } ?>

			<div class="c"></div>

			<div class="arrow_box sm_non">

				<div class="uniqlo-font analytics-count">000</div>

				<div class="panel-footer no-padding no-border box_kage">
					<div class="row no-margin">
						<div class="col-xs-4 pd-md text-center color-analytics uniqlo-font"><span class="fa fa-apple mg-b-xs show i_s"></span>001</div>
						<div class="col-xs-4 pd-md text-center color-analytics uniqlo-font"><span class="fa fa-android mg-b-xs show i_s"></span>000</div>
						<div class="col-xs-4 pd-md text-center color-analytics uniqlo-font"><span class="fa fa-plus mg-b-xs show i_s"></span>001</div>
					</div>
				</div>
			</div>



		</div>

		<!-- ▼ Main Box -->
		<div id="main_box">
			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'block', 'action' => 'index'), array('class' => 'fa-04 bg-success center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link(__('トップ'), array('controller' => 'block', 'action' => 'index')); ?>
					</div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'news', 'action' => 'index'), array('class' => 'fa-03 bg-info center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link(__('ニュース'), array('controller' => 'news', 'action' => 'index')); ?>
					</div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'menu', 'action' => 'index'), array('class' => 'fa-02 bg-warning center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link(__('メニュー'), array('controller' => 'menu', 'action' => 'index')); ?>
					</div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'coupon', 'action' => 'index'), array('class' => 'fa-01 bg-danger center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link(__('クーポン'), array('controller' => 'menu', 'action' => 'index')); ?>
					</div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'splash', 'action' => 'index'), array('class' => 'fa-10 bg-info center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link(__('スプラッシュ'), array('controller' => 'splash', 'action' => 'index')); ?>
					</div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'header', 'action' => 'index'), array('class' => 'fa-21 bg-purple center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link(__('ヘッダー'), array('controller' => 'header', 'action' => 'index')); ?>
					</div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'background', 'action' => 'index'), array('class' => 'fa-22 bg-blue center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link(__('背景'), array('controller' => 'background', 'action' => 'index')); ?>
					</div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'footer', 'action' => 'index'), array('class' => 'fa-23 bg-green center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link(__('フッター'), array('controller' => 'footer', 'action' => 'index')); ?>
					</div>
				</section>
			</div>

			<?php if(IPOST_HK_VERSION_FLG == '0'){ ?>
			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'sidemenu', 'action' => 'index'), array('class' => 'fa-23 bg-green center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link(__('サイドメニュー'), array('controller' => 'sidemenu', 'action' => 'index')); ?>
					</div>
				</section>
			</div>
			<?php } ?>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'shop', 'action' => 'profile'), array('class' => 'fa-05 bg-blue center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link(__('店舗情報'), array('controller' => 'shop', 'action' => 'profile')); ?>
					</div>
				</section>
			</div>

			<?php if(IPOST_HK_VERSION_FLG == '0'){ ?>
			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'html', 'action' => 'index'), array('class' => 'fa-03 bg-danger center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link(__('HTML'), array('controller' => 'html', 'action' => 'index')); ?>
					</div>
				</section>
			</div>
			<?php } ?>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'reserve', 'action' => 'index'), array('class' => 'fa-14 bg-warning center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link(__('予約カレンダー'), array('controller' => 'reserve', 'action' => 'index')); ?>
					</div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'apply', 'action' => 'index'), array('class' => 'fa-10 bg-green center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link(__('ストア情報'), array('controller' => 'apply', 'action' => 'index')); ?>
					</div>
				</section>
			</div>

			<div class="c"></div>

			<?php echo $this->fetch('content'); ?>

		</div>
		<!-- ▲ End : Main Box -->
	</div>
	<!-- ▲ End : Container -->
	<footer>
	  <div class="copy_box">Copyright c <?php echo date('Y');?> HIROPRO, Inc. All Rights Reserved</div>
	  <?php echo $this->element('sql_dump'); ?>
	</footer>
</body>
</html>