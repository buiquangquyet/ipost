<div class="frame_main_box" id="headerInfo">

<?php if(IPOST_HK_VERSION_FLG == '0'){ ?>
	<header class="panel-heading panel-title"><?php echo __('ヘッダー画像の設定'); ?></header>
	<div class="form_top"></div>
<?php } ?>

	<!-- ▼表示部分 -->
	<div ng-controller='headerController'>

	<?php if(IPOST_HK_VERSION_FLG == '0'){ ?>
		<div id='disp_header_image'>
			<div class="form-group center_box">
				<label class="form-label no-hand i_p_150">
					<img ng-src="{{headerInfo.header.image}}" alt="<?php echo __('ヘッダー画像'); ?>" class="avatar avatar-sm2 img-block" />
				</label>

				<div class="button_box">
					<button class="btn btn-warning btn-sm mt_10" onClick="toggleForm('header_image')"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></button>
				</div>
			</div>
			<div class="c10"></div>
		</div>
		<!-- ▲ -->

		<!-- ▼ 入力フォーム -->
		<div id="form_header_image" style="display:none;">
			<div class="form-group">
				<label id='' class="form-label no-hand ml_70">
					<img ng-src="{{headerInfo.header.image}}" alt="<?php echo __('ヘッダー画像'); ?>" class="avatar avatar-sm2 img-block ImageViewer">
				</label>
				<div class="form_hr"></div>
			</div>

			<?php echo $this->Form->create(false, array('type' => 'file', 'id' => 'registHeaderImage', 'url' => array('controller' => 'ajax', 'action' => 'regist'), 'novalidate' => true)); ?>
				<?php echo $this->Form->input("HeaderImage.imageType", array('type' => 'hidden', 'value' => 'header')); ?>
				<div class="form-group">
					<label for="upload" class="form-label"><?php echo __('画像の選択'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
					<?php echo $this->Form->file('HeaderImage.image', array('id' => 'ImageSelector', 'div' => false, 'label' => false, 'error' => false, 'class' => 'wau pt_10')); ?>
					<p ng-show="validate.message.name" class="form-help" style="color: red"><?php echo __('画像が選択されていません')?><!--<p ng-show="validate.message.name" class="form-help fml_184" style="color: red"> {{validate.message.name.0}} --></p>
					<p class="form-help"><?php echo __('ファイルサイズ：3MBまで<br>400px&nbsp;×&nbsp;88px&nbsp;以上の大きさを推奨<br>透過png対応しています。'); ?></p>
				</div>
				<div class="form_hr"></div>
				<hr />
			<?php echo $this->Form->end(); ?>
			<?php echo $this->Form->create(false, array('type' => 'post', 'id' => 'deleteImage', 'url' => array('controller' => 'ApiHeader', 'action' => 'header_image_delete'), 'novalidate' => true)); ?>
			<?php echo $this->Form->end(); ?>

			<div class="btn_center">
				<span id='imgfilename'></span>
				<button type="button" class="btn btn-default btn-sm" onClick="toggleForm('header_image')"><i class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る'); ?></button>
				<button type="button" class="btn btn-warning btn-sm" ng-click="registHeaderImage('#registHeaderImage');"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></button>
			</div>
		</div>
		<!-- ▲ -->
	<?php } ?>

		<!-- ▼ ヘッダの色情報変更 -->
		<div class="frame_main_box box_kage">
			<div class="c"></div>

			<header class="panel-heading panel-title"><?php echo __('ヘッダー背景色の設定'); ?></header>
			<div class="form_top"></div>

			<div class="form-group">
				<label class="form-label"><?php echo __('背景色選択'); ?></label>
				<div class="color_change_box {{headerInfo.header.color}}"></div>
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
				 	<?php echo $this->Form->create(false, array('type' => 'post', 'id' => 'registHeaderColor', 'url' => array('controller' => 'ajax', 'action' => 'regist'), 'novalidate' => true)); ?>
				 		<?php echo $this->Form->hidden('HeaderColor.color' ,array('value' => '{{headerInfo.header.color}}')); ?>
					<?php echo $this->Form->end(); ?>
					<button type="button" class="btn btn-warning btn-sm" ng-click="registHeaderColor('#registHeaderColor');"><i class="fa fa-plus mg-r-xs"></i><?php echo __('背景色の変更'); ?></button>
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
			alert('<?php echo __('画像を選択してください。'); ?>');
			return;
		}

		if (! file.size > (3 * 1024 * 1024)) {
			alert('<?php echo __('サイズが大きすぎます。'); ?>');
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
	moduleBase.controller('headerController', ['$scope', '$http', 'AjaxUrlAccess', function($scope, $http, AjaxUrlAccess) {

		$scope.colorInfo  = <?php echo json_encode(Configure::read('ColorInfo')); ?>;

		// 空画像設定
		$scope.headerInfo = <?php echo $headerInfo; ?>;
		if ($scope.headerInfo.header.image == '') {
			$scope.headerInfo.header.image = "<?php echo SYSTEM_PATH; ?>img/common/noimage/noimage_menutop.png";
		} else {
			$scope.headerInfo.header.image = "<?php echo SYSTEM_PATH; ?>media/" + $scope.headerInfo.header.image + "/";
		}

		$scope.registHeaderImage = function(id) {
			if (window.confirm('<?php echo __('ヘッダー画像を登録します。よろしいですか'); ?>')) {
				resultObject = AjaxUrlAccess.postData(id, 'location.reload();');
				$scope.validate = resultObject.error;

			}
		}

		$scope.registHeaderColor = function(id) {
			if (window.confirm('<?php echo __('ヘッダー背景色を登録します。よろしいですか'); ?>')) {
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

			$scope.headerInfo.header.color = $(target).attr('class');
			$(target).attr('class', $(target).attr('class') + ' color_selected');
		}
	}]);
	angular.bootstrap($('#headerInfo'), ['moduleBase']);
});
<?php echo $this->Html->scriptEnd(); ?>
