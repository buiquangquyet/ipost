<div id="news_block">
	<div class="block margin-medium news">
		<div class="block-title clearfix">
			<h3><?php echo __('当店のインフォメーション'); ?></h3>
			<?php echo $this->Html->link(__('もっと見る'), array('controller' => 'NewsPreview', 'action' => 'index', '?' => array('user_id' => $userId)), array('class' => 'more')); ?>
		</div>
		<div class="block-list">
			<ul>
				<?php foreach($Block['news']['info'] as $info) { ?>
				<li>

					<?php if(Configure::read('Config.language') != 'jpn' && Configure::read('Config.language') != 'jp' && Configure::read('Config.language') != 'ja'):?>
					<?php echo $this->Html->link($info['News']['title'] . ' ' . date(__('Y-m-d'), strtotime($info['News']['created'])), array('controller' => 'NewsPreview', 'action' => 'index', '?' => array('user_id' => $userId))); ?>
					<?php else :?>
					<?php echo $this->Html->link($info['News']['title'] . ' ' . date(__('Y年m月d日'), strtotime($info['News']['created'])), array('controller' => 'NewsPreview', 'action' => 'index', '?' => array('user_id' => $userId))); ?>
					<?php endif;?>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>