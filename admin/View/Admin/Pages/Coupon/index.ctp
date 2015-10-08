<div class="frame_main_box" id="coponInfo">
	<?php echo $this->Form->create(false, array('type' => 'file', 'action' => 'regist', 'novalidate' => true)); ?>
	<?php echo $this->Form->input('Coupon.pos', array('type' => 'hidden', 'value' => '')); ?>

	<!-- ▼表示部分 -->
	<?php if(is_array($couponInfo) || is_object($couponInfo)) :?>
	<?php foreach($couponInfo as $key => $couponInfo) { ?>
		<?php if(count($couponInfo)) :?>
		<div class="frame_main_box box_kage">
			<!-- ▼上のりボンの部分 -->
			<header class="panel-heading panel-title"><?php $num = $key + 1 ; ?> <?php echo __('%s 枚目', $num); ?></header>
			<div class="form_top">
				<div class="coupon-ribon sm_non">
				</div>
			</div>
			<!-- ▲上のりボンの部分 -->

			<!-- ▼クーポン内容表示部分 -->
			<div id='disp_coupon_info_<?php echo $key + 1 ; ?>'>
				<div>
					<label class="form-label"><?php echo __('クーポン画像'); ?></label>
					<div id='coupon_image_disp_0' class="form-txt_box">
						<?php
							if(!empty($couponInfo['image']) && $couponInfo['image'] != '') {
								echo $this->Html->image("/media/image/{$couponInfo['image']}", array('class' => 'avatar avatar-sm2'));
							} else {
								echo $this->Html->image("/img/common/noimage/noimage_menutop.png", array('class' => 'avatar avatar-sm2'));
							}
						?>
					</div>
					<div class="form_hr"></div>
				</div>

				<div>
					<label class="form-label"><?php echo __('クーポンの表示'); ?></label>
					<div id='coupon_title_0' class="form-txt_box">
						<?php echo $this->Coupon->getEnableFlg($couponInfo['enable_flg']); ?>
					</div>
					<div class="form_hr"></div>
				</div>

				<div>
					<label class="form-label"><?php echo __('タイトル'); ?></label>
					<div id='coupon_title_0' class="form-txt_box">
						<?php echo $couponInfo['title']; ?>
					</div>
					<div class="form_hr"></div>
				</div>

				<div>
					<label class="form-label"><?php echo __('内容'); ?></label>
					<div id='coupon_policy_0' class="form-txt_box">
						<?php echo $couponInfo['policy']; ?>
					</div>
					<div class="form_hr"></div>
				</div>

				<?php if ($couponInfo['discount'] != '') { ?>
				<div>
					<label class="form-label"><?php echo __('割引率'); ?></label>
					<div id='coupon_policy_0' class="form-txt_box">
						<?php echo $couponInfo['discount']; ?>%
					</div>
					<div class="form_hr"></div>
				</div>
				<?php } ?>

				<div>
					<label class="form-label"><?php echo __('クーポン種類'); ?></label>
					<div id='coupon_title_0' class="form-txt_box">
						<?php echo $this->Coupon->getCouponType($couponInfo['coupon_type']); ?>
					</div>
					<div class="form_hr"></div>
				</div>

				<!-- ▼通常クーポン表示 -->
				<?php if ($couponInfo['coupon_type'] === '0') { ?>
					<?php if ($couponInfo['term_flg'] === '1') { ?>
						<div>
							<label class="form-label"><?php echo __('期限'); ?></label>
							<div id='coupon_start_end_datetime_0' class="form-txt_box">
								<?php echo date('Y/m/d', strtotime($couponInfo['start_datetime'])); ?>〜
								<?php echo date('Y/m/d', strtotime($couponInfo['end_datetime'])); ?>
							</div>
							<div class="form_hr"></div>
						</div>
					<?php } else if ($couponInfo['term_flg'] === '0'){ ?>
						<div>
							<label class="form-label"><?php echo __('期限'); ?></label>
							<div id='coupon_start_end_datetime_0' class="form-txt_box">
								<?php echo __('無期限'); ?>
							</div>
							<div class="form_hr"></div>
						</div>
					<?php } ?>
				<?php } ?>
				<!-- ▲通常クーポン表示 -->

				<!-- ▼期間限定クーポン表示 -->
				<?php if ($couponInfo['coupon_type'] == 1) { ?>
				<div>
					<label class="form-label"><?php echo __('表示日数'); ?></label>
					<div id='coupon_start_end_datetime_0' class="form-txt_box">
						<?php echo $couponInfo['display_days']; ?><?php echo __('日間'); ?>
					</div>
					<div class="form_hr"></div>
				</div>
				<?php } ?>
				<!-- ▲期間限定クーポン表示 -->

				<div class="btn_center pb_60">
					<button class="btn btn-info btn-sm" onclick="toggleForm('coupon_info_' + <?php echo $key + 1 ; ?>);return false;"><i class="fa fa-edit mg-r-xs"></i><?php echo __('変更'); ?></button>
				</div>

			</div>
			<!-- ▲クーポン内容表示部分 -->

			<!-- ▼クーポンフォーム表示部分 -->
			<div id='form_coupon_info_<?php echo $key + 1 ; ?>' style="display:none">
			<!-- <form id='form_coupon_info_action_<?php echo $key + 1 ; ?>'> -->
				<div class="form-group">
					<label for="form_policy" class="form-label"><?php echo __('クーポン画像'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
					<div class="textarea_box">
						<span id="prev_tmp_category_image" class="form-label no-hand ml_70">
							<?php
								if(empty($couponInfo['image'])) {
									echo $this->Html->image("/img/common/noimage/noimage_menutop.png", array('class' => 'avatar avatar-sm2', 'id' => 'ImageViewer_' . $key));
								} else {
									echo $this->Html->image("/media/image/{$couponInfo['image']}", array('class' => 'avatar avatar-sm2', 'id' => 'ImageViewer_' . $key));
								}
							?>
						</span>
						<div class="form-group">
							<label for="upload" class="form-label"><?php echo __('クーポン画像'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
							<?php echo $this->Form->file("CouponImage.{$key}.image", array('class' => 'wau pt_10 ImageSelect', 'label' => false, 'pos' => $key)); ?>
							<?php echo $this->Form->input("CouponImage.{$key}.imageType", array('type' => 'hidden', 'value' => 'coupon')); ?>

							<p class="form-help fml_184"><?php echo __('ファイルサイズ：3MBまで<br>640px&nbsp;×&nbsp;814px&nbsp;以上の大きさを推奨<br />
								クーポンの種類を「使いきりクーポン」を選択時、クーポンを使用されますと、下部 178px 部分は切り取られます。<br>
								クーポン画像を設定しますと、タイトルや利用条件は表示されなくなります。'); ?>
							</p>
							<div class="form_hr"></div>
						</div>
					</div>
					<div class="form_hr"></div>
				</div>

				<div class="form-group">
					<label for="form_notice" class="form-label"><?php echo __('クーポンの表示'); ?><span class="hisu"><?php echo __('必須'); ?></span></label>
					<div class="checkbox_box enable_flg">
						<?php echo $this->Form->input("Coupon.{$key}.enable_flg", array('type' => 'radio', 'options' => Configure::read('CouponDisp'), 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;', 'data-rule-required'=>"true", 'data-msg-required' => __("クーポンの表示の選択が必要になります。"))); ?>

						<p class="form-help fml_184"><?php echo __('「非表示」に設定するとアプリ上のクーポンが非表示になります。'); ?></p>
						<div class="form_hr"></div>
					</div>
				</div>

				<div class="form-group title">
					<label for="form_title" class="form-label"><?php echo __('タイトル'); ?><span class="hisu"><?php echo __('必須'); ?></span></label>
					<?php echo $this->Form->input("Coupon.{$key}.title", array('class' => 'form-txt form-5', 'type' => 'text', 'label' => false, 'placeholder' => __('クーポン名を入力'), 'data-rule-required'=>"true", 'data-msg-required' => __("タイトルの選択が必要になります。"))); ?>

					<div class="form_hr"></div>
				</div>

				<div class="form-group policy">
					<label for="form_policy" class="form-label"><?php echo __('利用条件'); ?><span class="hisu"><?php echo __('必須'); ?></span></label>
					<div class="textarea_box">
						<?php echo $this->Form->textarea("Coupon.{$key}.policy", array('class' => 'form-txt form-textarea', 'type' => 'textarea', 'label' => false, 'placeholder' => __('利用規約を入力'), 'data-rule-required'=>"true", 'data-msg-required' => __("利用条件の選択が必要になります。"))); ?>
					</div>
					<p class="form-help fml_184"><?php echo __('実際のスマホアプリでは、クーポン画像をタップすると表示されます。'); ?></p>
					<div class="form_hr"></div>
				</div>

				<div class="form-group">
					<label for="form_policy" class="form-label"><?php echo __('割引率'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
					<div class="textarea_box">
						<?php echo $this->Form->input("Coupon.{$key}.discount", array('class' => 'form-txt form-3', 'type' => 'text', 'label' => false, 'placeholder' => __('0 〜 100 を入力'))); ?>
					</div>
					<div class="form_hr"></div>
				</div>

				<!-- ▼クーポンの種類切り替えボタン -->
				<div class="form-group">
					<label for="form_notice" class="form-label"><?php echo __('クーポンの種類'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
					<div class="select_custom">
						<?php echo $this->Form->input("Coupon.{$key}.coupon_type", array('type' => 'select', 'options' => Configure::read('ConponTypeList'), 'label' => false, 'div' => false, 'class' => 'form-select', 'onChange' => "changeCoupon({$key})"));?>
					</div>
					<p class="form-help fml_184"><?php echo __('クーポンの種類を選択することができます。'); ?></p>
					<div class="form_hr"></div>
				</div>
				<!-- ▲クーポンの種類切り替えボタン -->

				<!-- ▼クーポンの種類　通常 -->
				<div id="type_0_<?php echo $key; ?>">
					<div class="form-group">
						<label for="form_notice" class="form-label"><?php echo __('期間指定'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
						<div class="checkbox_box">
							<?php echo $this->Form->input("Coupon.{$key}.term_flg", array('type' => 'radio', 'options' => Configure::read('CouponTermFlg'), 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;', 'onchange' => "limitDate({$key})")); ?>
						</div>
						<p class="form-help fml_184"><?php echo __('指定した期間のみクーポンの表示をすることができます。'); ?></p>
						<div class="form_hr"></div>
					</div>

					<!-- ▽内容切り替え -->
					<div id="dateform_<?php echo $key; ?>" style="display:none;">
						<!-- ▲内容切り替え -->

						<div class="form-group" id="coupon_start_0">
							<label for="form_start_year" class="form-label"><?php echo __('表示開始日'); ?></label>
							<div class="textarea_box">
								<?php echo $this->Form->input("Coupon.{$key}.start_datetime", array('class' => 'form-txt form-2 calendar', 'type' => 'text', 'label' => false, 'placeholder' => __('日付を選択'))); ?>
							</div>
							<div class="form_hr"></div>
						</div>

						<div class="form-group" id="coupon_end_0">
							<label for="form_end_year" class="form-label"><?php echo __('表示終了日'); ?></label>
							<div class="textarea_box">
								<?php echo $this->Form->input("Coupon.{$key}.end_datetime", array('class' => 'form-txt form-2 calendar', 'type' => 'text', 'label' => false, 'placeholder' => __('日付を選択'))); ?>
							</div>
							<div class="form_hr"></div>
						</div>
					</div>
				</div>
				<!-- ▲クーポンの種類　通常 -->

				<!-- ▼クーポンの種類　期間限定 -->
				<div id="type_1_<?php echo $key; ?>" style="display:none;">
					<div class="form-group">
						<label for="form_policy" class="form-label"><?php echo __('掲載日数'); ?><span class="hisu"><?php echo __('必須'); ?></span></label>
						<div class="textarea_box">
							<?php echo $this->Form->input("Coupon.{$key}.display_days", array('class' => 'form-txt form-2', 'type' => 'text', 'label' => false, 'placeholder' => __('1以上の数値を入力'))); ?>
						</div>
						<p class="form-help fml_184"><?php echo __('アプリインストール後、何日間クーポンを表示するか設定します'); ?></p>
						<div class="form_hr"></div>
					</div>
				</div>
				<!-- ▲クーポンの種類　期間限定 -->


				<!-- ▼クーポンの種類　使いきり -->
				<div id="type_2_<?php echo $key; ?>" style="display:none;">
				</div>
				<!-- ▲クーポンの種類　使いきり -->


				<?php echo $this->Form->input("Coupon.{$key}.hash", array('type' => 'hidden')); ?>

				<div class="btn_center pb_60">
					<button class="btn btn-default btn-sm" onClick="toggleForm('coupon_info_' + <?php echo $key + 1 ; ?>);return false;"><i class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る'); ?></button>
					<a href="javascript:void(0);" id="save_top_html" class="btn btn-danger btn-sm" onclick="deleteCoupon(<?php echo $key; ?>)"><i class="fa fa-trash-o mg-l-xs"></i>&nbsp;<?php echo __('削除'); ?></a>
					<a href="javascript:void(0);" id="save_top_html" class="btn btn-warning btn-sm" onclick="regist(<?php echo $key; ?>)"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></a>
				</div>
			<!-- </form> -->
			</div>
			<!-- ▲クーポンフォーム表示部分 -->
		</div>
		<?php endif;?>
	<?php } ?>
	<?php endif;?>
</div>
<?php echo $this->Form->end(); ?>
<script>

</script>
<?php echo $this->Html->scriptStart(array('inline' => false)) ?>


function deleteCoupon(id) {
	if(window.confirm('<?php echo __('クーポンを削除します。よろしいですか。'); ?>')){
		deleteUrl = '<?php echo Router::url(array('controller' => 'Coupon', 'action' => 'delete')); ?>?id=' + id ;
		window.location.href = deleteUrl;
	}
}

function regist(id) {
	$(':hidden[name="data[Coupon][pos]"]').val(id);

	if(window.confirm('<?php echo __('クーポンを登録します。よろしいですか。'); ?>')) {
		key = id + 1;
		//alert("#form_coupon_info_"+key);
		val = $("input[name='data[Coupon]["+id+"][enable_flg]']:checked").length;
		$("#enable_flg-error").remove();
		if(val==0) {
			$("#form_coupon_info_"+key+' .checkbox_box.enable_flg .form-help.fml_184').before('<label id="enable_flg-error" class="coupon error"><?php echo __('クーポンの表示の選択が必要になります。')?></label>');
			return;
		} else {
			$("#enable_flg-error").remove();
		}
		title = $("#Coupon"+id+"Title").val();
		$("#title-error").remove();
		if(title=='') {
			$("#Coupon"+id+"Title").after('<label id="title-error" class="coupon coupon2 error"><?php echo __('タイトルの選択が必要になります。')?></label>');
			return;
		} else {
			$("#title-error").remove();
		}
		policy = $("#Coupon"+id+"Policy").val();
		$("#policy-error").remove();
		if(policy=='') {
			$("#Coupon"+id+"Policy").after('<label id="policy-error" class="coupon coupon2 error"><?php echo __('利用条件の選択が必要になります。')?></label>');
			return;
		} else {
			$("#policy-error").remove();
		}
		$("#form_coupon_info_"+key).validate({
			onfocusout:true,
			messages: {
			}
		});
		$('#registForm').submit();
	}
}

function changeCoupon(id) {

	// 選択中の情報を取得して、情報によって、表示・非表示を切りかえる。
	selectValue = $("select[name='data[Coupon][" + id + "][coupon_type]']").val();

	// 選択されている値によって、フォームを切り替え。
 	if (selectValue == 0) {
		// ふつうのクーポン type_1_とtype_2を非表示_ type_0_表示
		$('#type_1_' + id).hide();
		$('#type_2_' + id).hide();
		$('#type_0_' + id).show();

 	} else if(selectValue == 1) {
	 	// 期間限定クーポン
	 	$('#type_1_' + id).show();
		$('#type_2_' + id).hide();
		$('#type_0_' + id).hide();

 	} else if(selectValue == 2) {
	 	// 使いきりクーポン
	 	$('#type_1_' + id).hide();
		$('#type_2_' + id).show();
		$('#type_0_' + id).hide();

 	}
}

function limitDate(id) {
	selectValue = $("input[name='data[Coupon][" + id + "][term_flg]']:checked").val();

	// 値によって、表示・非表示を選択スル。
	if (selectValue == 0) {
		$('#dateform_' + id).hide();
	} else if(selectValue == 1) {
		$('#dateform_' + id).show();
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

$(document).ready(function(){
	// DatePickerの初期化
	$(".calendar").datepicker({dateFormat:'yy-mm-dd'});

	// 表示を変更する。
	for(i=0;i<5;i++) {
		changeCoupon(i);
		limitDate(i);
	}

	/*<?php if(is_array($couponInfo) || is_object($couponInfo)) :?>
	<?php foreach($couponInfo as $key => $couponInfo) { ?>
		$("#form_coupon_info_<?php echo $key + 1 ; ?>").validate({
			onfocusout:true,
			messages: {
			}
		});
	<?php }?>
	<?php endif;?>*/
});
<?php echo $this->Html->scriptEnd(); ?>
