<div class="header-warp <?php echo $headerInfo['header']['color']; ?> clearfix">
	<div class="left">
		&nbsp;
	</div>
	<div class="center text">
		<h1>
		<?php 
			if($headerInfo['header']['image'] == '') {
				echo $this->Html->link(__('アプリケーション名'), 'javascript:void(0);'); 
			} else {
				echo $this->Html->link($this->Html->image(array('controller' => 'media', 'action' => $headerInfo['header']['image']), array('height' => 35)), 'javascript:void(0);', array('escape' => false));
			}
		?>
		</h1>
	</div>
	<div class="right">
		<?php echo $this->Html->link($this->Html->image('preview/slide_btn_open.png', array('alt' => __('ナビゲーション'), 'width' => 21, 'height' => 21)), '#sidr', array('id' => 'menu-trigger', 'escape' => false)); ?>
	</div>
</div>