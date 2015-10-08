<!-- ▼ アイコン画像 -->
<div class="frame_main_box box_kage" id="icon">

	<header class="panel-heading panel-title"><?php echo __('アイコン画像の登録'); ?><span class="hisu"><?php echo __('必須'); ?></span></header>

	<div id="iconimage_result">
		<div class="padding10 f_d ta_c lh_15 mt_20">
			<?php echo __('アプリケーションのアイコン画像の設定になります。'); ?><br />
			<?php echo __('推奨サイズは、1024px × 1024pxサイズになります。'); ?><br />
			<?php echo __('透過指定されていますと、透過部分が黒くなりますのでご注意下さい。'); ?>
			<p><span style="color: #900;"><?php echo __('※1度審査申請されますと変更することができませんのでご注意下さい。'); ?></span></p>
		</div>

		<div class="form-group center_box">
			<label id='registprev' class="form-label no-hand ta_c p84">
				<?php
					if(!empty($applyInfo['app_icon']) && $applyInfo['app_icon'] != '') {
						echo $this->Html->image("/media/image/{$applyInfo['app_icon']}/", array('class' => 'path-img-store-appicon', 'alt' => __('アイコン画像')));
					} else {
						echo $this->Html->image("/img/common/noimage/noimage_icon.png", array('class' => 'path-img-store-appicon', 'alt' => __('アイコン画像')));
					}
				?>
			</label>
			<div class="form_hr"></div>
		</div>

		<div class="button_box">
			<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:toggleForm('iconimage');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
		</div>

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>
	</div>

	<div id="iconimage_form" style="display:none;">

		<?php echo $this->Form->create(false, array('type' => 'file', 'action' => 'registIconImage', 'novalidate' => true, 'id' => 'iconimage')); ?>

			<div>
				<label class="form-label no-hand ml_70 pr_15">
					<?php
						if(!empty($applyInfo['app_icon']) && $applyInfo['app_icon'] != '') {
							echo $this->Html->image("/media/image/{$applyInfo['app_icon']}", array('width' => 80, 'height' => 80, 'class' => 'con_img wau', 'alt' => __('アイコン画像'), 'id' => 'iconimage_viewer'));
						} else {
							echo $this->Html->image("/img/common/noimage/noimage_menu_news.png", array('width' => 80, 'height' => 80, 'class' => 'con_img wau', 'alt' => __('アイコン画像'), 'id' => 'iconimage_viewer'));
						}
					?>
				</label>
				<div class="form_hr"></div>
			</div>

			<div class="form-group ml_70">
				<label for="upload" class="form-label wau ml_0"><?php echo __('画像の選択'); ?><span class="hisu"><?php echo __('必須'); ?></span></label>
				<div class="upload_wrapper">
					<div class="upload_btn"><?php echo __('ファイルを選択'); ?></div>
					<?php echo $this->Form->file("image", array('class' => 'wau pt_10 ImageSelect', 'label' => false, 'pos' => 'iconimage_viewer')); ?>
				</div>
				<p class="form-help mr_15 ml_0 mt_10">
					<?php echo __('ファイルサイズ：3MBまで'); ?><br>
					<?php echo __('1024px x 1024px 以上の大きさを推奨'); ?><br>
					<?php echo __('透過指定されていますと、透過部分が黒くなりますのでご注意下さい。'); ?><br>
					<span style="color: #900;"><?php echo __('※1度審査申請されますと変更することができませんのでご注意下さい。'); ?></span>
				</p>
			</div>

			<hr>

			<div class="btn_center">
				<?php echo $this->Html->link(__('<i class="fa fa-mail-reply mg-r-xs"></i>戻る'), "javascript:toggleForm('iconimage');", array('escape' => false, 'class' => 'btn btn-default btn-sm')); ?>
				<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>確認'), "javascript:postData('iconimage');", array('escape' => false, 'class' => 'btn btn-info btn-sm')); ?>
			</div>

		<?php echo $this->Form->end(); ?>

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>

	</div>
</div>
<!-- ▲ -->


<!-- ▼ 宣伝用画像 -->
<div class="frame_main_box box_kage" id="ad">

	<header class="panel-heading panel-title"><?php echo __('宣伝用画像の登録'); ?><span class="hisu"><?php echo __('必須'); ?></span></header>


	<div id="adimage_result">
		<div class="padding10 f_d ta_c lh_15 mt_20">
			<?php echo __('Google Play (Android用アプリストア)掲載時の宣伝用画像の設定になります。'); ?><br />
			<?php echo __('推奨サイズは、1024px × 500pxサイズになります。'); ?><br />
			<?php echo __('透過指定できませんのでご注意下さい。'); ?>
			<p><span style="color: #900;"><?php echo __('※1度審査申請されますと変更することができませんのでご注意下さい。'); ?></span></p>
		</div>

		<div class="form-group center_box">
			<label id='registprev' class="form-label no-hand ta_c">
				<?php
					if(!empty($applyInfo['app_ad_image']) && $applyInfo['app_ad_image'] != '') {
						echo $this->Html->image("/media/image/{$applyInfo['app_ad_image']}", array('class' => 'path-img-shop', 'alt' => __('宣伝用画像')));
					} else {
						echo $this->Html->image("/img/common/noimage/noimage_icon.png", array('class' => 'path-img-shop', 'alt' => __('宣伝用画像')));
					}
				?>
			</label>
			<div class="form_hr"></div>
		</div>

		<div class="button_box">
			<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:toggleForm('adimage');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
		</div>

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>
	</div>

	<div id="adimage_form" style="display:none;">



		<?php echo $this->Form->create(false, array('type' => 'file', 'action' => 'registAdImage', 'novalidate' => true, 'id' => 'adimage')); ?>
			<div>
				<label class="form-label no-hand ml_70 pr_15">
					<?php
						if(!empty($applyInfo['app_ad_image']) && $applyInfo['app_ad_image'] != '') {
							echo $this->Html->image("/media/image/{$applyInfo['app_ad_image']}", array('width' => 256, 'height' => 125, 'class' => 'con_img wau', 'alt' => __('起動画面用の画像'), 'id' => 'adimage_viewer'));
						} else {
							echo $this->Html->image("/img/common/noimage/noimage_screen_shot.png", array('width' => 256, 'height' => 125, 'class' => 'con_img wau', 'alt' => __('起動画面用の画像'), 'id' => 'adimage_viewer'));
						}
					?>
				</label>
				<div class="form_hr"></div>
			</div>

			<div class="form-group ml_70">

				<label for="upload" class="form-label wau ml_0"><?php echo __('画像の選択'); ?><span class="hisu"><?php echo __('必須'); ?></span></label>
				<div class="upload_wrapper">
					<div class="upload_btn"><?php echo __('ファイルを選択'); ?></div>
					<?php echo $this->Form->file("image", array('class' => 'wau pt_10 ImageSelect', 'label' => false, 'pos' => 'adimage_viewer')); ?>
				</div>
				<p class="form-help mr_15 ml_0 mt_10">
					<?php echo __('ファイルサイズ：3MBまで'); ?><br>
					<?php echo __('1024px x 500px 以上の大きさを推奨'); ?><br>
					<span style="color: #900;"><?php echo __('※1度審査申請されますと変更することができませんのでご注意下さい。'); ?></span>
				</p>

			</div>

			<hr>

			<div class="btn_center">
				<?php echo $this->Html->link(__('<i class="fa fa-mail-reply mg-r-xs"></i>戻る'), "javascript:toggleForm('adimage');", array('escape' => false, 'class' => 'btn btn-default btn-sm')); ?>
				<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>確認'), "javascript:postData('adimage');", array('escape' => false, 'class' => 'btn btn-info btn-sm')); ?>
			</div>

		<?php echo $this->Form->end(); ?>

	</div>
</div>
<!-- ▲ -->




<!-- ▼ アプリストア表示項目 -->
<div class="frame_main_box box_kage" id="storedisp">

	<header class="panel-heading panel-title"><?php echo __('アプリストア(App Store/Google Play)表示項目の登録'); ?><span class="hisu"><?php echo __('必須'); ?></span></header>
	<div class="padding10 f_d ta_c lh_15 mt_20 mb_10">
		<?php echo __('アプリケーションの名前、および、ストア掲載時の説明文の設定になります。'); ?><br />
		<?php echo __('アプリ表示名&nbsp;&nbsp;:&nbsp;ホーム画面/ランチャー画面時のアイコン下に表示されるアプリ名になります。'); ?><br />
		<?php echo __('ストア表示名&nbsp;:&nbsp;アプリストア掲載時のアプリ名になります。'); ?>
		<p><span style="color: #900;"><?php echo __('※1度審査申請されますと変更することができませんのでご注意下さい。'); ?></span></p>
	</div>

	<div id="dispitem_result">
		<div class="form-group">
			<label class="form-label"><?php echo __('アプリ表示名'); ?></label>
			<div class="form-txt_box"><?php echo $applyInfo['store_info']['app_name']; ?></div>
			<div class="form_hr"></div>
		</div>

		<div class="form-group">
			<label class="form-label"><?php echo __('ストア表示名'); ?></label>
			<div class="form-txt_box"><?php echo $applyInfo['store_info']['app_disp_name']; ?></div>
			<div class="form_hr"></div>
		</div>

		<div class="form-group">
			<label class="form-label"><?php echo __('説明文'); ?></label>
			<div class="form-txt_box"><?php echo $applyInfo['store_info']['description']; ?></div>
			<div class="form_hr"></div>
		</div>

		<div class="button_box">
			<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:toggleForm('dispitem');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
		</div>

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>
	</div>

	<div id="dispitem_form" style="display:none;">


		<div class="form_top"></div>
			<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'registDispItem', 'novalidate' => true, 'id' => 'dispitem', 'class' => 'dispitem')); ?>

			<div class="form-group">
				<label for="form_app_disp_name" class="form-label"><?php echo __('アプリ表示名'); ?><spna class="hisu"><?php echo __('必須'); ?></spna></label>
				<?php echo $this->Form->input("app_name", array('class' => 'form-txt form-5', 'type' => 'text', 'label' => false, 'placeholder' => '','value' => $applyInfo['store_info']['app_name'], 'data-rule-required'=>"true", 'data-msg-required' => __("アプリ表示名の選択が必要になります。"))); ?>
				<p class="form-help fml_184"><?php echo __('最大全角6文字分 (半角12文字分)'); ?></p>
				<p class="error fml_184"></p>
			</div>

			<div class="form-group">
				<label for="form_app_name" class="form-label"><?php echo __('ストア表示名'); ?><spna class="hisu"><?php echo __('必須'); ?></spna></label>
				<?php echo $this->Form->input("app_disp_name", array('class' => 'form-txt form-5', 'type' => 'text', 'label' => false, 'placeholder' => '','value' => $applyInfo['store_info']['app_disp_name'], 'data-rule-required'=>"true", 'data-msg-required' => __("ストア表示名の選択が必要になります。"))); ?>
				<p class="form-help fml_184"><?php echo __('最大全角12文字／推奨全角9文字以内'); ?></p>
				<p class="error fml_184"></p>
				<div class="form_hr"></div>
			</div>

			<div class="form-group">
				<label for="form_description" class="form-label"><?php echo __('説明文'); ?><spna class="hisu"><?php echo __('必須'); ?></spna></label>
				<?php echo $this->Form->textarea("description", array('class' => 'form-txt form-5', 'type' => 'textarea', 'label' => false, 'placeholder' => '','value' => $applyInfo['store_info']['description'], 'data-rule-required'=>"true", 'data-msg-required' => __("説明文の選択が必要になります。"))); ?>
				<p class="form-help fml_184"><?php echo __('全角100 〜 2,000文字'); ?></p>
				<p class="error fml_184"></p>
			</div>

			<hr>

			<div class="form-group">
				<p class="form-help">
					<?php echo __('審査に通過しやすい説明文'); ?><br><br>
					<?php echo __('例文：'); ?><br><br>
					<?php echo __('みつの里の公式アプリです。'); ?><br>
					<?php echo __('このアプリでは、アプリユーザー限定の様々なサービスを受けることができます。'); ?><br><br><br>
					<?php echo __('例えば…'); ?><br>
					<?php echo __('・お店情報や最新の商品情報を入手することができます。'); ?><br>
					<?php echo __('・標準アプリのマップを起動させてお店の位置を確認することができます。'); ?><br>
					<?php echo __('・お店から最新情報やお得なクーポンなどを受け取ることができます。'); ?><br>
					<?php echo __('・オンラインショップや公式ホームページなどもすぐにチェックできます。'); ?><br>
					<?php echo __('・オーダーエントリーがお使いのスマートフォンからできるようになります。（導入店に限る）'); ?><br><br><br>
					<?php echo __('このようにアプリで実際に提供できる内容を記載すると、審査に通過しやすいポイントになります。'); ?><br>
					<span style="color: #900;"><?php echo __('※1度審査申請されますと変更することができませんのでご注意下さい。'); ?></span>
				</p>
			</div>

			<hr>

			<div class="btn_center">
				<?php echo $this->Html->link(__('<i class="fa fa-mail-reply mg-r-xs"></i>戻る'), "javascript:toggleForm('dispitem');", array('escape' => false, 'class' => 'btn btn-default btn-sm')); ?>
				<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>確認'), "javascript:postData('dispitem');", array('escape' => false, 'class' => 'btn btn-info btn-sm')); ?>
			</div>

		<?php echo $this->Form->end(); ?>
	</div>
</div>
<!-- ▲ -->

<!-- ▼ アプリストアカテゴリー -->
<div class="frame_main_box box_kage" id="appstore">

	<header class="panel-heading panel-title"><?php echo __('アプリストア(App Store/Google Play)カテゴリーの登録'); ?><span class="hisu"><?php echo __('必須'); ?></span></header>
	<div class="padding10 f_d ta_c lh_15 mt_20">
		<?php echo __('アプリストア掲載時のカテゴリーの設定になります。'); ?>
		<p><span style="color: #900;"><?php echo __('※1度審査申請されますと変更することができませんのでご注意下さい。'); ?></span></p>
	</div>

	<div id="category_result">
		<div class="form-group">
			<label class="form-label"><?php echo __('iPhone1'); ?></label>
			<?php $config = Configure::read('apply_info');?>
			<div class="form-txt_box"><?php echo ($applyInfo['store_category_info']['category_iphone1'])?__($applyInfo['store_category_info']['category_iphone1']):__($config['store_category_info']['category_iphone1']); ?></div>
			<div class="form_hr"></div>
		</div>

		<div class="form-group">
			<label class="form-label"><?php echo __('iPhone2'); ?></label>
			<div class="form-txt_box"><?php echo $applyInfo['store_category_info']['category_iphone2']?__($applyInfo['store_category_info']['category_iphone2']):__($config['store_category_info']['category_iphone2']); ?></div>
			<div class="form_hr"></div>
		</div>

		<div class="form-group">
			<label class="form-label"><?php echo __('Android'); ?></label>
			<div class="form-txt_box"><?php echo $applyInfo['store_category_info']['category_android']?__($applyInfo['store_category_info']['category_android']):$config['store_category_info']['category_android']; ?></div>
			<div class="form_hr"></div>
		</div>

		<div class="button_box">
			<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:toggleForm('category');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
		</div>

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>
	</div>



	<div id="category_form" style="display:none;">


		<div class="form_top"></div>


		<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'registCategory', 'novalidate' => true, 'id' => 'category')); ?>

			<div class="form-group">
				<label for="form_category_iphone1" class="form-label">iPhone１<span class="hisu"><?php echo __('必須'); ?></span></label>
				<div class="select_custom pl_10">
					<?php echo $this->Form->input("category_iphone1", array('type' => 'select', 'options' => Configure::read('applyCategory_iphone'), 'label' => false, 'div' => false, 'class' => 'form-select w_a'));?>
				</div>
				<p class="form-help fml_184"><?php echo __('AppStoreでのメインカテゴリーを選択して下さい。'); ?></p>
				<p class="error fml_184"></p>
			</div>

			<div class="form-group">
				<label for="form_category_iphone2" class="form-label">iPhone２<span class="nin"><?php echo __('任意'); ?></span></label>
				<div class="select_custom pl_10">
					<?php echo $this->Form->input("category_iphone2", array('type' => 'select', 'options' => Configure::read('applyCategory_iphone'), 'label' => false, 'div' => false, 'class' => 'form-select w_a'));?>
				</div>
				<p class="form-help fml_184 mr_15"><?php echo __('AppStoreでのサブカテゴリーを選択して下さい。'); ?><br>
					<?php echo __('ない場合は、メインカテゴリーと同じものを選択して下さい。'); ?></p>
					<p class="error fml_184"></p>
				</div>

				<div class="form-group">
					<label for="form_category_android" class="form-label">Android<span class="hisu"><?php echo __('必須'); ?></span></label>
					<div class="select_custom pl_10">
						<?php echo $this->Form->input("category_android", array('type' => 'select', 'options' => Configure::read('applyCategory_iphone'), 'label' => false, 'div' => false, 'class' => 'form-select w_a'));?>
					</div>
					<p class="form-help fml_184"><?php echo __('GooglePlayでのカテゴリーを選択して下さい。'); ?></p>
					<p class="error fml_184"></p>
				</div>

				<hr>

				<div class="form-group ml_70">
					<p class="form-help mr_15 ml_0 mt_10">
						<span style="color: #900;"><?php echo __('※1度審査申請されますと変更することができませんのでご注意下さい。'); ?></span>
					</p>
				</div>

				<hr>

				<div class="btn_center">
					<?php echo $this->Html->link(__('<i class="fa fa-mail-reply mg-r-xs"></i>戻る'), "javascript:toggleForm('category');", array('escape' => false, 'class' => 'btn btn-default btn-sm')); ?>
					<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>確認'), "javascript:postData('category');", array('escape' => false, 'class' => 'btn btn-info btn-sm')); ?>
				</div>


		<?php echo $this->Form->end(); ?>

	</div>
</div>
<!-- ▲ -->

<!-- ▼ 検索キーワード -->
<div class="frame_main_box box_kage" id="keyword">

	<header class="panel-heading panel-title"><?php echo __('検索キーワードの登録'); ?><span class="nin"><?php echo __('任意'); ?></span></header>

	<div id="searchword_result">

		<div class="padding10 f_d ta_c lh_15 mt_20">
			<?php echo __('App Store (iOSアプリストア)での、検索キーワードになります。'); ?>
			<br />
			<?php echo __('半角カンマ「,」区切りで、複数指定が可能です。'); ?><br />
			<br />
			<?php echo __('アプリと関係無いキーワードを設定されますと、審査を通らないことがございますのでご注意下さい。'); ?>
			<p><span style="color: #900;"><?php echo __('※1度審査申請されますと変更することができませんのでご注意下さい。'); ?></span></p>
		</div>

		<div class="form-group">
			<label class="form-label"><?php echo __('検索キーワード'); ?></label>
			<div class="form-txt_box"><?php echo $applyInfo['keyword']; ?></div>
		</div>

		<div class="button_box">
			<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:toggleForm('searchword');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
		</div>

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>
	</div>

	<div id="searchword_form" style="display:none;">

		<div class="form_top"></div>

		<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'registKeyword', 'novalidate' => true, 'id' => 'searchword')); ?>

			<div class="form-group">
				<label for="form_keyword" class="form-label"><?php echo __('キーワード');?><spna class="nin"><?php echo __('任意');?></spna></label>
				<div class="ml_15">
					<?php echo $this->Form->input("keyword", array('class' => 'form-txt w_a', 'type' => 'text', 'label' => false, 'placeholder' => '')); ?>
				</div>
				<p class="form-help fml_184 mr_15">
					<?php echo __('AppStoreでの、検索キーワードになります。'); ?><br>
					<?php echo __('半角カンマ「,」区切りで、複数指定が可能です。'); ?><br><br>
					<?php echo __('アプリと関係無いキーワードを設定されますと、審査を通らないことがございますのでご注意下さい。'); ?><br>
					<span style="color: #900;"><?php echo __('※1度審査申請されますと変更することができませんのでご注意下さい。'); ?></span>
				</p>
				<p class="error"></p>
				<div class="form_hr"></div>
			</div>

			<hr>

			<div class="btn_center">
				<?php echo $this->Html->link(__('<i class="fa fa-mail-reply mg-r-xs"></i>戻る'), "javascript:toggleForm('searchword');", array('escape' => false, 'class' => 'btn btn-default btn-sm')); ?>
				<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>確認'), "javascript:postData('searchword');", array('escape' => false, 'class' => 'btn btn-info btn-sm')); ?>
			</div>

		<?php echo $this->Form->end(); ?>
	</div>

</div>
<!-- ▲ -->

<!-- ▼ スクリーンショット1 -->
<div class="frame_main_box box_kage" id="screenshot_learge">

	<header class="panel-heading panel-title"><?php echo __('スクリーンショット１の登録'); ?><span class="nin"><?php echo __('任意'); ?></span></header>
	<div class="padding10 f_d ta_c lh_15 mt_20">
		<?php echo __('iPhone5/5S、および、Android用のスクリーンショットの設定になります。'); ?><br />
		<?php echo __('推奨サイズは、640px × 1136pxサイズになります。'); ?><br />
		<?php echo __('透過指定されていますと、透過部分が黒くなりますのでご注意下さい。'); ?><br />
		<br />
		<?php echo __('各コンテンツの左上部にありますプレビュー画面を活用して下さい。'); ?><br />
		<?php echo __('アプリと関係無い画像、アプリの画面が表示されていない画像を設定されますと'); ?><br />
		<?php echo __('審査を通らないことがございますのでご注意下さい。'); ?>

		<p><span style="color: #900;"><?php echo __('※1度審査申請されますと変更することができませんのでご注意下さい。'); ?></span></p>
	</div>


	<?php foreach($applyInfo['screenshot_learge'] as $key => $value) { ?>

		<?php echo $this->Form->create(false, array('type' => 'file', 'action' => 'registScreenShot', 'novalidate' => true, 'id' => $key)); ?>
		<?php echo $this->Form->input('image_key', array('type' => 'hidden', 'value' => $key)); ?>
		<?php echo $this->Form->input('image_type', array('type' => 'hidden', 'value' => 'screenshot_learge')); ?>
		<?php
		if(!empty($value) && $value != '') {
			echo $this->Form->input('image_id', array('type' => 'hidden', 'value' => $value));
		}
		?>
		<div id="<?php echo $key; ?>_result">
			<div class="form-group clearfix">
				<div class="dn_pc"><span class="uniqlo-font store_pic_number">&nbsp;</span></div>
				<label class="form-label no-hand ta_l di">
					<?php
						if(!empty($value) && $value != '') {
							echo $this->Html->image("/media/image/{$value}", array('class' => 'path-img-store-screenshot', 'alt' => __('スクリーンショット２')));
						} else {
							echo $this->Html->image("/img/common/noimage/noimage_screen_shot.png", array('class' => 'path-img-store-screenshot', 'alt' => __('スクリーンショット２')));
						}
					?>
				</label>

				<div class="di fr ta_r mr_15 mt_70">
					<?php //echo $this->Html->link(__('<i class="fa fa-trash-o mg-r-xs"></i>削除'), array('controller' => 'Apply', 'action' => 'deleteScreenShot', '?' => array('key' => $key, 'type' => 'screenshot_learge')), array('escape' => false, 'class' => 'btn btn-danger btn-sm')); ?>
					<a class="btn btn-danger btn-sm" onclick="if (confirm('<?php echo __("本当に削除してもよろしいですか？")?>')) { document.location.href='/Apply/deleteScreenShot?key=<?php echo $key?>&type=screenshot_learge'; } event.returnValue = false; return false;" href="#"><?php echo __('<i class="fa fa-trash-o mg-l-xs"></i>削除')?></a>
					<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:toggleForm('{$key}');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>

				</div>

			</div>
		</div>

		<div id="<?php echo $key; ?>_form" style="display:none;">
			<div class="form-group ml_70">
				<div>
					<label class="form-label no-hand ml_70 pr_15">
						<?php
							if(!empty($value) && $value != '') {
								echo $this->Html->image("/media/image/{$value}", array('width' => 160, 'height' => 284, 'class' => 'con_img wau', 'alt' => '', 'id' => $key . '_viewer'));
							} else {
								echo $this->Html->image("/img/common/noimage/noimage_screen_shot.png", array('width' => 160, 'height' => 284, 'class' => 'con_img wau', 'alt' => '', 'id' => $key . '_viewer'));
							}
						?>
					</label>
					<div class="form_hr"></div>
				</div>

				<label for="upload" class="form-label wau ml_0"><?php echo __('画像の選択'); ?><span class="hisu"><?php echo __('必須'); ?></span></label>
				<div class="upload_wrapper">
					<div class="upload_btn"><?php echo __('ファイルを選択'); ?></div>
					<?php echo $this->Form->file("image", array('class' => 'wau pt_10 ImageSelect', 'label' => false, 'pos' => $key . '_viewer')); ?>
				</div>

				<p class="form-help mr_15 ml_0 mt_10">
					<?php echo __('ファイルサイズ：3MBまで'); ?><br>
					<?php echo __('640px x 1136px 以上の大きさを推奨'); ?><br>
					<?php echo __('透過指定されていますと、透過部分が黒くなりますのでご注意下さい。'); ?>
				</p>
			</div>

			<hr>

			<div class="btn_center">
				<?php echo $this->Html->link(__('<i class="fa fa-mail-reply mg-r-xs"></i>戻る'), "javascript:toggleForm('{$key}');", array('escape' => false, 'class' => 'btn btn-default btn-sm')); ?>
				<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>確認'), "javascript:postData('{$key}');", array('escape' => false, 'class' => 'btn btn-info btn-sm')); ?>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
	<?php } ?>


	<div class="frame_bottom_box">
		<div class="padding10"></div>
	</div>

</div>
<!-- ▲ -->

<!-- ▼ スクリーンショット2 -->
<div class="frame_main_box box_kage" id="screenshot_small">

	<header class="panel-heading panel-title"><?php echo __('スクリーンショット２の登録'); ?><span class="nin"><?php echo __('任意'); ?></span></header>
	<div class="padding10 f_d ta_c lh_15 mt_20">
		<?php echo __('iPhone4/4S用のスクリーンショットの設定になります。'); ?><br />
		<?php echo __('推奨サイズは、640px × 960pxサイズになります。'); ?><br />
		<?php echo __('透過指定されていますと、透過部分が黒くなりますのでご注意下さい。'); ?><br />
		<br />
		<?php echo __('各コンテンツの左上部にありますプレビュー画面を活用して下さい。'); ?><br />
		<?php echo __('アプリと関係無い画像、アプリの画面が表示されていない画像を設定されますと'); ?><br />
		<?php echo __('審査を通らないことがございますのでご注意下さい。'); ?>
		<p><span style="color: #900;"><?php echo __('※1度審査申請されますと変更することができませんのでご注意下さい。'); ?></span></p>
	</div>



	<?php foreach($applyInfo['screenshot_small'] as $key => $value) { ?>

		<?php echo $this->Form->create(false, array('type' => 'file', 'action' => 'registScreenShot', 'novalidate' => true, 'id' => $key)); ?>
		<?php echo $this->Form->input('image_key', array('type' => 'hidden', 'value' => $key)); ?>
		<?php echo $this->Form->input('image_type', array('type' => 'hidden', 'value' => 'screenshot_small')); ?>
		<?php
		if(!empty($value) && $value != '') {
			echo $this->Form->input('image_id', array('type' => 'hidden', 'value' => $value));
		}
		?>

		<div id="<?php echo $key; ?>_result">
			<div class="form-group clearfix">

				<div class="dn_pc"><span class="uniqlo-font store_pic_number">&nbsp;</span></div>
				<label class="form-label no-hand ta_l di">
					<?php
						if(!empty($value) && $value != '') {
							echo $this->Html->image("/media/image/{$value}", array('class' => 'path-img-store-screenshot', 'alt' => __('スクリーンショット２')));
						} else {
							echo $this->Html->image("/img/common/noimage/noimage_screen_shot2.png", array('class' => 'path-img-store-screenshot', 'alt' => __('スクリーンショット２')));
						}
					?>
				</label>

				<div class="di fr ta_r mr_15 mt_70">

					<?php //echo $this->Html->link(__('<i class="fa fa-trash-o mg-r-xs"></i>削除'), array('controller' => 'Apply', 'action' => 'deleteScreenShot', '?' => array('key' => $key, 'type' => 'screenshot_small')), array('escape' => false, 'class' => 'btn btn-danger btn-sm')); ?>
					<a class="btn btn-danger btn-sm" onclick="if (confirm('<?php echo __("本当に削除してもよろしいですか？")?>')) { document.location.href='/Apply/deleteScreenShot?key=<?php echo $key?>&type=screenshot_small'; } event.returnValue = false; return false;" href="#"><?php echo __('<i class="fa fa-trash-o mg-l-xs"></i>削除')?></a>
					<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:toggleForm('{$key}');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>

				</div>

				<div class="form_hr"></div>
				<hr>
			</div>
		</div>


		<div id="<?php echo $key; ?>_form" style="display:none;">
			<div class="form-group ml_70">
				<div>
					<label class="form-label no-hand ml_70 pr_15">
						<?php
							if(!empty($value) && $value != '') {
								echo $this->Html->image("/media/image/{$value}", array('width' => 160, 'height' => 284, 'class' => 'con_img wau', 'alt' => '', 'id' => $key . '_viewer'));
							} else {
								echo $this->Html->image("/img/common/noimage/noimage_screen_shot.png", array('width' => 160, 'height' => 284, 'class' => 'con_img wau', 'alt' => '', 'id' => $key . '_viewer'));
							}
						?>
					</label>
					<div class="form_hr"></div>
				</div>

				<label for="upload" class="form-label wau ml_0"><?php echo __('画像の選択'); ?><span class="hisu"><?php echo __('必須'); ?></span></label>
				<div class="upload_wrapper">
					<div class="upload_btn"><?php echo __('ファイルを選択'); ?></div>
					<?php echo $this->Form->file("image", array('class' => 'wau pt_10 ImageSelect', 'label' => false, 'pos' => $key . '_viewer')); ?>
				</div>

				<p class="form-help mr_15 ml_0 mt_10">
					<?php echo __('ファイルサイズ：3MBまで'); ?><br>
					<?php echo __('640px x 1136px 以上の大きさを推奨'); ?><br>
					<?php echo __('透過指定されていますと、透過部分が黒くなりますのでご注意下さい。'); ?>
				</p>
			</div>

			<hr>

			<div class="btn_center">
				<?php echo $this->Html->link(__('<i class="fa fa-mail-reply mg-r-xs"></i>戻る'), "javascript:toggleForm('{$key}');", array('escape' => false, 'class' => 'btn btn-default btn-sm')); ?>
				<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>確認'), "javascript:postData('{$key}');", array('escape' => false, 'class' => 'btn btn-info btn-sm')); ?>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
	<?php } ?>



	<div class="frame_bottom_box">
		<div class="padding10"></div>
	</div>

</div>
<!-- ▲ -->

<?php echo $this->Html->scriptStart(array('inline' => false)) ?>

	function postData(id) {
		$('#' + id).submit();
	}

	function toggleForm(target) {
		$('#' + target + '_result').toggle();
		$('#' + target + '_form').toggle();
	}

	$(function () {
		$('.ImageSelect').on('change', function() {
			if (! this.files.length) {
				return;
			}

			var file = this.files[0];
			if (! file.type.match('image.*')) {
				alert('<?php echo __('画像を選択してください'); ?>');
				return;
			}

			if (! file.size > (3 * 1024 * 1024)) {
				alert('<?php echo __('サイズが大きすぎます'); ?>');
				return;
			}

			pos = $(this).attr('pos');
			var reader = new FileReader();
			reader.onload = (function(theFile) {
				return function(e) {
					$('#' + pos).each(function() {
						$(this).attr('src', e.target.result);
					});
				};
			})(file);

			reader.readAsDataURL(file);
		});

		$("#dispitem").validate({
			messages: {
			}
		});

	});

<?php echo $this->Html->scriptEnd(); ?>
