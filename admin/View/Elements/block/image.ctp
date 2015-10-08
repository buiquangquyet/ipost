<div id="image" class="button_item"><!-- ▼ トップイメージリスト -->
	<div class="frame_main_box box_kage">
		<div class="c"></div>

		<header class="panel-heading panel-title"><?php echo __('イメージリストブロック'); ?></header>
		<div class="form_top"></div>

		<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'enable', 'novalidate' => true, 'id' => 'image_enable')); ?>
		<div class="form-group">
			<label for="form_enable" class="form-label"><?php echo __('表示'); ?></label>
			<div class="checkbox_box">
				<?php echo $this->Form->input("Block.image.del", array('type' => 'radio', 'options' => Configure::read('BlockDisp'), 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;margin-left:30px;margin-top:8px;', 'onchange' => 'postData("image_enable")')); ?>
			</div>
			<p class="form-help fml_184"><?php echo __('お客様に見せるかどうかを選ぶことができます。'); ?></p>
			<div class="form_hr"></div>
		</div>
		<?php echo $this->Form->end(); ?>

		<!-- ▼ イメージリスト -->
		<div class="form-group">
			<ul>
			<?php foreach($Block['image']['images'] as $key => $imageInfo) { ?>
				<?php echo $this->Form->create(false, array('type' => 'file', 'action' => 'regist', 'novalidate' => true, 'id' => 'image_' . $key)); ?>
				<?php echo $this->Form->input("Block.image.images.{$key}.image_type", array('type' => 'hidden', 'value' => $imageInfo['image_type'])); ?>
				<?php echo $this->Form->input("Block.image.images.{$key}.link_type", array('type' => 'hidden', 'value' => $imageInfo['link_type'])); ?>

				<li id='image_result_<?php echo $key; ?>' class="sort_box clearfix">
					<span class="uniqlo-font top_pic_number"><?php echo $key + 1; ?></span>
					<label class="form-label no-hand">
						<?php
							if ($imageInfo['image_type'] != '3') {
								if(!empty($imageInfo['image']) && $imageInfo['image'] != '') {
									echo $this->Html->image("/media/image/{$imageInfo['image']}", array('class' => 'path-img-block-imglist', 'alt' => __('メニュートップ画像')));
								} else {
									echo $this->Html->image("/img/common/noimage/noimage_menu_news.png", array('class' => 'path-img-block-imglist', 'alt' => __('メニュートップ画像')));
								}
							} else {
								echo $this->Html->link(__('Youtubeへリンクされています。'), $imageInfo['youtube'], array('escape' => false, 'class' => 'btn btn-info btn-sm', 'style' => 'margin-top:30px;', 'target' => '_blank'));
							}
						?>
					</label>
					<div class="fr">
						<div class="top-right-box-date">
							<i class="fa fa-clock-o mg-r-xs"></i>
							<?php //echo $imageInfo['date'];?>
							<?php
							$lang = Configure::read('Config.language');
							if($lang=='jpn' || $lang=='jp' || $lang=='ja') {
								$y = str_replace('年', __('年'), $imageInfo['date']);
								$m = str_replace('月', __('月'), $y);
								$d = str_replace('日', __('日'), $m);
							} else {
								$y = str_replace('年', '/', $imageInfo['date']);
								$m = str_replace('月', '/', $y);
								$d = str_replace('日', '', $m);
							}
							echo $d;
							?>
						</div>

						<div class="form-group top-right-box">
							<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:toggleForm('image', {$key});", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
							<?php //echo $this->Html->link(__('<i class="fa fa-trash-o mg-l-xs"></i>削除'), array('action' => 'deleteImage', '?' => array('id' => $key)), array('escape' => false, 'class' => 'btn btn-danger btn-sm')); ?>
							<a class="btn btn-danger btn-sm" onclick="if (confirm('<?php echo __("本当に削除してもよろしいですか？")?>')) { document.location.href='/block/deleteImage?id=<?php echo $key?>'; } event.returnValue = false; return false;" href="#"><?php echo __('<i class="fa fa-trash-o mg-l-xs"></i>削除')?></a>
						</div>
						<div class="form_hr"></div>
					</div>
				</li>

				<hr>

				<div id='image_form_<?php echo $key; ?>' style="display:none;">

					<?php if($key == 0) { ?>
						<!-- 先頭のみ表示 -->
						<p class="ta_c f_d"><?php echo __('画像、もしくはYoutube動画を任意で登録することが出来ます。'); ?></p>
						<div class="regist_button_box clearfix">

							<input type="button" value="<?php echo __('画像を登録する'); ?>" onclick="toggleLinkTypeForm('1', <?php echo $key; ?>)" class="btn btn-default btn-sm mr_5">
							<input type="button" value="<?php echo __('Youtube動画を登録する'); ?>" onclick="toggleLinkTypeForm('3', <?php echo $key; ?>)" class="btn btn-default btn-sm wau">

						</div>
						<br>

						<!-- Youtube指定 -->
						<div id="image_ext_3_<?php echo $key; ?>">
							<hr>
							<div class="form-group">
								<label for="form_youtube" class="form-label">Youtube<span class="nin"><?php echo __('任意'); ?></span></label>
								<?php echo $this->Form->input("Block.image.images.{$key}.youtube", array('type' => 'text', 'class' => 'form-txt form-5', 'placeholder' => 'https://www.youtube.com/ XXXXX', 'label' => false)); ?>
								<div class="form_hr"></div>
							</div>
						</div>
						<!-- ▲ -->
					<?php } ?>

					<!-- ▼ 画像アップロード -->
					<div id="image_ext_1_<?php echo $key; ?>" <?php if ($key == 0) { ?>style='display:none;' <?php } ?>>
						<hr>
						<div>
							<label id="prev_edit_1" class="form-label no-hand ml_70">
								<?php
									if(!empty($imageInfo['image']) && $imageInfo['image'] != '') {
										echo $this->Html->image("/media/image/{$imageInfo['image']}", array('class' => 'path-img-block-imglist', 'alt' => __('メニュートップ画像'), 'id' => 'ImageViewer_' . $key));
									} else {
										echo $this->Html->image("/img/common/noimage/noimage_menu_news.png", array('class' => 'path-img-block-imglist', 'alt' => __('メニュートップ画像'), 'id' => 'ImageViewer_' . $key));
									}
								?>
							</label>
							<div class="form_hr"></div>
						</div>

						<div class="form-group ml_70">
							<label for="upload" class="form-label wau ml_0"><?php echo __('画像の選択'); ?><span class="nin"><?php echo __('任意'); ?></span></label>

							<?php echo $this->Form->file("Block.image.images.{$key}.image", array('class' => 'wau pt_10 ImageSelect', 'label' => false, 'pos' => $key)); ?>

							<p class="form-help">
							<?php echo __('ファイルサイズ：3MBまで<br>640px&nbsp;×&nbsp;350px&nbsp;以上の大きさを推奨'); ?>
							<br />
							<?php echo __('お好きなURL、もしくはアプリ内の他ページへのリンクを任意で設定することが出来ます。'); ?></p>
							<div class="form_hr"></div>
						</div>

						<!-- ▼ 画像リンクの設定 -->

						<div class="regist_button_box clearfix">
							<input type="button" value="<?php echo __('設定しない'); ?>" onclick="toggleInputForm('0', <?php echo $key; ?>)" class="btn btn-default btn-sm mr_5">
							<input type="button" value="<?php echo __('URLを設定する'); ?>" onclick="toggleInputForm('1', <?php echo $key; ?>)" class="btn btn-default btn-sm mr_5">
							<input type="button" value="<?php echo __('アプリ内リンクを設定する'); ?>" onclick="toggleInputForm('2', <?php echo $key; ?>)" class="btn btn-default btn-sm wau">
						</div>

						<!--なしの場合-->
						<div id="slide_0_<?php echo $key; ?>">
							<hr>
							<div class="form-group">
								<label for="form_youtube" class="form-label"></label>
								<label for="form_youtube" class="form-label label-youtube"><?php echo __('リンク設定：なし'); ?></label>
								<div class="form_hr"></div>
							</div>
						</div>

						<!--URLの場合-->
						<div id="slide_1_<?php echo $key; ?>">
							<hr>
							<div class="form-group">
								<label for="form_youtube" class="form-label">URL</label>
								<?php echo $this->Form->input("Block.image.images.{$key}.url", array('type' => 'text', 'class' => 'form-txt form-5', 'placeholder' => __('例：http://www.hiropro.co.jp/'), 'label' => false)); ?>
								<div class="form_hr"></div>
							</div>
						</div>

						<!--アプリ内リンクの場合-->
						<div id="slide_2_<?php echo $key; ?>">

							<hr>
							<label for="form_enable" class="form-label"><?php echo __('アプリ内リンク'); ?></label>
							<div class="select_custom">
								<?php echo $this->Form->input("Block.image.images.{$key}.link_app", array('type' => 'select', 'options' => Configure::read('BlockAppLink'), 'label' => false, 'div' => false, 'class' => 'form-select', 'onChange' => "changeCoupon({$key})"));?>
							</div>
						</div>

						<!-- ▲ 画像リンクの設定 -->
					</div>
					<!-- ▲ -->

					<div class="button_box">
						<?php echo $this->Html->link(__('<i class="fa fa-mail-reply mg-r-xs"></i>戻る'), "javascript:toggleForm('image', {$key});", array('escape' => false, 'class' => 'btn btn-default btn-sm')); ?>
						<?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:postData('image_{$key}');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
					</div>
					<hr>
				</div>
				<?php echo $this->Form->end(); ?>

			<?php } ?>
			</ul>
		</div>

		<div class="button_box mt_20">
			<?php echo $this->Html->link('<i class="fa fa-chevron-up"></i>', array('action' => 'movePos', '?' => array('target' => 'image', 'type' => 'forward')), array('class' => 'btn btn-default btn-sm up', 'escape' => false)); ?>
			<?php echo $this->Html->link('<i class="fa fa-chevron-down"></i>', array('action' => 'movePos','?' => array('target' => 'image', 'type' => 'backword')), array('class' => 'btn btn-default btn-sm down', 'escape' => false)); ?>
		</div>

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>
	</div>
</div>
<!-- ▲ -->


<?php echo $this->Html->scriptStart(array('inline' => false)) ?>

function toggleInputForm(targetForm, id) {

	formName = ['0', '1', '2']; //0 なし 1 URL 2 APPLINK

	for(i=0; i< formName.length; i++) {
		if (targetForm == formName[i]) {
			$('#slide_' + formName[i] + '_' + id).show();
			$("[name='data[Block][image][images][" + id + "][link_type]']").val(formName[i]);
		} else {
			$('#slide_' + formName[i] + '_' + id).hide();
		}
	}
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
				$('#ImageViewer_' + pos).each(function() {
					$(this).attr('src', e.target.result);
				});
			};
		})(file);

		reader.readAsDataURL(file);
	});
});

function toggleLinkTypeForm(targetForm, id) {

	formName = ['0', '1', '3']; //0 なし 1 URL 3 YOUTUBE

	for(i=0; i< formName.length; i++) {
		if (targetForm == 0) {
			$('#image_ext_1_' + id).show();
			$('#image_ext_3_' + id).hide();
			$("[name='data[Block][image][images][" + id + "][image_type]']").val(1);
		} else if (targetForm == formName[i]) {
			$('#image_ext_' + formName[i] + '_' + id).show();
			$("[name='data[Block][image][images][" + id + "][image_type]']").val(formName[i]);
		} else {
			$('#image_ext_' + formName[i] + '_' + id).hide();
		}
	}
}

$(document).ready(function(){
	<?php foreach($Block['image']['images'] as $key => $imageInfo) { ?>
	toggleLinkTypeForm('<?php echo $imageInfo['image_type']; ?>', <?php echo $key; ?>);
	toggleInputForm('<?php echo $imageInfo['link_type']; ?>', <?php echo $key; ?>);
	<?php } ?>
});

<?php echo $this->Html->scriptEnd(); ?>