<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/manager/list"><?php echo __('マスター一覧'); ?></a></li>
  <li><a href="/manager/info/<?php echo $userInfo['User']['id'];?>">マスター情報</a></li>
  <li class="actice">マスター削除</li>
</ol>

<h2>マスター削除<small>&nbsp;|&nbsp;<?php echo __('マスター'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-danger">
  <div class="panel-heading">マスター削除</div>

  <div class="panel-body">
    <p class="help-block">以下の代理店を削除します。</p>
  </div>

  <?php echo $this->Form->create(false, array('url' => array('action' => 'delete', $userInfo['User']['id']), 'novalidate' => true)); ?>
    <div class="panel-body form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label">氏名</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('User.user_name', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '氏名', 'readonly'));?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">氏名（ふりがな）</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('User.user_name_furi', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '氏名（ふりがな）', 'readonly'));?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">メールアドレス</label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('User.email', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => 'メールアドレス', 'readonly'));?>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('User.status', array('type' => 'hidden', 'value' => 9));?>
          <button class="btn btn-danger" onclick="return confirm('クライアント情報を削除します。\nよろしいですか');">削除</button>
        </div>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>

<a href="/manager/info/<?php echo $userInfo['User']['id']; ?>" class="btn btn-default">詳細に戻る</a>
