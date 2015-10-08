<div class="frame_main_box" id="backgroundInfo">
	<header class="panel-heading panel-title"><?php echo __('背景画像の設定'); ?></header>
	<div class="form_top"></div>

	<!-- ▼表示部分 -->
	<div ng-controller='backgroundController'>
		<div id='disp_background_image'>
			<div class="form-group center_box">
				<label class="form-label no-hand i_p_150">
					<img ng-src="{{backgroundInfo.background.image}}" alt="<?php echo __('背景画像'); ?>" class="avatar avatar-sm2 img-block" />
				</label>

				<div class="button_box">
					<button class="btn btn-warning btn-sm mt_10" onClick="toggleForm('background_image')"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></button>
					<?php echo $this->Html->link(__('<i class="fa fa-trash-o mg-l-xs"></i>削除'), array('action' => 'deleteImage'), array('escape' => false, 'class' => 'btn btn-sm btn-danger mt_10')); ?>
				</div>
			</div>
			<div class="c10"></div>
		</div>
		<!-- ▲ -->

		<!-- ▼ 入力フォーム -->
		<div id="form_background_image" style="display:none;">
			<div class="form-group">
				<label id='' class="form-label no-hand ml_70">
					<img ng-src="{{backgroundInfo.background.image}}" alt="<?php echo __('背景画像'); ?>" class="avatar avatar-sm2 img-block ImageViewer">
				</label>
				<div class="form_hr"></div>
			</div>

			<?php echo $this->Form->create(false, array('type' => 'file', 'id' => 'registBackgroundImage', 'url' => array('controller' => 'ajax', 'action' => 'regist'), 'novalidate' => true)); ?>
				<div class="form-group">
					<label for="upload" class="form-label"><?php echo __('画像の選択'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
					<?php echo $this->Form->file('BackgroundImage.image', array('id' => 'ImageSelector', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'wau pt_10'));?>
					<?php echo $this->Form->input("BackgroundImage.imageType", array('type' => 'hidden', 'value' => 'fullsize')); ?>
					<p ng-show="imageValidateInfo.errorInfo" class="form-help fml_184">{{validate.message.name.0}}</p>
					<p class="form-help"><?php echo __('アプリケーションは、白文字を使用しているため、<br>白色の多い画像は非推奨となっております。<br>ファイルサイズ：3MBまで<br>640px&nbsp;×&nbsp;1136px&nbsp;以上の大きさを推奨'); ?></p>
				</div>
				<div class="form_hr"></div>
				<hr />
			<?php echo $this->Form->end(); ?>
			<?php echo $this->Form->create(false, array('type' => 'post', 'id' => 'deleteImage', 'url' => array('controller' => 'ApiBackGround', 'action' => 'background_image_delete'), 'novalidate' => true)); ?>
			<?php echo $this->Form->end(); ?>

			<div class="btn_center">
				<span id='imgfilename'></span>
				<button type="button" class="btn btn-default btn-sm" onClick="toggleForm('background_image')"><i class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る')?></button>
				<button type="button" class="btn btn-warning btn-sm" ng-click="registBackgroundImage('#registBackgroundImage');"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録')?></button>
			</div>
		</div>
		<!-- ▲ -->

		<!-- ▼ ヘッダの色情報変更 -->
		<div class="frame_main_box box_kage">
			<header class="panel-heading panel-title"><?php echo __('背景色の設定'); ?></header>
			<div class="form_top"></div>

			<div class="form-group">
				<label class="form-label"><?php echo __('背景色選択'); ?></label>
				<div class="color_change_box {{backgroundInfo.background.color}}"></div>
				<div class="form_hr"></div>

				 <div class="color_choose mt_20">
				 	<p class="ml_80 f_d"><?php echo __('背景単色'); ?></p>
				 	<ul>
						<li ng-repeat="c_color in colorInfo.c" id="{{c_color}}" class="{{c_color}}" ng-click="colorChange($event);"></li>
				 	</ul>
				 </div>
				 <br />
				 <div class="color_choose">
				 	<p class="ml_80 f_d"><?php echo __('背景グラデーション'); ?></p>
				 	<ul>
						<li ng-repeat="g_color in colorInfo.g" id="{{g_color}}" class="{{g_color}}" ng-click="colorChange($event);"></li>
				 	</ul>
				 </div>

				 <div class="button_box">
				 	<?php echo $this->Form->create(false, array('type' => 'post', 'id' => 'registBackgroundColor', 'url' => array('controller' => 'ajax', 'action' => 'regist'), 'novalidate' => true)); ?>
				 		<?php echo $this->Form->hidden('BackgroundColor.color', array('value' => '{{backgroundInfo.background.color}}')) ?>
					<?php echo $this->Form->end(); ?>
					<button type="button" class="btn btn-warning btn-sm" ng-click="registBackgroundColor('#registBackgroundColor');"><i class="fa fa-plus mg-r-xs"></i><?php echo __('背景色の変更')?></button>
				 </div>
			</div>
		</div>
	</div>
</div>

<!-- ▲ -->
<?php echo $this->Html->scriptStart(array('inline' => false)) ?>
$(function () {
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
			};
		})(file);

		reader.readAsDataURL(file);
	});
});
$(document).ready(function(){
	moduleBase.controller('backgroundController', ['$scope', '$http', 'AjaxUrlAccess', function($scope, $http, AjaxUrlAccess) {

		$scope.colorInfo  = <?php echo json_encode(Configure::read('ColorInfo')); ?>;

		// 空画像設定
		$scope.backgroundInfo = <?php echo $backgroundInfo; ?>;
		if ($scope.backgroundInfo.background.image == '') {
			$scope.backgroundInfo.background.image = "<?php echo SYSTEM_PATH; ?>img/common/noimage/noimage_menutop.png";
		} else {
			$scope.backgroundInfo.background.image = "<?php echo SYSTEM_PATH; ?>media/" + $scope.backgroundInfo.background.image + "/";
		}

		$scope.registBackgroundImage = function(id) {
			if (window.confirm('<?php echo __('背景画像を登録します。よろしいですか'); ?>')) {
				resultObject = AjaxUrlAccess.postData(id, 'location.reload();');
				$scope.validate = resultObject.error;
			}
		}

		$scope.registBackgroundColor = function(id) {
			if (window.confirm('<?php echo __('背景色を登録します。よろしいですか'); ?>')) {
				resultObject = AjaxUrlAccess.postData(id, 'location.reload();');
				$scope.validate = resultObject.error;
			}
		}

		// 背景色切替
		$scope.colorChange = function($event) {
			target = $event.target;
			$(target).parent().parent().parent().find('li').each(function() {
				$(this).attr('class', $(this).attr('id'));
			});

			$scope.backgroundInfo.background.color = $(target).attr('class');
			$(target).attr('class', $(target).attr('class') + ' color_selected');
		}
	}]);
	angular.bootstrap($('#backgroundInfo'), ['moduleBase']);
});
<?php echo $this->Html->scriptEnd(); ?>