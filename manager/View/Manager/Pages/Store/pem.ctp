<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/client/list">アカウント一覧</a></li>
  <li><a href="/client/info/<?php echo $userInfo['User']['id']; ?>">クライアント情報</a></li>
  <li class="actice">pemファイル</li>
</ol>

<h2>pemファイル<small>&nbsp;|&nbsp;クライアント</small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <div class="panel-heading">入力フォーム</div>

  <?php echo $this->Form->create(false, array('url' => array('action' => 'edit', $userInfo['User']['id']), 'type'=>'file', 'enctype' => 'multipart/form-data', 'novalidate' => true)); ?>
  <div class="panel-body form-horizontal">
    <div class="form-group">
      <label class="col-sm-2 control-label">pemファイル</label>
      <div class="col-sm-10">
        <?php echo $this->Form->input('Store.pem', array('label' => false, 'type' => 'file', 'multiple', 'class' => 'form-control mb_20'));?>
        <p class="help-block">pemファイルをアップロードしてください。</p>
      </div>
    </div>

    <hr>

    <div class="form-group">
      <label class="col-sm-2 control-label">&nbsp;</label>
      <div class="col-sm-10">
        <button class="btn btn-default" onclick="return confirm('pemファイルをアップロードします。\nよろしいですか');">アップロード</button>
      </div>
    </div>
  </div>
  <?php echo $this->Form->end(); ?>
</div>

<a href="/client/info/<?php echo $userInfo['User']['id'];?>" class="btn btn-default">詳細に戻る</a>
