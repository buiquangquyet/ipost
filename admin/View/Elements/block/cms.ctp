<?php if(IPOST_HK_VERSION_FLG == '0'){ ?>
<div id="cms" class="button_item" ng-controller="cmsCtrl" val="cms"><!-- ▼ HTMLビューブロック -->
	<div class="frame_main_box box_kage">
		<div class="c"></div>
		<header class="panel-heading panel-title"><?php echo __('HTMLビューブロック'); ?></header>
		<div class="form_top"></div>

		<!-- ▼ 表示 ON/OFF -->
		<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'enable', 'novalidate' => true, 'id' => 'cms_enable')); ?>
		<div class="form-group">
			<label for="form_enable" class="form-label"><?php echo __('表示'); ?></label>
			<div class="checkbox_box">
				<?php echo $this->Form->input("Block.cms.del", array('type' => 'radio', 'options' => Configure::read('BlockDisp'), 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;margin-left:30px;margin-top:8px;', 'onchange' => 'postData("cms_enable")')); ?>
			</div>
			<p class="form-help fml_184"><?php echo __('お客様に見せるかどうかを選ぶことができます。'); ?></p>

			<div class="form_hr"></div>
		</div>
		<?php echo $this->Form->end(); ?>
		<!-- ▲ 表示 ON/OFF -->

		<hr>

		<!-- ▼ 入力ボックス -->
		<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'regist', 'novalidate' => true, 'id' => 'cms_form')); ?>
		<div class="form-group">
			<label for="form_cmc_height" class="form-label"><?php echo __('ボックス高さ(px)'); ?></label>
			<?php echo $this->Form->input("Block.cms.height", array('type' => 'text', 'class' => 'form-txt form-2', 'placeholder' => __('数値を入力'), 'label' => false)); ?>
			<div class="fl di">
				<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:postData('cms_form');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
			</div>
			<p class="form-help fml_184"><?php echo __('端末によって表示に差異がございますので、おおよそのpx指定になっております。<br>最大1200pxまでになっています。ご注意ください。'); ?></p>
			<div class="form_hr"></div>
		</div>
		<?php echo $this->Form->end(); ?>
		<!-- ▲ 入力ボックス -->

		<!-- ▼ ボックス -->
		<div class="form-group">
			<label for="form_cmc_height" class="form-label">&nbsp;</label>
			<div class="fl di">
				<?php echo $this->Html->link('<i class="fa fa-edit mg-r-xs"></i>' . __('編集画面へ移動'), array('controller' => 'Html'), array('class' => 'btn btn-default btn-sm', 'escape' => false)); ?>
			</div>
			<p class="form-help fml_184"><?php echo __('上記、リンク先からでもHTMLの編集画面へ移動できます。'); ?></p>
			<div class="form_hr"></div>
		</div>
		<!-- ▲ ボックス -->

		<div class="button_box mt_20">
			<?php echo $this->Html->link('<i class="fa fa-chevron-up"></i>', array('action' => 'movePos', '?' => array('target' => 'cms', 'type' => 'forward')), array('class' => 'btn btn-default btn-sm up', 'escape' => false)); ?>
			<?php echo $this->Html->link('<i class="fa fa-chevron-down"></i>', array('action' => 'movePos','?' => array('target' => 'cms', 'type' => 'backword')), array('class' => 'btn btn-default btn-sm down', 'escape' => false)); ?>
		</div>

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>
	</div>
	<!-- ▲ -->


</div>
<?php } ?>