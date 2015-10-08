<div id="footer" class="footer-warp clearfix">
	<ul class="footer-tab font-icon-standart clearfix">
		<?php foreach($footerInfo as $key => $value) { ?>
			<li class="footer-tab-item tab-item-<?php echo count($footerInfo); ?> item-<?php echo $key+1; ?>">
				<a href="javascript:void(0);"><?php echo $value['icon']; ?></a>
			</li>
		<?php } ?>
	</ul>
</div>