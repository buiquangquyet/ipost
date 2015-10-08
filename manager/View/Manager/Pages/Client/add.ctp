<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/client/list"><?php echo __('クライアント一覧'); ?></a></li>
  <li class="actice"><?php echo __('クライアント新規登録'); ?></li>
</ol>

<h2><?php echo __('クライアント新規登録'); ?><small>&nbsp;|&nbsp;<?php echo __('クライアント'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div id="shopInfo" class="panel panel-default" ng-controller="shopInfoController">
  <div class="panel-heading"><?php echo __('入力フォーム'); ?></div>

  <?php echo $this->Form->create(false, array('controller' => 'client', 'action' => 'add', 'novalidate' => true)); ?>
    <div class="panel-body form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('所属代理店'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('UserRelation.parent_id', array('type' => 'select', 'options' => $parentList, 'div' => false, 'label' => false, 'class' => 'form-control'));?>
          <p class="help-block"><?php echo __('所属する代理店を選択してください。'); ?></p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('氏名'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('User.user_name', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => __('氏名')));?>
          <p class="help-block"><?php echo __('255文字以内まで入力できます'); ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('氏名（ふりがな）'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('User.user_name_furi', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => __('氏名（ふりがな）')));?>
          <p class="help-block"><?php echo __('255文字以内まで入力できます'); ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('メールアドレス'); ?></label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('User.email', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => __('メールアドレス')));?>
            <p class="help-block"><?php echo __('ログイン時にひつようになります。'); ?><br><?php echo __('登録済みのメールアドレスはご利用できません。'); ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('パスワード'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('User.password', array('type' => 'password', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => __('パスワード')));?>
          <p class="help-block"></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('対応言語'); ?></label>
        <div class="col-sm-10">
          <label><?php echo $this->Form->input('0.UserLang.lang', array('type' => 'checkbox', 'div' => false, 'label' => false, 'hiddenField' => false, 'value' => 'ja')); ?>&nbsp;<img src="/img/common/flag_icons/ja.png" alt="" height="16">&nbsp;<?php echo __('日本語版アプリ'); ?></label><br>
          <label><?php echo $this->Form->input('1.UserLang.lang', array('type' => 'checkbox', 'div' => false, 'label' => false, 'hiddenField' => false, 'value' => 'en')); ?>&nbsp;<img src="/img/common/flag_icons/en.png" alt="" height="16">&nbsp;<?php echo __('英語版アプリ'); ?></label><br>
          <label><?php echo $this->Form->input('2.UserLang.lang', array('type' => 'checkbox', 'div' => false, 'label' => false, 'hiddenField' => false, 'value' => 'zh')); ?>&nbsp;<img src="/img/common/flag_icons/zh.png" alt="" height="16">&nbsp;<?php echo __('広東語版アプリ'); ?></label><br>
          <label><?php echo $this->Form->input('3.UserLang.lang', array('type' => 'checkbox', 'div' => false, 'label' => false, 'hiddenField' => false, 'value' => 'vi')); ?>&nbsp;<img src="/img/common/flag_icons/vi.png" alt="" height="16">&nbsp;<?php echo __('ベトナム語版アプリ'); ?></label>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('テンプレート言語'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('User.lang', array('type' => 'select', 'options' => Configure::read('LanguagesList'), 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
          <p class="help-block">送信されるメールの内容言語を選択できます。<br>選択されない場合は、日本語のテンプレートで送信されます。</p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <?php echo $this->Form->input('User.type', array('type' => 'hidden', 'div' => false, 'label' => false, 'value' => USER_TYPE_KO));?>
          <?php echo $this->Form->input('User.status', array('type' => 'hidden', 'div' => false, 'label' => false, 'value' => USER_STATUS_ENABLE));?>
          <button class="btn btn-default" onclick="return confirm('<?php echo __('クライアント情報を登録します。\nよろしいですか'); ?>');"><?php echo __('登録'); ?></button>
        </div>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>

<a href="/client/list" class="btn btn-default"><?php echo __('一覧に戻る'); ?></a>
