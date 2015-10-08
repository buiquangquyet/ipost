<div id="webview" class="button_item" ng-controller="webCtrl" val="web"><!-- ▼ ウェブビューブロック -->
	<div class="frame_main_box box_kage">
		<div class="c"></div>
		<header class="panel-heading panel-title"><?php echo __('ウェブビューブロック'); ?></header>
		<div class="form_top"></div>

		<!-- ▼ ウェブビューブロック -->
		<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'enable', 'novalidate' => true, 'id' => 'webview_enable')); ?>
		<div class="form-group">
			<form action="/rest/block/html_disp.json" id="html_post_del_flg">
				<label for="form_enable" class="form-label"><?php echo __('表示'); ?></label>
				<span>
					<div class="checkbox_box">
					<?php echo $this->Form->input("Block.webview.del", array('type' => 'radio', 'options' => Configure::read('BlockDisp'), 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;margin-left:30px;margin-top:8px;', 'onchange' => 'postData("webview_enable")')); ?>
					</div>
				</span>
				<p class="form-help fml_184 mb_20"><?php echo __('お客様に見せるかどうかを選ぶことができます。'); ?></p>
			</form>
			<div class="form_hr"></div>
		</div>
		<?php echo $this->Form->end(); ?>


		<div class="form-group" id="html_form">
			<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'regist', 'novalidate' => true, 'id' => 'webview_form')); ?>
				<label for="top_html" class="form-label">URL</label>
				<?php echo $this->Form->input("Block.webview.url", array('type' => 'text', 'class' => 'form-txt form-5', 'placeholder' => __('例：http://www.google.co.jp'), 'label' => false)); ?>

				<div class="button_box di ml_10 pt_0">
					<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:postData('webview_form');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
				</div>
			<?php echo $this->Form->end(); ?>
		</div>
		<!-- ▲ -->

		<div class="button_box mt_20">
			<?php echo $this->Html->link('<i class="fa fa-chevron-up"></i>', array('action' => 'movePos', '?' => array('target' => 'webview', 'type' => 'forward')), array('class' => 'btn btn-default btn-sm up', 'escape' => false)); ?>
			<?php echo $this->Html->link('<i class="fa fa-chevron-down"></i>', array('action' => 'movePos','?' => array('target' => 'webview', 'type' => 'backword')), array('class' => 'btn btn-default btn-sm down', 'escape' => false)); ?>
		</div>

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>
	</div>
	<!-- ▲ -->
</div>