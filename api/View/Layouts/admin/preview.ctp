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

		// jQueryのCDNから読み込み
		echo $this->Html->script('//code.jquery.com/jquery-1.11.0.min.js');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js');
		echo $this->Html->script('https://www.gstatic.com/swiffy/v6.0/runtime.js');
		echo $this->Html->script('form');
		echo $this->Html->script('module');

        // プログラム内からの内容の読み込み
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
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
							<div class="head_navi_txt01 sm_non">マニュアル</div>
						</div>
					</div>
				</div>

				<div id="logo_box"><?php echo $this->Html->link(false, '/', array('id' => 'logo')); ?></div>
 
				<div id="logo_box_r">

					<div class="f_right">
						<?php echo $this->Html->link('<i class="fa fa-sign-out logout_c"></i>', array('controller' => 'AdminLogin', 'action' => 'logout'), array('class' => 'fa-logout logout_bg maru', 'escape' => false)); ?>
						<div class="head_navi_txt01 sm_non">ログアウト</div>
					</div>

					<div class="manual_pc">
						<div class="f_right">
							<?php echo $this->Html->link('<i class="fa fa-info logout_c"></i>', array('controller' => 'support', 'action' => 'manual'), array('class' => 'fa-logout logout_bg maru manual_btn', 'escape' => false)); ?>
							<div class="head_navi_txt01 sm_non">マニュアル</div>
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
			<div class="arrow_box_top sm_non">
				<h2><i class="fa fa-smile-o"></i>&nbsp;お疲れ様でした！</h2>
				<div class="sinsei_txt">
					<!-- 仮 -->
					<!-- アプリの準備が整いました！！<br>サポートへご連絡してください。<br>サポートの方が、アプリの申請までの手順をお手伝い致します。 -->
					<!-- <a href="mailto:support3@hiropro.co.jp?subject=%e3%82%a2%e3%83%97%e3%83%aa%e7%94%b3%e8%ab%8b%e3%81%ae%e7%94%b3%e3%81%97%e8%be%bc%e3%81%bf" class="btn btn-warning btn-rounded">メールを送る</a> -->
					<!-- // 実装した時用 -->
					アプリの準備が整いました！！<br>審査申請ボタンを押してください。
					なお、申請中は管理画面のすべての機能が一時的にご利用できなくなります。
					申請が完了するまで今しばらくお待ちください。
				</div>

				<a href="/inspect" class="btn btn-warning btn-rounded">確認する</a>
				<div class="arrow2"></div>
			</div>
			<!-- ▲ -->

			<div id="smart_phone_box">
				<!-- モーダルウィンドウ本体 -->
				<iframe src="" id="preview" name="preview" width="304" height="630" style="border-style:none;">
					この部分はインラインフレームを使用しています。
				</iframe>
			</div>

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
						<?php echo $this->Html->link('トップ', array('controller' => 'block', 'action' => 'index')); ?>
					</div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'block', 'action' => 'expart'), array('class' => 'fa-04 bg-success center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link('トップ', array('controller' => 'block', 'action' => 'expart')); ?>
					</div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<a href="/news" class="fa-03 bg-info center maru"></a>
					<div class="menu_txt center"><a href="#" >ニュース</a></div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<a href="/menu" class="fa-02 bg-warning center maru"></a>
					<div class="menu_txt center"><a href="#" >メニュー</a></div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<a href="/coupon" class="fa-01 bg-danger center maru"></a>
					<div class="menu_txt center"><a href="#" >クーポン</a></div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<a href="/splash" class="fa-10 bg-info center maru"></a>
					<div class="menu_txt center"><a href="/splash" >スプラッシュ</a></div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<a href="/theme/header" class="fa-21 bg-purple center maru"></a>
					<div class="menu_txt center"><a href="/theme/header" >ヘッダー</a></div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<a href="/theme/background" class="fa-22 bg-blue center maru"></a>
					<div class="menu_txt center"><a href="/theme/background" >背景</a></div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<a href="/theme/footer" class="fa-23 bg-green center maru"></a>
					<div class="menu_txt center"><a href="/theme/footer" >フッター</a></div>
				</section>
			</div>


			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<?php echo $this->Html->link(false, array('controller' => 'shop', 'action' => 'index'), array('class' => 'fa-05 bg-blue center maru')); ?>
					<div class="menu_txt center">
						<?php echo $this->Html->link('店舗情報', array('controller' => 'shop', 'action' => 'index')); ?>
					</div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<a href="/shop/profile/multi" class="fa-05 bg-blue center maru"></a>
					<div class="menu_txt center"><a href="/shop/profile/multi" >多店舗情報</a></div>
				</section>
			</div>


			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<a href="/store" class="fa-10 bg-info center maru"></a>
					<div class="menu_txt center"><a href="/theme/footer" >ストア情報</a></div>
				</section>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<section class="panel2 center navi_c">
					<a href="/web" class="fa-03 bg-danger center maru"></a>
					<div class="menu_txt center"><a href="/web" >HTML</a></div>
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
	</footer>
</body>
</html>
