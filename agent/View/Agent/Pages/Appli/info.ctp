<style type="text/css">
.lang_setting fieldset{
  padding: 0px 30px;
}
.form-select{
  margin-bottom: 0px;
}
</style>
<div id="storeInfo" class="main" ng-controller="StoreInfoController">
  <div class="main_title"><a href="/">HOME</a> > アプリ情報</div>
  <h2><i class="fa fa-building">&nbsp;</i>アプリ情報</h2>

  <div class="lang_setting">
    <fieldset>
      <table>
        <tr>
          <td class="subject"><?php echo __('言語選択'); ?></td>
          <td><?php echo $this->Form->input('lang_setting', array('type' => 'select', 'options' => $lang_setting, 'label' => false, 'div' => false, 'class' => 'form-select', 'value' => $current_status, 'onchange' => 'searchStatus();'));?></td>
        </tr>
      </table>
    </fieldset>
  </div>

  <h3>トップ画面に関する情報</h3>
  <fieldset>
  <!-- モーダルウィンドウ本体 -->
	<iframe src="<?php echo($admin_domain); ?>/BlockPreview?user_id=<?php echo $admin_id; ?>&amp;lang=<?php echo $current_status; ?>" id="preview" name="preview" width="304" height="630" style="border-style:none;">
		<?php echo __('この部分はインラインフレームを使用しています。'); ?>
	</iframe>
  </fieldset>

  <h3>ニュース画面に関する情報</h3>
  <fieldset>
  	<iframe src="<?php echo($admin_domain); ?>/NewsPreview?user_id=<?php echo $admin_id; ?>&amp;lang=<?php echo $current_status; ?>" id="preview" name="preview" width="304" height="630" style="border-style:none;">
		<?php echo __('この部分はインラインフレームを使用しています。'); ?>
	</iframe>
  </fieldset>

  <h3>メニュー画面に関する情報</h3>
  <fieldset>
  	<iframe src="<?php echo($admin_domain); ?>/MenuPreview?user_id=<?php echo $admin_id; ?>&amp;lang=<?php echo $current_status; ?>" id="preview" name="preview" width="304" height="630" style="border-style:none;">
		<?php echo __('この部分はインラインフレームを使用しています。'); ?>
	</iframe>
  </fieldset>

  <h3>クーポン画面に関する情報</h3>
  <fieldset>
  	<iframe src="<?php echo($admin_domain); ?>/CouponPreview?user_id=<?php echo $admin_id; ?>&amp;lang=<?php echo $current_status; ?>" id="preview" name="preview" width="304" height="630" style="border-style:none;">
		<?php echo __('この部分はインラインフレームを使用しています。'); ?>
	</iframe>
  </fieldset>

  <h3>店舗情報画面に関する情報</h3>
  <fieldset>
  	<iframe src="<?php echo($admin_domain); ?>/ShopPreview/profile?user_id=<?php echo $admin_id; ?>&amp;lang=<?php echo $current_status; ?>" id="preview" name="preview" width="304" height="630" style="border-style:none;">
		<?php echo __('この部分はインラインフレームを使用しています。'); ?>
	</iframe>
  </fieldset>
</div>

<!-- ▼ Script -->
<script type="text/javascript">
function searchStatus() {
  var status = $('#lang_setting').val();
  window.location.href = '<?php echo FULL_BASE_URL; ?>/appli/info/<?php echo $admin_id; ?>/' + status;
};
$(document).ready(function(){
  moduleBase.controller('StoreInfoController', ['$scope', 'AjaxUrlAccess', function($scope, AjaxUrlAccess) {
    $scope.storeInfo = <?php echo $storeInfo; ?>;
  }]);
  angular.bootstrap($('#storeInfo'), ['moduleBase']);
});
</script>
<!-- ▲ Script -->
