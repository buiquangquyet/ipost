<div id="iphone">
	<div id="wrap">

		<!-- ヘッダ -->
		<div id="header" class="store">
		</div>
		<!--  -->

		<!-- ▼コンテンツ -->
		<div id="contents_wrap">

			<div>
				<!-- アプリ情報 -->
				<div id="app_info">
					<div class="clearfix">
						<div id="app_icon" class="fl_l">
							<?php
								if (!empty($Apply['app_icon'])) { 
									echo $this->Html->image(array('controller' => 'media', 'action' => 'image/' . $Apply['app_icon']), array('width' => 100, 'height' => 100)); 
								} else {
									echo $this->Html->image("/img/common/noimage/noimage_icon.png", array('width' => 100, 'height' => 100)); 
								}
								?>
						</div>

						<div id="app_text" class="fl_r">
							<div id="app_name">
								<h1><?php echo $Apply['store_info']['app_name']; ?></h1>
								<h2><?php echo $Apply['store_info']['app_disp_name']; ?></h2>
							</div>

							<div class="clearfix">
								<div id="app_rate" class="fl_l">
									★★★☆☆
								</div>

								<div id="app_install" class="fl_r">
									<a href="javascript:void(0);" class="store_btn"><?php echo __('無料'); ?></a>
								</div>
							</div>
						</div>
					</div>

					<div id="app_menu">
						<ul class="clearfix">
							<li class="current"><a href="javascript:void(0);"><?php echo __('詳細'); ?></a></li>
							<li><a href="javascript:void(0);"><?php echo __('レビュー'); ?></a></li>
							<li><a href="javascript:void(0);"><?php echo __('関連'); ?></a></li>
						</ul>
					</div>
				</div>
				<!--  -->

				<hr />



				<ul id="list">
					<!-- スクリーンショット -->
					<li id="list_img">
						<div>

							<?php foreach($Apply['screenshot_learge'] as $key => $value) {
								if (!empty($value)) { 
									echo $this->Html->image(array('controller' => 'media', 'action' => 'image/' . $value), array('width' => 140, 'height' => 248)); 
								} else {
									echo $this->Html->image("/img/common/noimage/noimage_screen_shot.png", array('width' => 140, 'height' => 248)); 
								}
							}?>

						</div>
					</li>
					<!--  -->

					<hr class="list_border" />

					<!-- 説明 -->
					<li>
						<h4><?php echo __('説明'); ?></h4>
						<p><?php echo __($Apply['store_info']['description']); ?></p>
					</li>
					<!--  -->

					<hr class="list_border" />

					<!-- 情報 -->
					<li id="list_info">
						<h4><?php echo __('情報'); ?></h4>
						<ul class="clearfix">
							<li><label><?php echo __('販売元'); ?></label><span>&nbsp;</span></li>
							<li><label><?php echo __('デベロッパ'); ?></label><span>&nbsp;</span></li>
							<li><label><?php echo __('カテゴリ'); ?></label><span><?php echo __($Apply['store_category_info']['category_iphone1']); ?></span></li>
							<li><label><?php echo __('バージョン'); ?></label><span>1.4</span></li>
							<li><label><?php echo __('サイズ'); ?></label><span>5.0MB</span></li>
							<li><label><?php echo __('レート'); ?></label><span>4+</span></li>
							<li><label><?php echo __('互換性'); ?></label><span><?php echo __('iOS 6.1 以降。iPhone、iPad および iPod touch 対応。iPhone 5 用に最適化済み'); ?></span></li>
						</ul>
					</li>
					<!--  -->

					<hr class="list_border" />

					<!-- バージョン履歴 -->
					<li class="list_link">
						<h4><?php echo __('バージョン履歴'); ?></h4>
					</li>
					<!--  -->

					<hr class="list_border" />

					<!-- デベロッパApp -->
					<li class="list_link">
						<h4><?php echo __('デベロッパApp'); ?></h4>
					</li>
					<!--  -->

					<hr class="list_border" />

					<!-- デベロッパWebサイト -->
					<li class="list_link">
						<h4><?php echo __('デベロッパWebサイト'); ?></h4>
					</li>
					<!--  -->

					<hr class="list_border" />

					<!-- プライバシーポリシー -->
					<li class="list_link">
						<h4><?php echo __('プライバシーポリシー'); ?></h4>
					</li>
					<!--  -->

					<hr class="list_border" />

				</ul>
			</div>

		</div>
		<!-- ▲ -->


		<!-- フッタ -->
		<div id="footer" class="store">
		</div>
<!--  -->
	</div>
</div>