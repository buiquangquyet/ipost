<div class="frame_main_box" id="shopInfo">
<?php $datashopInfo =  json_decode($shopInfo)?>
	<header class="panel-heading panel-title"><?php echo __('お店の写真の登録・変更'); ?></header>
	<div class="form_top"></div>

	<!-- ▼表示部分 -->
	<div ng-controller='shopInfoController'>
		<div id='disp_shop_image'>
			<div class="form-group center_box">
				<label id='registprev' class="form-label no-hand">
					<img ng-src="<?php echo '/ipost/admin/media/'.$datashopInfo->image?>" alt="<?php echo __('ショップ画像'); ?>" class="avatar avatar-sm2">
				</label>

				<div class="button_box">
					<button class="btn btn-warning btn-sm mt_10" onClick="toggleForm('shop_image')"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></button>
				</div>
			</div>
			<div class="c10"></div>
		</div>
		<!-- ▲ -->

		<!-- ▼ 入力フォーム -->
		<div id="form_shop_image" style="display:none;">
			<div class="form-group">
				<label id='prev' class="form-label no-hand ml_70">
					<img ng-src="{{shopInfo.image}}" alt="<?php echo __('ショップ画像'); ?>" class="avatar avatar-sm2 ImageViewer">
				</label>
				<div class="form_hr"></div>
			</div>

			<?php echo $this->Form->create(false, array('type' => 'file', 'id' => 'registShopImage', 'url' => array('controller' => 'ajax', 'action' => 'regist'), 'novalidate' => true)); ?>
				<div class="form-group">
					<label for="upload" class="form-label"><?php echo __('画像の選択'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
					<?php echo $this->Form->file('ShopImage.image', array('id' => 'ImageSelector', 'div' => false, 'label' => false, 'error' => false, 'class' => 'wau pt_10'));?>
					<p ng-show="imageValidateInfo.errorInfo" class="form-help fml_184">{{imageValidateInfo.errorInfo}}</p>
					<p class="form-help fml_184"><?php echo __('ファイルサイズ：3MBまで<br />640px&nbsp;×&nbsp;420px&nbsp;以上の大きさを推奨'); ?></p>
				</div>
				<div class="form_hr"></div>
				<hr />
			<?php echo $this->Form->end(); ?>

			<div class="btn_center">
				<span id='imgfilename'></span>
				<button type="button" class="btn btn-default btn-sm" onClick="toggleForm('shop_image')"><i class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る'); ?></button>
				<button type="button" class="btn btn-warning btn-sm" ng-click="registShopImage('#registShopImage');"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></button>
			</div>
		</div>
		<!-- ▲ -->

		<!-- ▼ お店の情報変更 -->
		<div class="frame_main_box">
			<header class="panel-heading panel-title"><?php echo __('お店の情報の登録・変更'); ?></header>
			<div class="form_top"></div>

			<div id='disp_shop_info'>
				<div class="form-group">
					<label class="form-label"><?php echo __('お店の名前'); ?></label>
					<div class="form-txt_box">
						<span id='shop_name'>{{shopInfo.profile.shop_name}}</span>
					</div>
					<div class="form_hr"></div>
				</div>

				<hr>

				<div class="form-group">
					<label class="form-label"><?php echo __('郵便番号'); ?></label>
					<div class="form-txt_box">
						<span id='zip_code1' ng-show="{{shopInfo.profile.zip_code1}}">{{shopInfo.profile.zip_code1}}-{{shopInfo.profile.zip_code2}}</span>
					</div>
					<div class="form_hr"></div>
				</div>

				<div class="form-group">
			      <label class="form-label"><?php echo __('住所'); ?></label>
			      <div class="form-txt_box">
			        <span id='pref_name'><?php echo $pref_old?> </span>
			        <span id='city'>{{shopInfo.profile.city}} </span>
			        <span id='address_opt1'>{{shopInfo.profile.address_opt1}} </span>
			        <br />
			        <span id='address_opt2'>{{shopInfo.profile.address_opt2}}</span>
			      </div>
			      <div class="form_hr"></div>
			    </div>
				<!-- <div class="form-group">
					<label class="form-label"><?php //echo __('住所'); ?></label>
					<div class="form-txt_box">
						<span id='shop_pref'>{{shopInfo.profile.address}}</span>
					</div>
					<div class="form_hr"></div>
				</div> -->
				<!--
				<div class="form-group">
			        <label class="form-label"><?php echo __('都道府県')?></label>
			        <div class="form-txt_box">
						<span id='shop_pref'><?php echo $pref_old?></span>
					</div>
			        <div class="form_hr"></div>
			   	</div>
				<div class="form-group">
					<label class="form-label"><?php echo __('市区町村'); ?></label>
					<div class="form-txt_box">
						<span id='city'>{{shopInfo.profile.city}}</span>
					</div>
					<div class="form_hr"></div>
				</div>
				<div class="form-group">
					<label class="form-label"><?php echo __('住所（番地）'); ?></label>
					<div class="form-txt_box">
						<span id='address_opt1'>{{shopInfo.profile.address_opt1}}</span>
					</div>
					<div class="form_hr"></div>
				</div>
				<div class="form-group">
					<label class="form-label"><?php echo __('住所（建物）'); ?></label>
					<div class="form-txt_box">
						<span id='address_opt1'>{{shopInfo.profile.address_opt2}}</span>
					</div>
					<div class="form_hr"></div>
				</div>
 				-->
				<hr>

				<div class="form-group">
					<label class="form-label"><?php echo __('電話番号'); ?></label>
					<div class="form-txt_box">
						<span id="tel1" ng-show="{{shopInfo.profile.tel1}}">{{shopInfo.profile.tel1}}-{{shopInfo.profile.tel2}}-{{shopInfo.profile.tel3}}</span>
					</div>
					<div class="form_hr"></div>
				</div>

				<div class="form-group">
					<label class="form-label"><?php echo __('FAX'); ?></label>
					<div class="form-txt_box">
						<span id="fax1" ng-show="{{shopInfo.profile.fax1}}">{{shopInfo.profile.fax1}}-{{shopInfo.profile.fax2}}-{{shopInfo.profile.fax3}}</span>
					</div>
					<div class="form_hr"></div>
				</div>

				<hr>

				<div class="form-group">
					<label class="form-label"><?php echo __('メールアドレス'); ?></label>
					<div class="form-txt_box">
						<span id="email">{{shopInfo.profile.email}}</span>
					</div>
					<div class="form_hr"></div>
				</div>

				<hr>

				<div class="form-group">
					<label class="form-label"><?php echo __('ホームページアドレス'); ?></label>
					<div class="form-txt_box">
						<a href="{{shopInfo.profile.url}}" target="_blank" id="url"><span style="color:#08C;">{{shopInfo.profile.url}}</span></a>
					</div>
					<div class="form_hr"></div>
				</div>

				<div class="form-group">
					<label class="form-label"><?php echo __('オンラインショップ'); ?></label>
					<div class="form-txt_box">
						<a href="" target="_blank" id="online_shop"><span style="color:#08C;"></span></a>
						<a href="{{shopInfo.profile.online_shop}}" target="_blank" id="url"><span style="color:#08C;">{{shopInfo.profile.online_shop}}</span></a>
					</div>
					<div class="form_hr"></div>
				</div>

				<hr>

				<div class="form-group">
					<label class="form-label"><?php echo __('営業時間'); ?></label>
					<div class="form-txt_box">
						<span id="open_hours">{{shopInfo.profile.open_hours}}</span>
					</div>
					<div class="form_hr"></div>
				</div>

				<div class="form-group">
					<label class="form-label"><?php echo __('定休日'); ?></label>
					<div class="form-txt_box">
						<span id="holiday">{{shopInfo.profile.holiday}}</span>
					</div>
					<div class="form_hr"></div>
				</div>

				<hr>

				<div class="button_box">
					<button type="button" class="btn btn-warning btn-sm" onClick="toggleForm('shop_info')"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></button>
				</div>
			</div>

			<!-- ▼ 入力フォーム -->
			<div id='form_shop_info' style='display:none;'>
				<?php echo $this->Form->create(false, array('id' => 'shopInfoForm', 'url' => array('controller' => 'ajax', 'action' => 'regist'), 'novalidate' => true)); ?>
					<div class="form-group">
						<label for="form_shop_name" class="form-label"><?php echo __('お店の名前'); ?><span class="hisu"><?php echo __('必須'); ?></span></label>
						<?php echo $this->Form->input('Shop.shop_name', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-5', 'placeholder' => __('お店の名前を入力'), 'ng-model' => 'shopInfo.profile.shop_name'));?>
						<!-- <p ng-repeat="validate_message in validate.message.shop_name" class="form-help fml_184" style="color: red;">{{validate_message}}</p> -->
						<p ng-repeat="validate_message in validate.message.shop_name" class="form-help fml_184" style="color: red;"><?php echo __('お店の名前を入力してください')?></p>
						<p class="form-help fml_184"><?php echo __('お店の名前が必要になります。'); ?></p>
						<div class="form_hr"></div>
					</div>

					<hr>

					<div class="form-group">
						<label for="form_zip_code1" class="form-label"><?php echo __('郵便番号'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
						<?php echo $this->Form->input('Shop.zip_code1', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'placeholder' => __('上3桁'), 'maxlength' => '3', 'ng-model' => 'shopInfo.profile.zip_code1'));?>
						&nbsp;
						<?php echo $this->Form->input('Shop.zip_code2', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'placeholder' => __('下4桁'), 'maxlength' => '4', 'ng-model' => 'shopInfo.profile.zip_code2'));?>
						<p ng-repeat="validate_message in validate.message.zip_code" class="form-help fml_184" style="color: red;">{{validate_message}}</p>
						<div class="form_hr"></div>
					</div>

					<div class="form-group">
				        <label class="form-label" for="form_pref"><?php echo __('都道府県')?><span class="nin"><?php echo __('任意')?></span></label>
				        <div class="select_custom">
				          <select name="data[Shop][pref]" id="form_pref" placeholder="" class="form-select" style="width: auto;">
				          	<?php $arr_pref = Configure::read('PrefList'); ?>
				          	<?php foreach($arr_pref as $key => $value):?>
							<option value="<?php echo $key?>" <?php if ($prer_index==$key) {?>selected="selected"<?php } else {}?>><?php echo $value?></option>
							<?php endforeach;?>
						</select>
				        </div>
				        <div class="form_hr"></div>
				   	</div>
				   	<div class="form-group">
				        <label class="form-label" for="form_city"><?php echo __('市区町村')?><span class="nin"><?php echo __('任意')?></span></label>
				        <?php echo $this->Form->input('Shop.city', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-5', 'placeholder' => __('市区町村を入力'), 'ng-model' => 'shopInfo.profile.city'));?>
				        <div class="form_hr"></div>
				    </div>
					<!-- <div class="form-group">
						<label for="address" class="form-label"><?php echo __('住所'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
						<?php echo $this->Form->input('Shop.address', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-5', 'placeholder' => __('東京都渋谷区'), 'ng-model' => 'shopInfo.profile.address'));?>
						<p ng-repeat="validate_message in validate.message.address" class="form-help fml_184" style="color: red;">{{validate_message}}</p>
						<div class="form_hr"></div>
					</div> -->
					<div class="form-group">
						<label for="address" class="form-label"><?php echo __('住所（番地）'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
						<?php echo $this->Form->input('Shop.address_opt1', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-5', 'placeholder' => __('住所（番地）を入力'), 'ng-model' => 'shopInfo.profile.address_opt1'));?>
						<p ng-repeat="validate_message in validate.message.address_opt1" class="form-help fml_184" style="color: red;">{{validate_message}}</p>
						<div class="form_hr"></div>
					</div>
					<div class="form-group">
						<label for="address" class="form-label"><?php echo __('住所（建物）'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
						<?php echo $this->Form->input('Shop.address_opt2', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-5', 'placeholder' => __('住所（建物）を入力'), 'ng-model' => 'shopInfo.profile.address_opt2'));?>
						<p ng-repeat="validate_message in validate.message.address_opt2" class="form-help fml_184" style="color: red;">{{validate_message}}</p>
						<div class="form_hr"></div>
					</div>

					<hr>

					<div class="form-group">
						<label for="form_tel1" class="form-label"><?php echo __('電話番号'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
						<?php echo $this->Form->input('Shop.tel1', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'maxlength' => '4', 'placeholder' => __('市外局番'), 'ng-model' => 'shopInfo.profile.tel1'));?>&nbsp;
						<?php echo $this->Form->input('Shop.tel2', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'maxlength' => '4', 'placeholder' => __('上4桁'), 'ng-model' => 'shopInfo.profile.tel2'));?>&nbsp;
						<?php echo $this->Form->input('Shop.tel3', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'maxlength' => '4', 'placeholder' => __('下4桁'), 'ng-model' => 'shopInfo.profile.tel3'));?>
						<p ng-repeat="validate_message in validate.message.tel" class="form-help fml_184" style="color: red;">{{validate_message}}</p>
						<div class="form_hr"></div>
					</div>

					<div class="form-group">
						<label for="form_fax1" class="form-label"><?php echo __('FAX'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
						<?php echo $this->Form->input('Shop.fax1', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'maxlength' => '4', 'placeholder' => __('市外局番'), 'ng-model' => 'shopInfo.profile.fax1'));?>&nbsp;
						<?php echo $this->Form->input('Shop.fax2', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'maxlength' => '4', 'placeholder' => __('上4桁'), 'ng-model' => 'shopInfo.profile.fax2'));?>&nbsp;
						<?php echo $this->Form->input('Shop.fax3', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'maxlength' => '4', 'placeholder' => __('下4桁'), 'ng-model' => 'shopInfo.profile.fax3'));?>
						<p ng-repeat="validate_message in validate.message.fax" class="form-help fml_184" style="color: red;">{{validate_message}}</p>
						<div class="form_hr"></div>
					</div>

					<hr>

					<div class="form-group">
						<label for="form_email" class="form-label"><?php echo __('メールアドレス'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
						<?php echo $this->Form->input('Shop.email', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-5', 'placeholder' => __('メールアドレスを入力'), 'ng-model' => 'shopInfo.profile.email'));?>
						<p ng-repeat="validate_message in validate.message.email" class="form-help fml_184" style="color: red;">{{validate_message}}</p>
						<div class="form_hr"></div>
					</div>

					<hr>

					<div class="form-group">
						<label for="form_url" class="form-label"><?php echo __('ホームページアドレス'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
						<?php echo $this->Form->input('Shop.url', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-5', 'placeholder' => __('ホームページアドレスを入力'), 'ng-model' => 'shopInfo.profile.url'));?>
						<p ng-repeat="validate_message in validate.message.url" class="form-help fml_184" style="color: red;">{{validate_message}}</p>
						<div class="form_hr"></div>
					</div>

					<div class="form-group">
						<label for="form_online_shop" class="form-label"><?php echo __('オンラインショップ'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
						<?php echo $this->Form->input('Shop.online_shop', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-5', 'placeholder' => __('オンラインショップURLを入力'), 'ng-model' => 'shopInfo.profile.online_shop'));?>
						<p ng-repeat="validate_message in validate.message.online_shop" class="form-help fml_184" style="color: red;">{{validate_message}}</p>
						<div class="form_hr"></div>
					</div>

					<hr>


					<div class="form-group">
						<label for="form_open_hours" class="form-label"><?php echo __('営業時間'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
						<?php echo $this->Form->input('Shop.open_hours', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-5', 'placeholder' => __('営業時間を入力'), 'ng-model' => 'shopInfo.profile.open_hours'));?>
						<p ng-repeat="validate_message in validate.message.open_hours" class="form-help fml_184" style="color: red;">{{validate_message}}</p>
						<div class="form_hr"></div>
					</div>


					<div class="form-group">
						<label for="form_holiday" class="form-label"><?php echo __('定休日'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
						<?php echo $this->Form->input('Shop.holiday', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-5', 'placeholder' => __('定休日を入力'), 'ng-model' => 'shopInfo.profile.holiday'));?>
						<p ng-repeat="validate_message in validate.message.holiday" class="form-help fml_184" style="color: red;">{{validate_message}}</p>
						<div class="form_hr"></div>
					</div>

					<hr>

					<div class="btn_center">
						<button type="button" class="btn btn-default btn-sm" onClick="toggleForm('shop_info')"><i class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る'); ?></button>
						<button type="button" class="btn btn-warning btn-sm" ng-click="registShopInfo('#shopInfoForm')"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></button>
					</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
		<!-- ▲ -->
	</div>

	<div class="frame_bottom_box">
		<div class="padding10"></div>
	</div>
</div>
<!-- ▲ -->
<?php echo $this->Html->scriptStart(array('inline' => false)) ?>
$(function () {
	$('#ImageSelector').on('change', function() {
		if (! this.files.length) {
			return;
		}

		var file = this.files[0];
		if (! file.type.match('image.*')) {
			alert('<?php echo __('画像を選択してください。'); ?>');
			return;
		}

		if (! file.size > (3 * 1024 * 1024)) {
			alert('<?php echo __('サイズが大きすぎます。'); ?>');
			return;
		}

		var reader = new FileReader();
		reader.onload = (function(theFile) {
			return function(e) {
				$('.ImageViewer').each(function() {
					$(this).attr('src', e.target.result);
				});
			};
		})(file);

		reader.readAsDataURL(file);
	});
});
$(document).ready(function(){
	moduleBase.controller('shopInfoController', ['$scope', 'AjaxUrlAccess', function($scope, AjaxUrlAccess) {

		$scope.shopInfo = <?php echo $shopInfo; ?>;

		if ($scope.shopInfo.image == '') {
			$scope.shopInfo.image = "<?php echo SYSTEM_PATH; ?>img/common/noimage/noimage_menutop.png";
		} else {
			$scope.shopInfo.image = "<?php echo SYSTEM_PATH; ?>media/" + $scope.shopInfo.image + "/";
		}

		$scope.registShopImage = function(id) {
			if (window.confirm('<?php echo __('お店の写真を登録します。よろしいですか'); ?>')) {
				resultObject = AjaxUrlAccess.postData(id, 'redirectUrl()');
				$scope.validate = resultObject.error;
			}
		}

		$scope.registShopInfo = function(id) {
			if (window.confirm('<?php echo __('店舗情報を登録します。よろしいですか'); ?>')) {
				resultObject = AjaxUrlAccess.postData(id, 'redirectUrl()');
				$scope.validate = resultObject.error;
				$scope.shopInfo.process = resultObject.result;
			}
		}

	}]);
	angular.bootstrap($('#shopInfo'), ['moduleBase']);
});

function redirectUrl() {
	location.href = '<?php echo Router::url(array('controller' => 'shop', 'action' => 'profile')); ?>';
}
<?php echo $this->Html->scriptEnd(); ?>
