<div id="margin">
	<div>

		<div class="frame_main_box box_kage">
			<div class="c"></div>
			<header class="panel-heading panel-title"><?php echo __('マージン設定')?></header>
			<div class="form_top"></div>

			<div class="form-group">
				<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'regist', 'novalidate' => true, 'id' => 'margin_enable')); ?>
					<label for="form_enable" class="form-label"><?php echo __('マージン');?></label>
					<div class="select_custom">

						<?php echo $this->Form->input("Block.margin.margin", array('type' => 'select', 'options' => Configure::read('MarginSetting'), 'label' => false, 'div' => false, 'class' => 'form-select'));?>

						<div class="button_box di ml_10 pt_0">
							<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:postData('margin_enable');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
						</div>
					</div>
				<?php echo $this->Form->end(); ?>
			</div>


			<div class="frame_bottom_box">
				<div class="padding10"></div>
			</div>
		</div>

		<?php foreach($Block as $key => $blockInfo) {
			if ($key != 'margin') { 
				echo $this->element('block/' . $key);
			}
		} ?>
	</div>
</div>


<?php echo $this->Html->scriptStart(array('inline' => false)) ?>

	function postData(id) {
		$('#' + id).submit();
	}

	function toggleForm(target, id) {
		$('#' + target + '_result_' + id).toggle();
		$('#' + target + '_form_' + id).toggle();
	}

<?php echo $this->Html->scriptEnd(); ?>