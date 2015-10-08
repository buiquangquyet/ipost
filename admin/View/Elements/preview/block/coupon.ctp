<div id="coupon_block"><div class="block margin-medium coupon">
	<div class="block-title clearfix">
		<h3><?php echo __('お得なクーポン情報！'); ?></h3>
		<?php echo $this->Html->link(__('もっと見る'), array('controller' => 'CouponPreview', 'action' => 'index', '?' => array('user_id' => $userId)), array('class' => 'more')); ?>
	</div>
	<div class="block-list">
		<ul>
			<?php if(is_array($Block['coupon']['coupon']) || is_object($Block['coupon']['coupon'])) :?>
			<?php foreach($Block['coupon']['coupon'] as $key => $value) { ?>
				<?php if($value['enable_flg'] == '' || $value['enable_flg'] == '0') { continue; } ?>
				<li class="clearfix">
					<a href="/CouponPreview/detail/?user_id=<?php echo $userId ?>&key=<?php echo $key ?>">
						<div class="coupon-image">
							<div class="coupon-icon">&nbsp;</div>
						</div>
						<div class="coupon-description">
							<h4><?php echo $value['title']; ?></h4>

							<?php if($value['term_flg'] == 1) { ?>
							<p><?php echo __('有効期限'); ?>
								<?php if(Configure::read('Config.language') != 'jpn' && Configure::read('Config.language') != 'jp' && Configure::read('Config.language') != 'ja'):?>
								<?php echo date('"'.__('Y-m-d').'"', strtotime($value['end_datetime'])); ?>
								<?php else :?>
								<?php echo date('"'.__('Y年m月d日').'"', strtotime($value['end_datetime'])); ?>
								<?php endif;?>
							<?php } ?>
							</p>
						</div>
					</a>
				</li>
				<hr>
			<?php } ?>
			<?php endif;?>
		</ul>
	</div>
</div>