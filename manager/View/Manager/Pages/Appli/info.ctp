<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/inspect/list">審査申請アプリ一覧</a></li>
  <li class="actice">アプリ情報</li>
</ol>

<h2>アプリ情報<small>&nbsp;|&nbsp;アプリ審査</small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <div class="panel-body">
    <?php echo __('言語選択'); ?>
    <?php echo $this->Form->input('lang_setting', array('type' => 'select', 'options' => $lang_setting, 'label' => false, 'div' => false, 'class' => 'form-select', 'value' => $current_status, 'onchange' => 'searchStatus();'));?>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">トップ画面に関する情報</div>
  <div class="panel-body">
    <iframe src="<?php echo $admin_domain; ?>/BlockPreview?user_id=<?php echo $admin_id; ?>&amp;lang=<?php echo $current_status; ?>" id="preview" name="preview" width="304" height="630" style="border-style:none;"><?php echo __('この部分はインラインフレームを使用しています。'); ?></iframe>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">ニュース画面に関する情報</div>
    <iframe src="<?php echo $admin_domain; ?>/NewsPreview?user_id=<?php echo $admin_id; ?>&amp;lang=<?php echo $current_status; ?>" id="preview" name="preview" width="304" height="630" style="border-style:none;"><?php echo __('この部分はインラインフレームを使用しています。'); ?></iframe>
</div>

<div class="panel panel-default">
  <div class="panel-heading">メニュー画面に関する情報</div>
    <iframe src="<?php echo $admin_domain; ?>/MenuPreview?user_id=<?php echo $admin_id; ?>&amp;lang=<?php echo $current_status; ?>" id="preview" name="preview" width="304" height="630" style="border-style:none;"><?php echo __('この部分はインラインフレームを使用しています。'); ?></iframe>
</div>

<div class="panel panel-default">
  <div class="panel-heading">クーポン画面に関する情報</div>
    <iframe src="<?php echo $admin_domain; ?>/CouponPreview?user_id=<?php echo $admin_id; ?>&amp;lang=<?php echo $current_status; ?>" id="preview" name="preview" width="304" height="630" style="border-style:none;"><?php echo __('この部分はインラインフレームを使用しています。'); ?></iframe>
</div>

<div class="panel panel-default">
  <div class="panel-heading">店舗情報画面に関する情報</div>
    <iframe src="<?php echo $admin_domain; ?>/ShopPreview/profile?user_id=<?php echo $admin_id; ?>&amp;lang=<?php echo $current_status; ?>" id="preview" name="preview" width="304" height="630" style="border-style:none;"><?php echo __('この部分はインラインフレームを使用しています。'); ?></iframe>
</div>

<a href="/inspect/list" class="btn btn-default mb_20">一覧に戻る</a>

<script type="text/javascript">
function searchStatus() {
  var status = $('#lang_setting').val();
  window.location.href = '<?php echo FULL_BASE_URL; ?>/appli/info/<?php echo $admin_id; ?>/' + status;
};
</script>