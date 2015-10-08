<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li class="actice">お知らせ一覧</li>
</ol>

<h2>お知らせ一覧<small>&nbsp;|&nbsp;サポート</small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<a href="/support/info/add" class="btn btn-default mb_20">お知らせ新規登録</a>

<div class="panel panel-default">
  <div class="panel-heading">お知らせ一覧</div>
  <div class="panel-body"></div>
</div>
