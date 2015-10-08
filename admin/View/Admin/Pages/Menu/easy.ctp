<!-- ▼ メニュートップ画像の変更 -->
<div class="frame_main_box box_kage">

	<header class="panel-heading panel-title"><?php echo __('メニュートップ画像の変更'); ?></header>

	<div class="frame_main_box box_kage">
		<div id="menu_top">

			<div class="form-group center_box">
				<label class="form-label no-hand p84"> <span id="prev_top_image">
				<?php
					if(!empty($menuTop['MenuTopItem']['image_id']) && $menuTop['MenuTopItem']['image_id'] != '') {
						echo $this->Html->image("/media/image/{$menuTop['MenuTopItem']['image_id']}");
					} else {
						echo $this->Html->image("/img/common/noimage/noimage_menutop.png");
					}
				?>

	        </span>
				</label>
				<div class="form_hr"></div>
			</div>

			<div class="button_box">
				<button type="button" class="btn btn-warning btn-sm mt_10" onclick="ajaxShowTopImageForm();">
					<i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></button>
			</div>

			<div class="c10"></div>

		</div>

		<!-- ▼▼ 入力フォーム -->
		<div id="menu_top_form" style="display: none;">

			<?php echo $this->Form->create(false, array('id' => 'menu_top_image','type' => 'file', 'action' => 'menu_top_add', 'novalidate' => true)); ?>

				<div class="form-group">
					<label id='prev_tmp_top_image' class="form-label no-hand ml_96">
					<center>
						<?php
							if(!empty($menuTop['MenuTopItem']['image_id']) && $menuTop['MenuTopItem']['image_id'] != '') {
								echo $this->Html->image("/media/image/{$menuTop['MenuTopItem']['image_id']}", array('class' => 'avatar avatar-sm2', 'id' => 'ImageViewer_top'));
							} else {
								echo $this->Html->image("/img/common/noimage/noimage_menutop.png", array('class' => 'avatar avatar-sm2', 'id' => 'ImageViewer_top'));
							}
						?>
						</center>
					</label>
					<div class="form_hr"></div>
				</div>

				<div class="form-group">
					<label for="upload" class="form-label"><?php echo __('画像の選択'); ?></label>

					<!--
					<input type="file" name="upload" id="upload" class="wau pt_10"
						onchange="ajaxUploadTopImage();">
					-->

					<?php echo $this->Form->file("image", array('class' => 'wau pt_10 ImageSelect', 'label' => false, 'pos' => 'top')); ?>
					<?php echo $this->Form->input("type", array('type' => 'hidden', 'value' => 'nomal')); ?>

					<p class="form-help fml_184"><?php echo __('ファイルサイズ：3MBまで'); ?><br />
					<?php echo __('640px&nbsp;×&nbsp;350px&nbsp;以上の大きさを推奨'); ?></p>
				</div>

				<div class="form_hr"></div>

			</form>

			<hr />

			<div class="btn_center">

					<a href="javascript:void(0);" class="btn btn-default btn-sm"
						onclick="ajaxHideTopImageForm();"><i
						class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る'); ?></a> <a
						href="javascript:void(0);" class="btn btn-warning btn-sm"
						onclick="ajaxRegistTopImage();"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></a>

			</div>

			<?php echo $this->Form->end(); ?>

		</div>
		<!-- ▲▲ -->

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>

	</div>
	<!-- ▲ -->

	<!-- ▼ 商品の新規登録 -->
	<div class="frame_main_box box_kage">

		<header class="panel-heading panel-title"><?php echo __('商品の新規登録'); ?></header>
		<div class="form_top"></div>

		<div id='menu_item_new'>
			<div class="button_box">
				<a href="javascript:void(0);" class="btn btn-warning btn-sm"
					onclick="ajaxShowNewItemForm();"><i class="fa fa-plus mg-r-xs"></i><?php echo __('商品の新規登録'); ?></a>
			</div>
		</div>

		<!-- ▼▼ 入力フォーム -->
		<div id="menu_item_form_new" style="display: none;">

			<hr />

    <?php echo $this->Form->create(false, array('id' => 'item_top_form_new','type' => 'file', 'action' => 'easy_content_add', 'novalidate' => true)); ?>

			<div class="form-group">
				<center>
				<?php echo $this->Html->image("/img/common/noimage/noimage_menutop.png", array('class' => 'avatar avatar-sm2', 'id' => 'ImageViewer_new')); ?>
				</center>


				<label for="upload" class="form-label"><?php echo __('画像の選択'); ?><span
					class="nin"><?php echo __('任意'); ?></span></label>

					<!--
					<input type="file" name="upload" id="upload" class="wau pt_10" onchange="ajaxUploadNewItemImage();">
					-->
					<?php echo $this->Form->file("image", array('class' => 'wau pt_10 ImageSelect', 'label' => false, 'pos' => 'new')); ?>
					<?php echo $this->Form->input("type", array('type' => 'hidden', 'value' => 'nomal')); ?>

				<p class="form-help fml_184"><?php echo __('ファイルサイズ：3MBまで'); ?><br /><?php echo __('640px&nbsp;×&nbsp;350px&nbsp;以上の大きさを推奨'); ?></p>
				<div class="form_hr"></div>
			</div>

			<!--
			</form>
			-->

			<hr />

      <input type="hidden" name="parent_id" value="0">

			<div class="form-group">
				<label for="form_title" class="form-label"><?php echo __('商品名'); ?><span
					class="hisu"><?php echo __('必須'); ?></span></label> <input
					type="text" class="form-txt form-6"
					placeholder="<?php echo __('商品名の入力'); ?>" required="required"
					id="form_title" name="title" value="" />
				<p class="form-help fml_184"><?php echo __('推奨文字数：約全角22文字'); ?></p>
				<div class="form_hr"></div>
			</div>

			<div class="form-group">
				<label for="form_price" class="form-label"><?php echo __('価格'); ?>
				<span class="nin"><?php echo __('任意'); ?></span></label>
				<input type="text" class="form-txt form-5" placeholder="<?php echo __('価格の入力'); ?>" id="form_price" name="price" value="" />
				<select name="currency" class="form-txt currency">
				<?php $lang = Configure::read('Config.language');?>
				  <option value="JPY" <?php if($lang=='jp' || $lang=='jpn' || $lang=='ja') {echo 'selected="selected"';} else {}?>>JPY</option>
				  <option value="USD" <?php if($lang=='en' || $lang=='eng') {echo 'selected="selected"';} else {}?>>USD</option>
				  <option value="VND" <?php if($lang=='vi' || $lang=='vie') {echo 'selected="selected"';} else {}?>>VND</option>
				</select>
				<p class="form-help fml_184"><?php echo __('未入力、または0を入力で商品価格の非表示がされます。'); ?></p>
				<div class="form_hr"></div>
			</div>
			<div class="form-group">
				<label for="form_sub_title" class="form-label"><?php echo __('一覧説明'); ?><span
					class="nin"><?php echo __('任意'); ?></span></label> <input
					type="text" class="form-txt form-6"
					placeholder="<?php echo __('一覧時の説明文を入力'); ?>" id="form_sub_title"
					name="sub_title" value="" />
				<p class="form-help fml_184"><?php echo __('商品一覧時に表示される補足説明になります。'); ?><br><?php echo __('推奨文字数：約全角22文字'); ?></p>
				<div class="form_hr"></div>
			</div>

			<div class="form-group">
				<label for="form_description" class="form-label"><?php echo __('商品説明'); ?><span
					class="hisu"><?php echo __('必須'); ?></span></label>
				<textarea class="form-description form-txt form-textarea"
					required="required" id="form_description" name="description"></textarea>
				<p class="form-help fml_184"><?php echo __('商品の詳細画面で表示される説明文になります。'); ?></p>
				<div class="form_hr"></div>
			</div>

			<div class="form-group">
				<label for="form_enable" class="form-label"><?php echo __('表示'); ?><span
					class="nin"><?php echo __('任意'); ?></span></label>
				<div class="checkbox_box">

					<input type="radio" name="enable" value="1" checked="checked" ><?php echo __('表示する'); ?>
					<br/>
					<input type="radio" name="enable" value="0" ><?php echo __('表示しない'); ?>
				</div>
				<p class="form-help fml_184"><?php echo __('アプリに表示させるかどうかを選ぶことができます。'); ?></p>
				<div class="form_hr"></div>
			</div>

			<hr />

			<div class="btn_center">
				<a href="javascript:void(0);" class="btn btn-default btn-sm"
					onclick="ajaxHideNewItemForm();"><i
					class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る'); ?></a> <a
					href="javascript:void(0);" class="btn btn-warning btn-sm"
					onclick="ajaxRegistItem();"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></a>
			</div>

    <?php echo $this->Form->end(); ?>

  </div>
		<!-- ▲▲ -->

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>

	</div>
	<!-- ▲ -->

	<!-- ▼ 新メニュー一覧▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼ -->
	<div id="category_insert">
		<div class="frame_main_box box_kage content">

			<header class="panel-heading panel-title"><?php echo __('メニュー一覧'); ?></header>
			<div class="form_top"></div>

<?php foreach($menuItems as $item) { ?>
			<!-- ▼▼ メニュー内容表示 -->
			<div id="item_box_<?php echo($item['MenuItem']['id']);?>">
				<div class="cate_box"
					id="cate_box_<?php echo($item['MenuItem']['id']);?>">
					<div class="cate_list_top"
						id="menu_item_<?php echo($item['MenuItem']['id']);?>">

						<div class="ctl_box">
							<div class="oya_img">
								<?php
									if(!empty($item['MenuItem']['image_id']) && $item['MenuItem']['image_id'] != '') {
										echo $this->Html->image("/media/image/{$item['MenuItem']['image_id']}");
									} else {
										echo $this->Html->image("/img/common/noimage/noimage_menutop.png");
									}
								?>
							</div>
						</div>

						<div class="ctr_box">

							<h2>
								<i class="fa fa-circle c_gri"></i>&nbsp; <span
									id="item_title_<?php echo($item['MenuItem']['id']);?>"><?php echo($item['MenuItem']['title']);?></span>
							</h2>

							<div class="cate_txt">
								<span id="item_sub_title_<?php echo($item['MenuItem']['id']);?>"></span>
								<span class="ct_time sm_non fl_n"><i class="fa fa-clock-o"></i>&nbsp;<?php echo __('更新日時:')?><?php echo($item['MenuItem']['modified']);?></span>

								<div class="ct_button">
									<div class="fr">
										<a href="javascript:void(0);" class="btn btn-default btn-sm"
											onclick="ajaxMoveDownItem(<?php echo($item['MenuItem']['id']);?>)">
											<i class="fa fa-chevron-down"></i>
										</a>

									<div style="display: none;">
									 <?php echo $this->Form->create(false, array('id' => 'item_content_vertical_change_'.$item['MenuItem']['id'],'method'=>'POST', 'action' => 'content_vertical_change', 'novalidate' => true)); ?>
										<input type='hidden' name='position'  value='<?php echo($item['MenuItem']['position']);?>'>
										<input type='hidden' name='parent_id' value='<?php echo($item['MenuItem']['parent_id']);?>'>
									 <?php echo $this->Form->end(); ?>
									 </div>


										 <a href="javascript:void(0);" class="btn btn-info btn-sm"
											onclick="ajaxShowUpdateItemForm(<?php echo($item['MenuItem']['id']);?>);">
											<i class="fa fa-edit mg-r-xs"></i>
											<?php echo __('変更'); ?>
										</a> <a href="javascript:void(0);"
											class="btn btn-danger btn-sm"
											onclick="ajaxDeleteItem(<?php echo($item['MenuItem']['id']);?>);">
											<i class="fa fa-trash-o mg-r-xs"></i><?php echo __('削除'); ?>
											</a> <span
											id="category_updown_<?php echo($item['MenuItem']['id']);?>"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ▲▲ -->


			<!-- ▼▼ メニュー内容変更 -->


			<div
				id="menu_item_update_form_<?php echo($item['MenuItem']['id']);?>"
				style="display: none;">

				<?php echo $this->Form->create(false, array('id' => 'item_top_form_edit_'.$item['MenuItem']['id'],'type' => 'file', 'action' => 'easy_content_edit', 'novalidate' => true)); ?>

				<hr>

					<span id="prev_item_<?php echo($item['MenuItem']['id']);?>" class="form-label no-hand ml_70">
							<?php
								if(!empty($item['MenuItem']['image_id']) && $item['MenuItem']['image_id'] != '') {
									echo $this->Html->image("/media/image/{$item['MenuItem']['image_id']}", array('class' => 'avatar avatar-sm2', 'id' => 'ImageViewer_edit'.$item['MenuItem']['id']));
								} else {
									echo $this->Html->image("/img/common/noimage/noimage_menutop.png", array('class' => 'avatar avatar-sm2', 'id' => 'ImageViewer_edit'.$item['MenuItem']['id']));
								}
							?>
					</span>

					<div class="form-group">
						<label for="upload" class="form-label"><?php echo __('画像の選択')?><span class="nin"><?php echo __('任意')?></span></label>

						<?php echo $this->Form->file("image", array('class' => 'wau pt_10 ImageSelect', 'label' => false, 'pos' => 'edit'.$item['MenuItem']['id'])); ?>
						<p class="form-help fml_184">
							<?php echo __('ファイルサイズ：3MBまで')?><br><?php echo __('640px&nbsp;×&nbsp;350px&nbsp;以上の大きさを推奨')?>
						</p>
						<div class="form_hr"></div>
					</div>

				<hr>

					<input type="hidden" name="id" value="<?php echo($item['MenuItem']['id']);?>">
					<input type="hidden" name="parent_id" value="0">

					<div class="form-group">
						<label for="form_title" class="form-label"><?php echo __('商品名')?><span class="hisu"><?php echo __('必須')?></span></label>
						<input type="text" class="form-txt form-6" placeholder="<?php echo __('商品名の入力')?>"
							required="required" id="form_title" name="title"
							value="<?php echo htmlentities($item['MenuItem']['title']);?>">
						<p class="form-help fml_184"><?php echo __('推奨文字数：約全角22文字')?></p>
						<div class="form_hr"></div>
					</div>

					<div class="form-group">
						<label for="form_price" class="form-label"><?php echo __('価格')?><span class="nin"><?php echo __('任意')?></span></label>
						<input type="text" class="form-txt form-5" placeholder="<?php echo __('価格の入力')?>"
							id="form_price" name="price"
							value="<?php echo ($item['MenuItem']['price']);?>">
						<select name="currency" class="form-txt currency">
						<?php $lang = Configure::read('Config.language');?>
						  <option value="JPY" <?php if(isset($item['MenuItem']['currency']) && $item['MenuItem']['currency']=='JPY'){echo 'selected="selected"';} elseif (!isset($item['MenuItem']['currency']) && ($lang=='jp' || $lang=='jpn' || $lang=='ja')) {echo 'selected="selected"';} else {}?>>JPY</option>
						  <option value="USD" <?php if(isset($item['MenuItem']['currency']) && $item['MenuItem']['currency']=='USD'){echo 'selected="selected"';} elseif(!isset($item['MenuItem']['currency']) && ($lang=='en' || $lang=='eng')) {echo 'selected="selected"';} else {}?>>USD</option>
						  <option value="VND" <?php if(isset($item['MenuItem']['currency']) && $item['MenuItem']['currency']=='VND'){echo 'selected="selected"';} elseif(!isset($item['MenuItem']['currency']) && ($lang=='vi' || $lang=='vie')) {echo 'selected="selected"';} else {}?>>VND</option>
						</select>
						<p class="form-help fml_184"><?php echo __('未入力、または0を入力で商品価格の非表示がされます。')?></p>
						<div class="form_hr"></div>
					</div>

					<div class="form-group">
						<label for="form_sub_title" class="form-label"><?php echo __('一覧説明');?><span
							class="nin"><?php echo __('任意')?></span></label> <input type="text"
							class="form-txt form-6" placeholder="<?php echo __('一覧時の説明文を入力')?>"
							id="form_sub_title" name="sub_title"
							value="<?php echo htmlentities($item['MenuItem']['sub_title']);?>">
						<p class="form-help fml_184">
							<?php echo __('商品一覧時に表示される補足説明になります。')?><br><?php echo __('推奨文字数：約全角22文字')?>
						</p>
						<div class="form_hr"></div>
					</div>

					<div class="form-group">
						<label for="form_description" class="form-label"><?php echo __('商品説明')?><span
							class="hisu"><?php echo __('必須')?></span></label>
						<textarea class="form-description form-txt form-textarea"
							required="required" id="form_description" name="description"><?php echo htmlentities($item['MenuItem']['description']);?></textarea>
						<p class="form-help fml_184"><?php echo __('商品の詳細画面で表示される説明文になります。')?></p>
						<div class="form_hr"></div>
					</div>

					<div class="form-group">
						<label for="form_enable" class="form-label"><?php echo __('表示')?><span class="nin"><?php echo __('任意')?></span></label>
						<div class="checkbox_box">
							<!--
							<span class="chec_txt">表示しない</span> <input type="checkbox"
								value="1" name="enable" id="form_enable"
								class="js-switch-green bic " checked="" data-switchery="true"
								style="display: none;"><span class="switchery" id="form_enable"
								name="enable"
								style="border-color: rgb(45, 203, 115); box-shadow: rgb(45, 203, 115) 0px 0px 0px 16px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s; -webkit-transition: border 0.4s, box-shadow 0.4s, background-color 1.2s; background-color: rgb(45, 203, 115);"><small
								style="left: 22px; transition: left 0.2s; -webkit-transition: left 0.2s;"></small></span>
							<span class="chec_txt">表示する</span>
						-->

							<input type="radio" name="enable" value="1"
								<?php if($item['MenuItem']['enable'] == 1){ ?> checked="checked"
								<?php } ?>><?php echo __('表示する')?> <br /> <input type="radio" name="enable"
								value="0" <?php if($item['MenuItem']['enable'] == 0){ ?>
								checked="checked" <?php } ?>><?php echo __('表示しない')?>

						</div>

						<p class="form-help fml_184"><?php echo __('アプリに表示させるかどうかを選ぶことができます。')?></p>
						<div class="form_hr"></div>
					</div>

					<hr>

					<div class="btn_center">
						<a href="javascript:void(0);" class="btn btn-default btn-sm"
							onclick="ajaxHideUpdateItemForm(<?php echo($item['MenuItem']['id']);?>);"><i
							class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る')?></a> <a
							href="javascript:void(0);" class="btn btn-info btn-sm"
							onclick="ajaxUpdateItem(<?php echo($item['MenuItem']['id']);?>);"><i
							class="fa fa-edit mg-r-xs"></i><?php echo __('変更')?></a>
					</div>

					<hr>

				<?php echo $this->Form->end(); ?>

			</div>
			<!-- ▲▲ -->

<?php } ?>

      </div>
	</div>

	<div class="frame_bottom_box">
		<div class="padding10"></div>
	</div>
	<!-- ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲ -->


	<!-- ▼ メニューの利用 ON/OFF -->
	<div class="frame_main_box box_kage">

		<header class="panel-heading panel-title"><?php echo __('メニューの利用 ON/OFF'); ?></header>
		<div class="form_top"></div>

		<center class="f_d">
			<p><?php echo __('現在、メニュー機能を利用中です。利用を停止する場合はボタンを押してください。'); ?></p>
			<p><?php echo __('メニュー機能を停止すると、アプリにメニューが表示されなくなります。'); ?></p>
		</center>

		<div id="menu_off">

			<div class="button_box">
				<a href="./?stop=1" class="btn btn-danger btn-sm"
					onclick="return ajaxStopMenu();"><?php echo __('メニュー機能の利用を停止する'); ?></a>
			</div>

		</div>

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>

	</div>
	<!-- ▲ -->

	<!-- ▼ メニューのリセット -->
	<div class="frame_main_box box_kage">

		<header class="panel-heading panel-title"><?php echo __('メニューのリセット'); ?></header>
		<div class="form_top"></div>

		<center class="f_d">
			<p><?php echo __('メニュー機能をリセットすると、すべてのメニューは消えてしまいますが'); ?></p>
			<p><?php echo __('シンプルタイプ/カスタムタイプの選択からやり直すことが出来ます。ご利用にご注意ください。'); ?></p>
		</center>

		<div id="menu_reset">

			<div class="button_box">
				<a href=".?reset=1" class="btn btn-danger btn-sm"
					onclick="return ajaxResetMenu();"><?php echo __('メニューをリセットする'); ?></a>
			</div>

		</div>

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>

	</div>
	<!-- ▲ -->


	<script type="text/javascript">

/**
 * メニュートップ画像の登録フォーム 表示
 */
function ajaxShowTopImageForm() {
  $('#menu_top').hide('slow');
  $('#menu_top_form').show('slow');
}

/**
 * メニュートップ画像の登録フォーム 非表示
 */
function ajaxHideTopImageForm() {
  $('#menu_top').show('slow');
  $('#menu_top_form').hide('slow');
}

/**
 * メニュー商品の新規登録フォーム 表示
 */
function ajaxShowNewItemForm() {
  $('#menu_item_new').hide('slow');
  $('#menu_item_form_new').show('slow');
}

/**
 * メニュー商品の新規登録フォーム 非表示
 */
function ajaxHideNewItemForm() {
  $('#menu_item_new').show('slow');
  $('#menu_item_form_new').hide('slow');
}

/**
 * メニュー商品の変更登録フォーム 表示
 */
function ajaxShowUpdateItemForm(id) {
  // 設定内容を取得
  //updateInfo('/rest/menua/item_info.json?i_id=' + id, 'setUpdateItem(' + id + ',data);');

  $('#menu_item_' + id).hide('slow');
  $('#menu_item_update_form_' + id).show('slow');
}

/**
 * メニューTOP画像の投稿
 */
function ajaxRegistTopImage() {

	// POSTする
	$('#menu_top_image').submit();
}

/**
 * アイテムを下へ移動
 */
function ajaxMoveDownItem(id) {

	// POSTする
	$('#item_content_vertical_change_' + id).submit();
}

/**
 * メニュー商品 新規登録
 */
function ajaxRegistItem() {

  // validate項目を獲得
  var price       = $("#item_top_form_new").find("#form_price").val();
  var title       = $("#item_top_form_new").find("#form_title").val();
  var description = $("#item_top_form_new").find("#form_description").val();


  if (price.match(/[^0-9]/g)) {
    alert("<?php echo __("価格に数値以外が含まれています。")?>");
    return false;
  } else if(title == ''){
	  alert("<?php echo __("項目名が未入力です")?>");
	    return false;
  } else if(description == ''){
	  alert("<?php echo __("商品説明が未入力です")?>");
	    return false;
  } else {

	// POSTする
	$('#item_top_form_new').submit();
  }
}

/**
 * メニュー商品 更新
 */
function ajaxUpdateItem(id) {

  // validate項目を獲得
  var price       = $("#menu_item_update_form_" + id).find("#form_price").val();
  var title       = $("#menu_item_update_form_" + id).find("#form_title").val();
  var description = $("#menu_item_update_form_" + id).find("#form_description").val();


  if (price.match(/[^0-9]/g)) {
    alert("<?php echo __("価格に数値以外が含まれています。")?>");
    return false;
  } else if(title == ''){
	  alert("<?php echo __("項目名が未入力です")?>");
	    return false;
  } else if(description == ''){
	  alert("<?php echo __("商品説明が未入力です")?>");
	    return false;
  } else {

	// POSTする
	$('#item_top_form_edit_' + id).submit();
  }
}

/**
 * メニュー商品 削除
 */
function ajaxDeleteItem(id) {

  var res = confirm("<?php echo __("本当に削除してもよろしいですか？")?>");
      // 選択結果で分岐
      if( res == true ) {
         // OKなら移動
         window.location = "./delete_item/" + id;
      }
      else {
         // キャンセルならダイアログ表示
         alert("<?php echo __("キャンセルしました")?>");
      }

	// POSTする
	//$('#item_top_form_edit_' + id).submit();

}


/**
 * メニュー商品の変更登録フォーム 非表示
 */
function ajaxHideUpdateItemForm(id) {
  $('#menu_item_' + id).show('slow');
  $('#menu_item_update_form_' + id).hide('slow');
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

function postData(id) {
	$('#' + id).submit();
}

</script>