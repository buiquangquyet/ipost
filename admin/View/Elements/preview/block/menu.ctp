<div id="menu_block"><div class="block margin-medium menu">
	<div class="block-title clearfix">
		<h3><?php echo __('当店のおすすめメニュー'); ?></h3>

		<?php if($menuMode == 1){ ?>
			<?php echo $this->Html->link(__('もっと見る'), array('controller' => 'MenuPreview', 'action' => 'easy', '?' => array('user_id' => $userId)), array('class' => 'more')); ?>
		<?php }else if($menuMode == 2){ ?>
			<?php echo $this->Html->link(__('もっと見る'), array('controller' => 'MenuPreview', 'action' => 'easy', '?' => array('user_id' => $userId)), array('class' => 'more')); ?>
		<?php } ?>
			</div>
	<div class="block-list">
		<ul>
			<?php foreach($Block['menu']['menus'] as $key => $value) { ?>

			<li class="clearfix">
				<a href="/MenuPreview/detail?user_id=<?php echo $userId ?>&key=<?php echo $value['MenuItem']['id'] ?>">
				<div class="menu-image">
				<?php if($value['MenuItem']['image_id'] != ''){ ?>
					<?php echo $this->Html->image("/media/image/{$value['MenuItem']['image_id']}"); ?>
				<?php }else{ ?>
					<div class="menu-icon">&nbsp;</div>
				<?php } ?>

				</div>
					<div class="menu-description">
						<h4><?php echo $value['MenuItem']['title']; ?></h4>
						<p><?php echo $value['MenuItem']['description']; ?></p>
					</div>
				</a>
			</li>

			<hr>

			<!--
				<li class="clearfix">
					<a href="/preview/menudetail/475">
						<div class="menu-image">
							<div class="menu-icon">&nbsp;</div>
						</div>
						<div class="menu-description">
							<h4><?php echo $value['Menu']['title']; ?></h4>
							<p><?php echo $value['Menu']['info']; ?></p>
						</div>
					</a>
				</li>
			-->
			<?php } ?>
		</ul>
	</div>
</div>