<div id="topic" class="button_item"><!-- ▼ トピックメッセージ -->
	<div class="frame_main_box box_kage">
		<div class="c"></div>
		<header class="panel-heading panel-title"><?php echo __('トピックメッセージブロック'); ?></header>
		<div class="form_top"></div>

		<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'enable', 'novalidate' => true, 'id' => 'topic_enable')); ?>
		<div class="form-group">
			<div class="form-group">
				<label for="form_enable" class="form-label"><?php echo __('表示'); ?></label>
				<div class="checkbox_box">
					<?php echo $this->Form->input("Block.topic.del", array('type' => 'radio', 'options' => Configure::read('BlockDisp'), 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;margin-left:30px;margin-top:8px;', 'onchange' => 'postData("topic_enable")')); ?>
				</div>
				<p class="form-help fml_184 mb_20"><?php echo __('お客様に見せるかどうかを選ぶことができます。'); ?></p>
				<div class="form_hr"></div>
			</div>
			<div class="c"></div>
		</div>
		<?php echo $this->Form->end(); ?>


		<!-- ▼ 入力ボックス -->
		<div class="form-group" id="marquee_form">
			<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'regist', 'novalidate' => true, 'id' => 'topic_form')); ?>
				<label for="upload" class="form-label"><?php echo __('メッセージ'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
				<?php echo $this->Form->input("Block.topic.message", array('type' => 'text', 'class' => 'form-txt form-5', 'placeholder' => __('メッセージを入力してください'), 'label' => false)); ?>

				<div class="button_box di ml_10 pt_0">
					<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:postData('topic_form');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
				</div>
			<?php echo $this->Form->end(); ?>
			<div class="form_hr"></div>
		</div>
		<!-- ▲ -->

		<div class="button_box mt_20">
			<?php echo $this->Html->link('<i class="fa fa-chevron-up"></i>', array('action' => 'movePos', '?' => array('target' => 'topic', 'type' => 'forward')), array('class' => 'btn btn-default btn-sm up', 'escape' => false)); ?>
			<?php echo $this->Html->link('<i class="fa fa-chevron-down"></i>', array('action' => 'movePos','?' => array('target' => 'topic', 'type' => 'backword')), array('class' => 'btn btn-default btn-sm down', 'escape' => false)); ?>
		</div>

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>
	</div>
	<!-- ▲ -->
</div>