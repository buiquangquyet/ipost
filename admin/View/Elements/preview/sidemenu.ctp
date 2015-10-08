<!-- ▼ サイドメニュー -->
<div id="navigation">
	<ul>
		<?php foreach($sidemenuInfo as $key => $value) { ?>
			<li menu-list-gusu>
				<?php echo $this->Html->link($value['name'], array('controller' => $key .'Preview', '?' => array('user_id' => $userId))); ?>
			</li>
		<?php } ?>
	</ul>
</div>
<!-- ▲ -->


<?php echo $this->Html->scriptStart(array('inline' => false)) ?>
	$(function(){
		$('#menu-trigger').sidr({
			side: 'right',
			source: '#navigation',
		});
	});
<?php echo $this->Html->scriptEnd(); ?>