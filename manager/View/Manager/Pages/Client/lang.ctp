<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/client/list"><?php echo __('クライアント一覧'); ?></a></li>
  <li><a href="/client/info/<?php echo $id;?>"><?php echo __('クライアント情報'); ?></a></li>
  <li class="actice"><?php echo __('対応言語'); ?></li>
</ol>

<h2><?php echo __('対応言語'); ?><small>&nbsp;|&nbsp;<?php echo __('クライアント'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div id="shopInfo" class="panel panel-default">
  <div class="panel-heading"><?php echo __('入力フォーム'); ?></div>

  <?php echo $this->Form->create(false); ?>
    <div class="panel-body form-horizontal">

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('対応言語'); ?></label>
        <div class="col-sm-10">
          <label><?php echo $this->Form->input('0.UserLang.lang', array('type' => 'checkbox', 'div' => false, 'label' => false, 'value' => 'ja')); ?>&nbsp;<img src="/img/common/flag_icons/ja.png" alt="" height="16">&nbsp;<?php echo __('日本語版アプリ'); ?></label><br>
          <label><?php echo $this->Form->input('1.UserLang.lang', array('type' => 'checkbox', 'div' => false, 'label' => false, 'value' => 'en')); ?>&nbsp;<img src="/img/common/flag_icons/en.png" alt="" height="16">&nbsp;<?php echo __('英語版アプリ'); ?></label><br>
          <label><?php echo $this->Form->input('2.UserLang.lang', array('type' => 'checkbox', 'div' => false, 'label' => false, 'value' => 'zh')); ?>&nbsp;<img src="/img/common/flag_icons/zh.png" alt="" height="16">&nbsp;<?php echo __('広東語版アプリ'); ?></label><br>
          <label><?php echo $this->Form->input('3.UserLang.lang', array('type' => 'checkbox', 'div' => false, 'label' => false, 'value' => 'vi')); ?>&nbsp;<img src="/img/common/flag_icons/vi.png" alt="" height="16">&nbsp;<?php echo __('ベトナム語版アプリ'); ?></label>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->Form->submit(__('更新'), array('class' => 'btn btn-default', 'onclick' => 'return confirm("'.__('対応言語を更新します。\nよろしいですか').'");')); ?>
        </div>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>

<a href="/client/list" class="btn btn-default"><?php echo __('一覧に戻る'); ?></a>
