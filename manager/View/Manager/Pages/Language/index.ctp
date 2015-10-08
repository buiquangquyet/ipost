<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li class="actice"><?php echo __('言語マップ管理'); ?></li>
</ol>

<h2><?php echo __('言語マップ管理'); ?><small>&nbsp;|&nbsp;<?php echo __('言語マップ管理'); ?></small></h2>

<p class="help-block">端末によって変わってくる言語設定を、なるべく統一するように変換比較表を作成します。</p>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-users"></i>&nbsp;言語マップ管理</div>
    <div class="list-group">
      <a href="/language/list" class="list-group-item">言語マップ一覧</a>
      <a href="/language/add" class="list-group-item">言語マップ登録</a>
    </div>
  </div>
</div>
