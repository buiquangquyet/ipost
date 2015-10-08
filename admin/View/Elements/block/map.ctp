<div id="map" class="button_item" ng-controller="gpsCtrl" val="gps"><!-- ▼ GPSブロック -->
	
	<div class="frame_main_box box_kage">
		<div class="c"></div>
		<header class="panel-heading panel-title"><?php echo __('マップブロック'); ?></header>

		<div class="form_top"></div>

		<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'enable', 'novalidate' => true, 'id' => 'map_enable')); ?>
		<div class="form-group">
			<label for="form_enable" class="form-label"><?php echo __('表示'); ?></label>
				<div class="checkbox_box">
					<?php echo $this->Form->input("Block.map.del", array('type' => 'radio', 'options' => Configure::read('BlockDisp'), 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;margin-left:30px;margin-top:8px;', 'onchange' => 'postData("map_enable")')); ?>
				</div>
			<p class="form-help fml_184"><?php echo __('お客様に見せるかどうかを選ぶことができます。'); ?></p>
			<div class="form_hr"></div>
		</div>
		<?php echo $this->Form->end(); ?>

		<div class="button_box mt_20">
			<?php echo $this->Html->link('<i class="fa fa-chevron-up"></i>', array('action' => 'movePos', '?' => array('target' => 'map', 'type' => 'forward')), array('class' => 'btn btn-default btn-sm up', 'escape' => false)); ?>
			<?php echo $this->Html->link('<i class="fa fa-chevron-down"></i>', array('action' => 'movePos','?' => array('target' => 'map', 'type' => 'backword')), array('class' => 'btn btn-default btn-sm down', 'escape' => false)); ?>
		</div>


		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>
	</div>
	<!-- ▲ -->
</div>