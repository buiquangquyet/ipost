<div id="menu" class="button_item"><!-- ▼ メニュー文字ブロック -->
	<div class="frame_main_box box_kage">
		<div class="c"></div>
		<header class="panel-heading panel-title"><?php echo __('おすすめメニューブロック'); ?></header>
		<div class="form_top"></div>

		<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'enable', 'novalidate' => true, 'id' => 'menu_enable')); ?>
		<div class="form-group">
			<form action="/rest/block/menu_disp.json" id="menu_post_del_flg" class="ng-pristine ng-valid">
				<label for="form_enable" class="form-label"><?php echo __('表示'); ?></label>
				<div class="checkbox_box">
					<?php echo $this->Form->input("Block.menu.del", array('type' => 'radio', 'options' => Configure::read('BlockDisp'), 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;margin-left:30px;margin-top:8px;', 'onchange' => 'postData("menu_enable")')); ?>
				</div>
				<p class="form-help fml_184 mb_20"><?php echo __('お客様に見せるかどうかを選ぶことができます。'); ?></p>
			</form>
			<div class="form_hr"></div>
		</div>
		<?php echo $this->Form->end(); ?>



		<!-- ▼ メニューリスト変更 -->
		<div class="form-group">
			<ul>
				<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'regist', 'novalidate' => true, 'id' => 'menu_form')); ?>

					<?php foreach($Block['menu']['menus'] as $key => $menuInfo) { ?>
						<li class="clearfix">
							<label for="menu_item_0" class="form-label"><?php echo __('おすすめメニュー'); ?><?php echo $key + 1; ?><span class="nin"><?php echo __('任意'); ?></span></label>
							<div class="select_custom">
								<?php echo $this->Form->input("Block.menu.menus.{$key}", array('type' => 'select', 'options' => $menuItemsList, 'label' => false, 'div' => false, 'class' => 'form-select', 'onChange' => "changeCoupon({$key})"));?>
							</div>
						</li>
						<div class="padding10"></div>
					<?php } ?>
				<?php echo $this->Form->end(); ?>
			</ul>
		</div>

		<div class="button_box">
			<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:postData('menu_form');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
		</div>
		<!-- ▲ -->

		<div class="button_box mt_20">
			<?php echo $this->Html->link('<i class="fa fa-chevron-up"></i>', array('action' => 'movePos', '?' => array('target' => 'menu', 'type' => 'forward')), array('class' => 'btn btn-default btn-sm up', 'escape' => false)); ?>
			<?php echo $this->Html->link('<i class="fa fa-chevron-down"></i>', array('action' => 'movePos','?' => array('target' => 'menu', 'type' => 'backword')), array('class' => 'btn btn-default btn-sm down', 'escape' => false)); ?>
		</div>


		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>
	</div>
</div>