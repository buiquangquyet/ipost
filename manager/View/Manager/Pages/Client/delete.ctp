<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/client/list"><?php echo __('クライアント一覧'); ?></a></li>
  <li><a href="/client/info/<?php echo $userInfo['User']['id']; ?>"><?php echo __('クライアント情報'); ?></a></li>
  <li class="actice"><?php echo __('クライアント削除'); ?></li>
</ol>

<h2><?php echo __('クライアント削除'); ?><small>&nbsp;|&nbsp;<?php echo __('クライアント'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-danger">
  <div class="panel-heading"><?php echo __('クライアント削除'); ?></div>

  <div class="panel-body">
    <p class="help-block"><?php echo __('以下のクライアントを削除します。'); ?></p>
  </div>

  <?php echo $this->Form->create(false, array('url' => array('action' => 'delete', $userInfo['User']['id']), 'novalidate' => true)); ?>
    <div class="panel-body form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('氏名'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('User.user_name', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => __('氏名'), 'readonly'));?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('氏名（ふりがな）'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('User.user_name_furi', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => __('氏名（ふりがな）'), 'readonly'));?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('メールアドレス'); ?></label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('User.email', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => __('メールアドレス'), 'readonly'));?>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <?php echo $this->Form->input('User.status', array('type' => 'hidden', 'value' => 9));?>
          <button class="btn btn-danger" onclick="return confirm('<?php echo __('クライアント情報を削除します。\nよろしいですか'); ?>');"><?php echo __('削除'); ?></button>
        </div>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>

<a href="/client/info/<?php echo $userInfo['User']['id']; ?>" class="btn btn-default"><?php echo __('詳細に戻る'); ?></a>
