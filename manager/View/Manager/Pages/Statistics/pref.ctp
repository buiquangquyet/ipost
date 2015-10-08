<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li class="actice">都道府県ごと</li>
</ol>

<h2>都道府県ごと<small>&nbsp;|&nbsp;統計表示</small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="well well-sm">
  <a href="/statistics/app">アプリ公開数</a>&nbsp;|&nbsp;
  <a href="/statistics/download">ダウンロード数</a>&nbsp;|&nbsp;
  <a href="/statistics/pref">都道府県ごと</a>
</div>

<div class="row">
  <!-- ▼ 左 -->
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">代理店数</div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="col-md-8">都道府県</th>
            <th class="col-md-4">登録人数（人）</th>
          </tr>
        </thead>
        <tbody>
<?php foreach ($list as $key => $item) : ?>
          <tr>
            <td><?php echo $item['pref_name']; ?></td><td>0</td>
          </tr>
<?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- ▲ 左 -->

  <!-- ▼ 右 -->
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">クライアント数</div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="col-md-8">都道府県</th>
            <th class="col-md-4">登録人数（人）</th>
          </tr>
        </thead>
        <tbody>
<?php foreach ($list as $key => $item) : ?>
          <tr>
            <td><?php echo $item['pref_name']; ?></td><td>0</td>
          </tr>
<?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- ▲ 右 -->
</div>
