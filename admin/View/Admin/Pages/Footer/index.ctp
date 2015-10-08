<div class="frame_main_box" id="footerInfo">

	<header class="panel-heading panel-title"><?php echo __('フッターの設定'); ?></header>
	<div class="form_top"></div>

	<!-- ▼表示部分 -->
	<div ng-controller='footerController'>
		<div class="form-group">
			<?php echo $this->Form->create(false, array('type' => 'post', 'id' => 'footerPostForm', 'url' => array('controller' => 'ajax', 'action' => 'regist'), 'novalidate' => true)); ?>
			<ul>
				<li ng-repeat="footerDetail in footerInfo" class="sort_box clearfix mb_20">
					<span class="uniqlo-font foot_pic_number">{{$index + 1}}</span>
					<div class="select_custom">
						<?php echo $this->Form->input('Footer.{{$index}}.type', array('class' => 'select_custom', 'options' => Configure::read('FooterMenuTypeList'), 'div' => false, 'label' => false, 'ng-model' => 'footerDetail.type')); ?>
						<?php echo $this->Form->input('Footer.{{$index}}.icon', array('class' => 'font-icon-standart', 'options' => Configure::read('IconList'), 'div' => false, 'label' => false, 'ng-model' => 'footerDetail.icon', 'ng-hide' => 'footerDetail.type==""')); ?>
					</div>
				</li>
			</ul>
			<?php echo $this->Form->end(); ?>

			<div class="button_box">
				<button type="button" class="btn btn-warning btn-sm" ng-click="registFooterInfo('#footerPostForm')"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></button>
			</div>

		</div>
	</div>
	<!-- ▼ フッターアイコン一覧 -->
	<div id="frame_footer_icon_list" class="frame_main_box box_kage">
		<div class="c"></div>
		<header class="panel-heading panel-title"><?php echo __('フッターアイコン一覧'); ?></header>

		<div class="form-group clearfix">
			<?php foreach(Configure::read('DescriptionWithIconList') as $icon) { ?>
				<div class="col-sm-4"><span class="font-icon-standart"><?php echo $icon['icon']; ?></span>:&nbsp;<?php echo $icon['description']; ?></div>
			<?php } ?>
		</div>
	</div>
</div>

<!-- ▲ -->
<?php echo $this->Html->scriptStart(array('inline' => false)) ?>
$(document).ready(function(){
	moduleBase.controller('footerController', ['$scope', '$http', 'AjaxUrlAccess', function($scope, $http, AjaxUrlAccess) {
		$scope.footerInfo = <?php echo $footerInfo; ?>;
		$scope.registFooterInfo = function(id) {
			if (window.confirm('<?php echo __('フッターアイコンを変更します。よろしいですか'); ?>')) {
				resultObject = AjaxUrlAccess.postData(id, 'redirectUrl()');
			}
		}
	}]);
	angular.bootstrap($('#footerInfo'), ['moduleBase']);
});

function redirectUrl() {
	location.href = '<?php echo Router::url(array('controller' => 'footer', 'action' => 'index')); ?>';
}

<?php echo $this->Html->scriptEnd(); ?>
