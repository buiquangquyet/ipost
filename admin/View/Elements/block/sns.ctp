<div id="sns" class="button_item" ng-controller="snsCtrl" val="sns"><!-- ▼ SNS文字ブロック -->
	<div class="frame_main_box box_kage">
		<div class="c"></div>
		<header class="panel-heading panel-title"><?php echo __('SNSブロック'); ?></header>
		<div class="form_top"></div>

		<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'enable', 'novalidate' => true, 'id' => 'sns_enable')); ?>
		<div class="form-group">
			<form action="/rest/block/sns_disp.json" id="sns_post_del_flg">
				<label for="form_enable" class="form-label"><?php echo __('表示'); ?></label>
				<div class="checkbox_box">
					<?php echo $this->Form->input("Block.sns.del", array('type' => 'radio', 'options' => Configure::read('BlockDisp'), 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;margin-left:30px;margin-top:8px;', 'onchange' => 'postData("sns_enable")')); ?>
				</div>
				<p class="form-help fml_184 mb_20"><?php echo __('お客様に見せるかどうかを選ぶことができます。'); ?></p>
			</form>
			<div class="form_hr"></div>
		</div>
		<?php echo $this->Form->end(); ?>


		<!-- ▼ 変更 -->
		<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'regist', 'novalidate' => true, 'id' => 'sns_form')); ?>
			<div class="form-group" id="sns_disp">
				<label for="sns_1" class="form-label">Facebook<span class="nin"><?php echo __('任意'); ?></span></label>
				<?php echo $this->Form->input("Block.sns.snsinfo.sns_1", array('type' => 'text', 'class' => 'form-txt form-6', 'placeholder' => 'https://www.facebook.com/XXXXX', 'label' => false)); ?>
				<div class="form_hr"></div>
			</div>
			<div class="form-group" id="sns_disp">
				<label for="sns_2" class="form-label">Twitter<span class="nin"><?php echo __('任意'); ?></span></label>
				<?php echo $this->Form->input("Block.sns.snsinfo.sns_2", array('type' => 'text', 'class' => 'form-txt form-6', 'placeholder' => 'https://twitter.com/XXXXX', 'label' => false)); ?>
				<div class="form_hr"></div>
			</div>
			<div class="form-group" id="sns_disp">
				<label for="sns_3" class="form-label">Google+<span class="nin"><?php echo __('任意'); ?></span></label>
				<?php echo $this->Form->input("Block.sns.snsinfo.sns_3", array('type' => 'text', 'class' => 'form-txt form-6', 'placeholder' => 'https://plus.google.com/XXXXX', 'label' => false)); ?>
				<div class="form_hr"></div>
			</div>
			<div class="form-group" id="sns_disp">
				<label for="sns_4" class="form-label">Youtube<span class="nin"><?php echo __('任意'); ?></span></label>
				<?php echo $this->Form->input("Block.sns.snsinfo.sns_4", array('type' => 'text', 'class' => 'form-txt form-6', 'placeholder' => 'https://www.youtube.com/XXXXX', 'label' => false)); ?>
				<div class="form_hr"></div>
			</div>
			<div class="form-group" id="sns_disp">
				<label for="sns_5" class="form-label">Ameba<span class="nin"><?php echo __('任意'); ?></span></label>
				<?php echo $this->Form->input("Block.sns.snsinfo.sns_5", array('type' => 'text', 'class' => 'form-txt form-6', 'placeholder' => 'http://ameblo.jp/XXXXX', 'label' => false)); ?>
				<div class="form_hr"></div>
			</div>
			<div class="form-group" id="sns_disp">
				<label for="sns_6" class="form-label">LINE<span class="nin"><?php echo __('任意'); ?></span></label>
				<?php echo $this->Form->textarea("Block.sns.snsinfo.sns_6", array('type' => 'text', 'class' => 'form-txt form-6', 'label' => false)); ?>
				<div class="form_hr"></div>
			</div>
			<!-- ▲ -->

			<div class="button_box">
				<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:postData('sns_form');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
			</div>
		<?php echo $this->Form->end(); ?>

		<div class="button_box mt_20">
			<?php echo $this->Html->link('<i class="fa fa-chevron-up"></i>', array('action' => 'movePos', '?' => array('target' => 'sns', 'type' => 'forward')), array('class' => 'btn btn-default btn-sm up', 'escape' => false)); ?>
			<?php echo $this->Html->link('<i class="fa fa-chevron-down"></i>', array('action' => 'movePos','?' => array('target' => 'sns', 'type' => 'backword')), array('class' => 'btn btn-default btn-sm down', 'escape' => false)); ?>
		</div>

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>
	</div>
	<!-- ▲ -->

</div>