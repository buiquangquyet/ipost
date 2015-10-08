<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li class="actice"><?php echo __('審査申請アプリ'); ?></li>
</ol>

<h2><?php echo __('審査申請アプリ'); ?><small>&nbsp;|&nbsp;<?php echo __('アプリ審査'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <div class="panel-heading"><?php echo __('審査申請アプリ'); ?></div>
    <div class="panel-body">
        <a href="/inspect/list"><?php echo __('審査申請アプリ一覧'); ?></a>
    </div>
</div>