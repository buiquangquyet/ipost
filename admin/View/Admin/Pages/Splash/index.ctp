<div class="frame_main_box" id="splashInfo">

	<header class="panel-heading panel-title"><?php echo __('アプリ起動時画像の設定'); ?></header>
	<div class="form_top"></div>

	<!-- ▼表示部分 -->
	<div ng-controller='splashController'>
		<div id='disp_splash_image'>
			<div class="form-group center_box">
				<label class="form-label no-hand i_p_150">
					<img ng-src="{{splashInfo.splash.image}}" alt="<?php echo __('スプラッシュ画像'); ?>" class="avatar avatar-sm2 img-block" />
				</label>

				<div class="button_box">
					<button class="btn btn-warning btn-sm mt_10" onClick="toggleForm('splash_image')"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></button>
				</div>
			</div>
			<div class="c10"></div>
		</div>
		<!-- ▲ -->

		<!-- ▼ 入力フォーム -->
		<div id="form_splash_image" style="display:none;">
			<div class="form-group">
				<label id='' class="form-label no-hand ml_70">
					<img ng-src="{{splashInfo.splash.image}}" alt="<?php echo __('スプラッシュ画像'); ?>" class="avatar avatar-sm2 path-img-block-imglist wau ImageViewer">
				</label>
				<div class="form_hr"></div>
			</div>

			<?php echo $this->Form->create(false, array('type' => 'file', 'id' => 'registSplashImage', 'url' => array('controller' => 'ajax', 'action' => 'regist'), 'novalidate' => true)); ?>
				<div class="form-group">
					<label for="upload" class="form-label"><?php echo __('画像の選択'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
					<?php echo $this->Form->file('SplashImage.image', array('id' => 'ImageSelector', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'wau pt_10'));?>
					<?php echo $this->Form->input("SplashImage.imageType", array('type' => 'hidden', 'value' => 'fullsize')); ?>
					<p ng-show="imageValidateInfo.errorInfo" class="form-help fml_184">{{imageValidateInfo.errorInfo}}</p>
					<p class="form-help"><?php echo __('ファイルサイズ：3MBまで<br>640×1136pxの大きさを推奨'); ?></p>
				</div>
				<div class="form_hr"></div>
				<hr />
			<?php echo $this->Form->end(); ?>

			<div class="btn_center">
				<span id='imgfilename'></span>
				<button type="button" class="btn btn-default btn-sm" onClick="toggleForm('splash_image')"><i class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る'); ?></button>
				<button type="button" class="btn btn-warning btn-sm" ng-click="registSplashImage('#registSplashImage');"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></button>
			</div>
		</div>
		<!-- ▲ -->

		<header class="panel-heading panel-title"><?php echo __('アプリ起動時動画の設定'); ?></header>
		<div class="form_top"></div>
		<div id='disp_splash_movie'>
			<div class="form-group center_box">
				<label class="form-label no-hand i_p_150">
					<video ng-src="{{splashInfo.splash.movie}}" src="{{splashInfo.splash.movie}}" class="avatar avatar-sm2 path-img-block-imglist wau i_p_150" autoplay muted loop>
						<p><?php echo __('動画を再生するにはvideoタグをサポートしたブラウザが必要です。'); ?></p>
					</video>
				</label>

				<div class="button_box">
					<button class="btn btn-warning btn-sm mt_10" onClick="toggleForm('splash_movie')"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></button>
					<button type="button" class="btn btn-sm btn-danger mt_10" ng-click="deleteImage('#deleteImage');"><i class="fa fa-trash-o mg-l-xs"></i><?php echo __('削除'); ?></button>
				</div>
			</div>
			<div class="c10"></div>
		</div>
		<!-- ▲ -->

		<!-- ▼ 入力フォーム -->
		<div id="form_splash_movie" style="display:none;">
			<div class="form-group">
				<label id='' class="form-label no-hand ml_70">
					<video ng-src="{{splashInfo.splash.movie}}" class="avatar avatar-sm2 path-img-block-imglist wau i_p_150 MovieViewer" autoplay muted loop>
						<p><?php echo __('動画を再生するにはvideoタグをサポートしたブラウザが必要です。'); ?></p>
					</video>
				</label>
				<div class="form_hr"></div>
			</div>

			<?php echo $this->Form->create(false, array('type' => 'file', 'id' => 'registSplashMovie', 'url' => array('controller' => 'ajax', 'action' => 'regist'), 'novalidate' => true)); ?>
				<div class="form-group">
					<label for="upload" class="form-label"><?php echo __('画像の選択'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
					<?php echo $this->Form->file('SplashMovie.movie', array('id' => 'MovieSelector', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'wau pt_10'));?>
					<p ng-show="validate.message.name" class="form-help fml_184">{{validate.message.name.0}}</p>
					<p class="form-help"><?php echo __('ファイル形式：H.264&nbsp;/&nbsp;MPEG-4<br>解像度：640px x 1136px サイズを推奨<br>ファイルサイズ：1MBまで'); ?></p>
				</div>
				<div class="form_hr"></div>
				<hr />
			<?php echo $this->Form->end(); ?>
			<?php echo $this->Form->create(false, array('type' => 'post', 'id' => 'deleteImage', 'url' => array('controller' => 'ApiHeader', 'action' => 'header_image_delete'), 'novalidate' => true)); ?>
			<?php echo $this->Form->end(); ?>

			<div class="btn_center">
				<span id='imgfilename'></span>
				<button type="button" class="btn btn-default btn-sm" onClick="toggleForm('splash_movie')"><i class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る'); ?></button>
				<button type="button" class="btn btn-warning btn-sm" ng-click="registSplashMovie('#registSplashMovie');"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></button>
			</div>
		</div>
		<!-- ▲ -->
	</div>
</div>

<!-- ▲ -->
<?php echo $this->Html->scriptStart(array('inline' => false)) ?>
$(function() {
	$('#ImageSelector').on('change', function() {
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

		var reader = new FileReader();
		reader.onload = (function(theFile) {
			return function(e) {
				$('.ImageViewer').each(function() {
					$(this).attr('src', e.target.result);
				});
			}
		})(file);

		reader.readAsDataURL(file);
	});

	$('#MovieSelector').on('change', function() {
		if (! this.files.length) {
			return;
		}

		var file = this.files[0];
		if (! file.type.match('mp4')) {
			alert('<?php echo __('ファイル形式が異なっております'); ?>');
			return;
		}

		if (file.size > (1 * 1024 * 1024)) {
			alert('<?php echo __('サイズが大きすぎます'); ?>');
			return;
		}

		var reader = new FileReader();
		reader.onload = (function(theFile) {
			return function(e) {
				$('.MovieViewer').each(function() {
					$(this).attr('src', e.target.result);
				});
			}
		})(file);

		reader.readAsDataURL(file);
	});
});
$(document).ready(function() {
	moduleBase.controller('splashController', ['$scope', '$http', 'AjaxUrlAccess', function($scope, $http, AjaxUrlAccess) {

		$scope.splashInfo = <?php echo $splashInfo; ?>;
		if ($scope.splashInfo.splash.image == '') {
			$scope.splashInfo.splash.image = '<?php echo SYSTEM_PATH; ?>img/common/noimage/noimage_menutop.png';
		} else {
			$scope.splashInfo.splash.image = '<?php echo SYSTEM_PATH; ?>media/' + $scope.splashInfo.splash.image;
		}
		if ($scope.splashInfo.splash.movie == '') {
			$scope.splashInfo.splash.movie = '';
		} else {
			$scope.splashInfo.splash.movie = '<?php echo SYSTEM_PATH; ?>media/' + $scope.splashInfo.splash.movie;
		}

		$scope.registSplashImage = function(id) {
			if (window.confirm('<?php echo __('スプラッシュ画像を登録します。よろしいですか'); ?>')) {
				resultObject = AjaxUrlAccess.postData(id, 'location.reload();');
				$scope.validate = resultObject.error;
			}
		}

		$scope.registSplashMovie = function(id) {
			if (window.confirm('<?php echo __('スプラッシュ動画を登録します。よろしいですか'); ?>')) {
				resultObject = AjaxUrlAccess.postData(id, 'location.reload();');
				$scope.validate = resultObject.error;
			}
		}

	}]);
	angular.bootstrap($('#splashInfo'), ['moduleBase']);
});

<?php echo $this->Html->scriptEnd(); ?>