<div class="preview menu">
	<!-- メニュートップ画像 -->
	<div class="menu-image-top">
		<?php if(!empty($menuTop['MenuTopItem']['image_id'])){ ?>
			<?php echo $this->Html->image("/media/image/{$menuTop['MenuTopItem']['image_id']}/", array('width' => 240, 'height' => 131)); ?>
		<?php } else { ?>

		<?php } ?>
	</div>

	<?php foreach($menuItems as $item){ ?>
	<!-- カテゴリーリスト -->
	<div class="block-list">
		<li class="block">
		<a href="/MenuPreview/detail?user_id=<?php echo $userId ?>&key=<?php echo $item['MenuItem']['id'] ?>">
			<div class="menu-image-item">
					<?php if(!empty($item['MenuItem']['image_id'])){ ?>
						<?php echo $this->Html->image("/media/image/{$item['MenuItem']['image_id']}/", array('width' => 81, 'height' => 81)); ?>
					<?php } else { ?>
						<?php echo $this->Html->image("/img/common/noimage/noimage_icon.png", array('width' => 81, 'height' => 81)); ?>
					<?php } ?>
        </div>
			<div class="menu-description">
				<h4>
					<b><font color="white"><?php echo($item['MenuItem']['title']);?></font></b>
				</h4>
				<p>
					<font color="white"><?php echo($item['MenuItem']['sub_title']);?></font>
				</p>
			</div>
		</li>
		</a>
	</div>
	<?php } ?>

</div>