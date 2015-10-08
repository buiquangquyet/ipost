
<div class="frame_main_box box_kage">
	<div class="c"></div>

	<header class="panel-heading panel-title"><?php echo __('マニュアル'); ?></header>
	<div class="button_box mt_20">
		<p class="form-help ml_15 mr_15 mb_10"><?php echo __('アプリ制作や管理画面についてのマニュアルをダウンロードいただけます。'); ?></p>
		<?php echo $this->Html->image('common/support/manual_img.png', array('class' => 'mt_10 w200')); ?><br>

		<?php if($lang != 'zh'){ ?>
			<?php echo $this->Html->link(__('マニュアルのダウンロード'), '/assets/pdf/manual/ipost_enterprise_manual.pdf', array('class' => 'btn btn-default btn-sm', 'target' => '_blank')); ?>
		<?php } ?>

		<?php if($lang == 'zh'){ ?>
			<?php echo $this->Html->link(__('マニュアルのダウンロード'), '/assets/pdf/manual/hk-ipost_enterprise_manual.pdf', array('class' => 'btn btn-default btn-sm', 'target' => '_blank')); ?>
		<?php } ?>

		<p class="form-help ml_0 mt_10"><?php echo __('※pdfファイルとなっています。'); ?></p>
	</div>
	<div class="c10"></div>

	<div class="frame_bottom_box">
		<div class="padding10"></div>
	</div>
</div>