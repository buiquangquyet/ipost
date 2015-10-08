<div class="preview coupon">
	<div>
		<ul>
		<?php if(is_array($Coupon) || is_object($Coupon)) :?>
			<?php foreach($Coupon as $key => $value) { ?>
			<?php if($value['enable_flg'] == '' || $value['enable_flg'] == '0') { continue; } ?>


				<?php if(!empty($value['image'])) { ?>
					<li class="block margin-medium">
						<div class="clearfix">

							<div class="coupon-image clearfix" style="height: 250px;">
								<?php echo $this->Html->image(array('controller' => 'media', 'action' => 'image/' . $value['image']), array('width' => 220, 'height' => 236)); ?>

								<!-- ▼ クーポン情報 -->
								<div class="coupon-data clearfix">
								</div>
								<!-- ▲ -->

							</div>
						</div>
					</li>

				<?php } else { ?>
					<li class="block margin-medium">
						<div class="clearfix">

							<div class="coupon-image clearfix" style="height: 250px;">
								<?php echo $this->Html->image('preview/bg.png', array('width' => 220, 'height' => 236)); ?>

								<!-- ▼ クーポン情報 -->
								<div class="coupon-data clearfix">
									<h2 class="non-title">&nbsp;</h2>
									<h2 class="uniqlo-font non-discount"><?php echo $value['title']; ?></h2>
									<div class="non-policy_btn">
										<a href="javascript:void(0);"><?php echo __('ご注意事項')?></a>
									</div>

									<div class="coupon-date clearfix">
										<?php if ($value['term_flg'] == 1) { ?>
										<?php if(Configure::read('Config.language') != 'jpn' && Configure::read('Config.language') != 'jp' && Configure::read('Config.language') != 'ja'):?>
										<p class="expired"><?php echo __('有効期限')?>&nbsp;<?php echo date(__('Y-m-d'), strtotime($value['end_datetime'])); ?></p>
										<?php else:?>
										<p class="expired"><?php echo __('有効期限')?>&nbsp;<?php echo date(__('Y年m月d日'), strtotime($value['end_datetime'])); ?></p>
										<?php endif;?>
										<?php } else { ?>
										<p class="expired"><?php echo __('有効期限')?>&nbsp;<?php echo __('なし')?></p>
										<?php } ?>

									</div>
								</div>
								<!-- ▲ -->

							</div>
						</div>
					</li>
				<?php } ?>


			<?php } ?>
			<?php endif;?>
		</ul>
	</div>

</div>