<style type="text/css">
a.list-group-item,a.list-group-item:focus,a.list-group-item:hover{ color: #337ab7; }
</style>

<ol class="breadcrumb">
  <li><a href="/">HOME</a></li>
  <li class="actice">サポート</li>
</ol>

<h2>サポート<small>&nbsp;|&nbsp;サポート</small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
    <div class="panel-heading">サポート関係</div>

    <div class="panel-body">
      <p>リジェクト選択項目(簡易審査)</p>
      <div class="list-group">
        <a href="/support/reject" class="list-group-item">リジェクト選択項目一覧</a>
        <a href="/support/reject" class="list-group-item">リジェクト選択項目登録</a>
      </div>

      <p>お知らせ[代理店サポート]</p>
      <div class="list-group">
        <a href="/support/info" class="list-group-item">お知らせ一覧</a>
        <a href="/support/info" class="list-group-item">お知らせ新規登録</a>
      </div>

      <p>ヘルプ(サポート)[代理店サポート]</p>
      <div class="list-group">
        <a href="/support/help" class="list-group-item">ヘルプ一覧(カテゴリ・ヘルプ内容)</a>
        <a href="/support/help" class="list-group-item">ヘルプよくある質問一覧</a>
      </div>
    </div>

    <div class="panel-footer"></div>
</div>
