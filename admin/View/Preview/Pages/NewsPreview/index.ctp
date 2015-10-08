<div class="preview news">

	<!-- ニュース一覧 -->
	<ul>
		<!-- ▼ ニュース記事 -->
		<?php foreach($newsList as $newsInfo) { ?>
		<li id="news_id_335" class="block margin-medium">
			<div class="news-head clearfix">
				<div class="news-icon">

					<?php
						if (!empty($applyInfo['app_icon'])) {
							echo $this->Html->image("/media/image/{$applyInfo['app_icon']}/", array('width' => 32, 'height' => 32));
						} else {
							echo $this->Html->image("/img/common/noimage/noimage_icon.png", array('width' => 32, 'height' => 32));
						}
					?>
				</div>

				<div class="news-title">
					<div class="title">
						<?php echo $newsInfo['News']['title']; ?>

					</div>
					<div class="datetime">
						<?php if(Configure::read('Config.language') != 'jpn' && Configure::read('Config.language') != 'jp' && Configure::read('Config.language') != 'ja'):?>
						<?php echo date('"'.__('Y-m-d').'"', strtotime($newsInfo['News']['created'])); ?><i class="fa fa-clock-o mg-l-xs"></i>
						<?php else :?>
						<?php echo date('"'.__('Y年m月d日').'"', strtotime($newsInfo['News']['created'])); ?><i class="fa fa-clock-o mg-l-xs"></i>
						<?php endif;?>
					</div>
				</div>
			</div>

			<div class="news-body">
				<?php echo nl2br($newsInfo['News']['body']); ?>
			</div>

			<?php if (!empty($newsInfo['News']['image'])) { ?>
				<div class="news-image">
					<?php echo $this->Html->image("/media/image/{$newsInfo['News']['image']}/"); ?>
				</div>
			<?php } ?>

			<div class="news-buttons clearfix">
				<ul>
					<li><a href="javascript:void(0);" title="<?php echo __('いいね！')?>" class="iine"><?php echo __('いいね！')?></a></li>
				</ul>
			</div>

		</li>
		<!-- ▲ -->
		<?php } ?>

	</ul>
	<!--  -->

</div>