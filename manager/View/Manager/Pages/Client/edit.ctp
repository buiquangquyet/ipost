<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/client/list"><?php echo __('クライアント一覧'); ?></a></li>
  <li><a href="/client/info/<?php echo $id;?>"><?php echo __('クライアント情報'); ?></a></li>
  <li class="actice"><?php echo __('基本情報編集'); ?></li>
</ol>

<h2><?php echo __('基本情報編集'); ?><small>&nbsp;|&nbsp;<?php echo __('クライアント'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="well well-sm">
  <a href="/client/edit/<?php echo $id; ?>"><?php echo __('基本情報編集'); ?></a>&nbsp;|&nbsp;
  <a href="/shop/edit/<?php echo $id; ?>"><?php echo __('お店情報の編集'); ?></a>
</div>

<div class="panel panel-default">
  <div class="panel-heading"><?php echo __('入力フォーム'); ?></div>

  <div class="panel-body form-horizontal">
    <?php echo $this->Form->create(false, array('url' => array('action' => 'edit', $id))); ?>
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('氏名'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('User.user_name', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => __('氏名')));?>
          <p class="help-block"><?php echo __('氏名を入力してください。'); ?><br><?php echo __('255文字まで入力できます。'); ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('氏名（ふりがな）'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('User.user_name_furi', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => __('氏名（ふりがな）')));?>
          <p class="help-block"><?php echo __('氏名を入力してください。'); ?><br><?php echo __('255文字まで入力できます。'); ?></p>
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
          <?php echo $this->Form->input('User.id', array('type' => 'hidden'));?>
          <button class="btn btn-default" onclick="return confirm('<?php echo __('基本情報を更新します。\nよろしいですか'); ?>');"><?php echo __('更新'); ?></button>
        </div>
      </div>
    <?php echo $this->Form->end(); ?>
  </div>
</div>

<a href="/client/info/<?php echo $id;?>" class="btn btn-default"><?php echo __('詳細に戻る'); ?></a>
