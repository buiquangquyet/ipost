<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/manager/list">マスター一覧</a></li>
  <li class="actice">マスター情報</li>
</ol>

<h2>マスター情報<small>&nbsp;|&nbsp;マスター</small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <div class="panel-heading">マスター基本情報</div>

  <div class="panel-body">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label">マスターID</label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo $userInfo['User']['id']?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">氏名</label>
        <div class="col-sm-10">
          <p class="ruby-block"><small><?php echo $userInfo['User']['user_name_furi']; ?></small></p>
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
        <label class="col-sm-2 control-label">最終ログイン日時</label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo $userInfo['User']['last_login']?></p>
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
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          <a href="/manager/edit_info/<?php echo $userInfo['User']['id']?>" class="btn btn-default">編集</a>
        </div>
      </div>

    </div>
  </div>
</div>

<a href="/manager/list" class="btn btn-default mb_20">一覧に戻る</a>

<div class="panel panel-danger">
  <div class="panel-heading">マスター削除</div>
  <div class="panel-body">
    <a href="/manager/delete/<?php echo $userInfo['User']['id'];?>">マスター削除</a>
  </div>
</div>

<a href="/manager/list" class="btn btn-default">一覧に戻る</a>
