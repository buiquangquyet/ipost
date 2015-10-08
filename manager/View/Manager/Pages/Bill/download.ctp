<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li class="actice"><?php echo __('発行IDダウンロード'); ?></li>
</ol>

<h2><?php echo __('発行IDダウンロード'); ?><small>&nbsp;|&nbsp;<?php echo __('販売管理'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><?php echo __('発行IDダウンロード'); ?></div>

  <div class="panel-body">
    <p class="help-block"><?php echo __('代理店ごとに発行しているクライアントのリストをCSV出力させます。'); ?><br><?php echo __('下記フォームから、対象の代理店、出力させる期間を選択してダウンロードボタンを押してください。'); ?></p>
    <hr>
  </div>


  <?php echo $this->Form->create(false, array('action' => 'download', 'novalidate' => true)); ?>
    <div class="panel-body form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('会社名'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('Bill.parent_id', array('type' => 'select', 'options' => $parentList, 'div' => false, 'label' => false, 'class' => 'form-control'));?>
          <p class="help-block"><?php echo __('ダウンロードする情報の代理店を選択してください。'); ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('年月'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('Bill.year', array('type' => 'select', 'options' => $optYear,'selected' => date('Y'), 'div' => false, 'label' => false, 'class' => 'form-control'));?>&nbsp;<?php echo __('年'); ?>&nbsp;
          <?php echo $this->Form->input('Bill.month', array('type' => 'select', 'options' => $optMonth,'selected' => date('m'), 'div' => false, 'label' => false, 'class' => 'form-control'));?>&nbsp;<?php echo __('月'); ?>&nbsp;
          <?php echo $this->Form->input('Bill.type', array('type' => 'select', 'options' => array(__('以前'), __('以降'), __('のみ')), 'div' => false, 'label' => false, 'class' => 'form-control'));?>
          <p class="help-block"><?php echo __('対象の年月を選択してください。'); ?></p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button class="btn btn-default" onclick="return confirm('<?php echo __('発行ID一覧をダウンロードします\nよろしいですか'); ?>');"><?php echo __('ダウンロード'); ?></button>
        </div>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>

</div>
