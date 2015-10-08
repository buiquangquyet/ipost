<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/agent/list"><?php echo __('代理店一覧'); ?></a></li>
  <li><a href="/agent/info/<?php echo $userInfo['User']['id'];?>"><?php echo __('代理店情報'); ?></a></li>
  <li class="actice"><?php echo __('基本情報編集'); ?></li>
</ol>

<h2><?php echo __('基本情報編集'); ?><small>&nbsp;|&nbsp;<?php echo __('代理店'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <div class="panel-body">
    <a href="/agent/edit_detail/<?php echo $userInfo['User']['id'];?>"><?php echo __('会社情報変種'); ?></a>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading"><?php echo __('入力フォーム'); ?></div>

  <?php echo $this->Form->create(false, array('url' => array('action' => 'edit_info', $userInfo['User']['id']), 'novalidate' => true)); ?>
    <div class="panel-body form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('氏名'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('User.user_name', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => __('氏名')));?>
          <p class="help-block"><?php echo __('代理店の担当者名を入力してください。'); ?><br><?php echo __('255文字まで入力できます。'); ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('氏名（ふりがな）'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('User.user_name_furi', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => __('氏名（ふりがな）')));?>
          <p class="help-block"><?php echo __('代理店の担当者名を入力してください。'); ?><br><?php echo __('255文字まで入力できます。'); ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('メールアドレス'); ?></label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('User.email', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => __('メールアドレス')));?>
            <p class="help-block"><?php echo __('ログイン時にひつようになります。'); ?><br><?php echo __('登録済みのメールアドレスはご利用できません。'); ?></p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button class="btn btn-default" onclick="return confirm('<?php echo __('基本情報を更新します。\nよろしいですか'); ?>');"><?php echo __('更新'); ?></button>
        </div>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>

<a href="/agent/info/<?php echo $userInfo['User']['id']; ?>" class="btn btn-default"><?php echo __('詳細に戻る'); ?></a>
