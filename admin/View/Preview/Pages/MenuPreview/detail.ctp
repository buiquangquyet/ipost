<div class="preview menu">
	<!-- メニュートップ画像 -->
	<div class="menu-image-top">
		<?php if(!empty($menuItem['MenuItem']['image_id'])){ ?>
			<?php echo $this->Html->image("/media/image/{$menuItem['MenuItem']['image_id']}/", array('width' => 240, 'height' => 131)); ?>
		<?php } else { ?>
			<img src="/img/common/noimage/noimage_menutop.png" width='240' height='131' alt="">
		<?php } ?>
	</div>


	<div class="block margin-medium news">
			<div class="block-title clearfix">
				<h3><?php echo($menuItem['MenuItem']['title']);?></h3>
	</div>
	<div class="block-list">
		<ul>
			<li><?php echo($menuItem['MenuItem']['description']);?></li>
		</ul>
	</div>
</div>


	<div class="block menudetail-description">
		<div class="title">
			<h4 style="text-align: right;">
					<?php echo($menuItem['MenuItem']['price']);?> <?php echo($menuItem['MenuItem']['currency']);?>
				</p>
			</h4>
		</div>
</div>