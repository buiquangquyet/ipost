<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/manager/list">マスター一覧</a></li>
  <li class="actice">マスター発行依頼</li>
</ol>

<h2>マスター発行依頼<small>&nbsp;|&nbsp;マスター</small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <div class="panel-body form-horizontal">
    <?php echo $this->Form->create(false, array('url' => array('action' => 'permit', $userInfo['User']['id']), 'novalidate' => true)); ?>
      <div class="form-group">
        <label class="col-sm-2 control-label">仮マスターID</label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo $userInfo['User']['id']?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">氏名</label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo $userInfo['User']['user_name']?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">メールアドレス</label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo $userInfo['User']['email']?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">登録日時</label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo $userInfo['User']['created']?></p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <label class="col-sm-2 control-label">発行許可・却下</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('User.status', array('type' => 'select', 'options' => array('2' => '許可する', '3' => '却下する'), 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          <a href="/manager/list" class="btn btn-default">一覧に戻る</a>
            <button class="btn btn-default" onclick="return confirm('マスター発行依頼を更新します\nよろしいですか');">更新</button>
        </div>
      </div>
    <?php echo $this->Form->end(); ?>

  </div>
</div>


