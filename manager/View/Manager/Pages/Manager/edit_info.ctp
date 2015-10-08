<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/manager/list">マスター一覧</a></li>
  <li><a href="/manager/info/<?php echo $userInfo['User']['id'];?>">マスター情報</a></li>
  <li class="actice">マスター情報編集</li>
</ol>

<h2>マスター情報編集<small>&nbsp;|&nbsp;マスター</small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div id="shopInfo" class="panel panel-default" ng-controller="shopInfoController">
  <div class="panel-heading">入力フォーム</div>

  <?php echo $this->Form->create(false, array('url' => array('action' => 'edit_info', $userInfo['User']['id']), 'novalidate' => true)); ?>
    <div class="panel-body">
      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label">マスターID</label>
          <div class="col-sm-10">
            <p class="form-control-static"><?php echo $userInfo['User']['id'];?></p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">氏名</label>
          <div class="col-sm-10">
            <?php echo $this->Form->input('User.user_name', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => '氏名'));?>
            <p class="help-block">255文字以内まで入力できます</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">メールアドレス</label>
          <div class="col-sm-10">
            <?php echo $this->Form->input('User.email', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => 'メールアドレス'));?>
            <p class="help-block">ログイン時にひつようになります。<br>登録済みのメールアドレスはご利用できません。</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">古いパスワード</label>
          <div class="col-sm-10">
            <?php echo $this->Form->input('User.password', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => '古いパスワード', 'value' => ''));?>
            <p class="help-block">パスワードを変更する場合は、「古いパスワード」と「新しいパスワード」を入力してください。</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">新しいパスワード</label>
          <div class="col-sm-10">
            <?php echo $this->Form->input('User.password', array('type' => 'password', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => '新しいパスワード', 'value' => ''));?>
            <p class="help-block">パスワードを変更する場合は、「古いパスワード」と「新しいパスワード」を入力してください。</p>
          </div>
        </div>

        <hr>

        <div class="form-group">
          <label class="col-sm-2 control-label">&nbsp;</label>
          <div class="col-sm-10">
          <a href="/manager/info/<?php echo $userInfo['User']['id'];?>" class="btn btn-default">詳細に戻る</a>
          <button class="btn btn-default" onclick="return confirm('基本情報を更新します。\nよろしいですか');">更新</button>
          </div>
        </div>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>

<!-- ▼ Script -->
<script type="text/javascript">
registShopInfo = function(id) {
  if (window.confirm('マスター情報を更新します。よろしいですか')) {
    resultObject = AjaxUrlAccess.postData(id);
    $scope.validate = resultObject.error;
    $scope.shopInfo.process = resultObject.result;
  };
};
</script>
<!-- ▲ Script -->
