<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li class="actice">アプリ公開数</li>
</ol>

<h2>アプリ公開数<small>&nbsp;|&nbsp;統計表示</small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="well well-sm">
  <a href="/statistics/app">アプリ公開数</a>&nbsp;|&nbsp;
  <a href="/statistics/download">ダウンロード数</a>&nbsp;|&nbsp;
  <!-- <a href="/statistics/pref">都道府県ごと</a> -->
</div>

<div class="panel panel-default">
  <div class="panel-heading">アプリ公開数</div>
  <div class="panel-body">
      現在:&nbsp;0 個
  </div>
</div>
