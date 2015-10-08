<div class="preview shop-profile">

<!-- ▼画像の場合 -->
<?php if(!empty($Splash['splash']['movie']) || !empty($Splash['splash']['image'])) { ?>

	<?php if(!empty($Splash['splash']['movie'])) { ?>
		<video src="<?php echo SYSTEM_PATH; ?>media/5" autoplay="true" muted="true" loop="true" height="100%">
			<p><?php echo __('動画を再生するにはvideoタグをサポートしたブラウザが必要です。')?></p>
		</video>
	<?php } else { ?>
		<div>
			<?php echo $this->Html->image(array('controller' => 'media', 'action' => $Splash['splash']['image']), array('width' => '100%')); ?>
		</div>
	<?php } ?>

<?php } else { ?>
	<?php echo $this->Html->image('common/noimage/noimage_splash.png', array('width' => '100%')); ?>
<?php } ?>
<!-- ▲画像の場合 -->

</div>