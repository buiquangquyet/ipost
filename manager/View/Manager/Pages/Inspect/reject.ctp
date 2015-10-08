<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/inspect/list"><?php echo __('審査申請アプリ一覧'); ?></a></li>
  <li class="actice"><?php echo __('審査申請結果通知'); ?></li>
</ol>

<h2><?php echo __('審査申請結果通知'); ?><small>&nbsp;|&nbsp;<?php echo __('アプリ審査'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <div class="panel-heading"><?php echo __('審査リジェクト'); ?></div>
  <div class="panel-body">
    <p><?php echo __('簡易審査のリジェクト処理を行いました。'); ?></p>
    <hr>
    <a href="/inspect/list" class="btn btn-default"><?php echo __('戻る'); ?></a>
  </div>
</div>
