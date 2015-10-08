<div id="sns_block">
	<div class="block margin-medium sns">
		<ul class="clearfix">
			<?php foreach($Block['sns']['snsinfo'] as $key => $value) { ?>
				<?php if($value != '') { ?>
					<li>
						<a href="javascript:void(0);">
							<?php echo $this->Html->image('preview/sns/' . $key . '.png'); ?>
						</a>
					</li>
				<?php } ?>
			<?php } ?>
	</div>
</div>