<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li class="actice">リジェクト選択項目登録</li>
</ol>

<h2>リジェクト選択項目登録<small>&nbsp;|&nbsp;アプリ審査</small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <div class="panel-heading">入力フォーム</div>

  <?php echo $this->Form->create(false, array('url' => array('controller' => '/support/reject/', 'action' => 'edit', $itemInfo['InspectRejectItem']['id']), 'novalidate' => false)); ?>
    <div class="panel-body form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label">リジェクト項目名</label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('InspectRejectItem.title', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => 'リジェクト項目名'));?>
          <p class="help-block">255文字以内まで入力できます。</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">リジェクト項目内容</label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('InspectRejectItem.comment', array('type' => 'textarea', 'div' => false, 'label' => false, 'class'=>'form-control mb_10', 'placeholder' => 'リジェクト項目内容'));?>
          <p class="help-block">リジェクト項目の説明文を入力してください。</p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('InspectRejectItem.type', array('type' => 'hidden', 'div' => false, 'label' => false, 'value' => InspectRejectItem::REJECT_TYPE_NORMAL));?>
          <button class="btn btn-default" onclick="return confirm('リジェクト選択項目を更新します。\nよろしいですか');">更新</button>
        </div>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>

<a href="/support/reject/list" class="btn btn-default mb_20">一覧に戻る</a>
