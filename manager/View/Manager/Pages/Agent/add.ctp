<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/agent/list"><?php echo __('代理店一覧'); ?></a></li>
  <li class="actice"><?php echo __('代理店新規登録'); ?></li>
</ol>

<h2><?php echo __('代理店新規登録'); ?><small>&nbsp;|&nbsp;<?php echo __('代理店'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div id="shopInfo" class="panel panel-default" ng-controller="shopInfoController">
  <div class="panel-heading"><?php echo __('入力フォーム'); ?></div>

  <?php echo $this->Form->create(false, array('controller' => 'agent', 'action' => 'add', 'novalidate' => true)); ?>
    <div class="panel-body form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('会社名'); ?></label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('UserDetail.company_name', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => __('会社名')));?>
          <p class="help-block"><?php echo __('255文字以内まで入力できます'); ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('氏名'); ?></label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('User.user_name', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => __('氏名')));?>
          <p class="help-block"><?php echo __('255文字以内まで入力できます'); ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('氏名（ふりがな）'); ?></label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('User.user_name_furi', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => __('氏名（ふりがな）')));?>
          <p class="help-block"><?php echo __('255文字以内まで入力できます'); ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('メールアドレス'); ?></label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('User.email', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => __('メールアドレス')));?>
            <p class="help-block"><?php echo __('ログイン時にひつようになります。<br>登録済みのメールアドレスはご利用できません。'); ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('パスワード'); ?></label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('User.password', array('type' => 'password', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => __('パスワード')));?>
          <p class="help-block"></p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <?php echo $this->Form->input('User.type', array('type' => 'hidden', 'div' => false, 'label' => false, 'value' => USER_TYPE_OYA));?>
          <?php echo $this->Form->input('User.status', array('type' => 'hidden', 'div' => false, 'label' => false, 'value' => USER_STATUS_ENABLE));?>
          <button class="btn btn-default" onclick="return confirm('<?php echo __('代理店情報を登録します。\nよろしいですか'); ?>');"><?php echo __('登録'); ?></button>
        </div>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>

<a href="/agent/list" class="btn btn-default"><?php echo __('一覧に戻る'); ?></a>
