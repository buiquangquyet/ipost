<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li class="actice"><?php echo __('言語マップ一覧'); ?></li>
</ol>

<h2><?php echo __('言語マップ一覧'); ?><small>&nbsp;|&nbsp;<?php echo __('言語マップ'); ?></small></h2>

<p class="help-block">端末によって変わってくる言語設定を、なるべく統一するように変換比較表を作成します。<br>"言語"から"対応言語"に変換を行います。</p>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<a href="/language/add" class="btn btn-default mb_20"><?php echo __('言語マップ登録'); ?></a>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><?php echo __('言語マップ一覧'); ?></div>
  <table class="table">
    <thead>
      <tr>
        <th><?php echo $this->Paginator->sort('LangMap.id', 'ID'); ?></th>
        <th><?php echo $this->Paginator->sort('LangMap.lang_before', '言語'); ?></th>
        <th><?php echo $this->Paginator->sort('LangMap.lang_after', '対応言語'); ?></th>
        <th><?php echo __('操作'); ?></th>
      </tr>
    </thead>
    <tbody>
<?php foreach ($list as $item) : ?>
      <tr id="item_<?php echo $item['LangMap']['id']; ?>">
        <td><span class="num"><?php echo $item['LangMap']['id']; ?></span></td>
        <td><?php echo $item['LangMap']['lang_before']; ?></td>
        <td><?php echo $item['LangMap']['lang_after']; ?></td>
        <td>
          <a href="/language/edit/<?php echo $item['LangMap']['id']; ?>"><?php echo __('編集'); ?></a>&nbsp;|&nbsp;
          <a href="/language/del/<?php echo $item['LangMap']['id']; ?>" class="delete text-danger" data-lang-id="<?php echo $item["LangMap"]['id'] ?>"><?php echo __('削除'); ?></a>
        </td>
      </tr>
<?php endforeach; ?>
    </tbody>
  </table>
</div>

<script type="text/javascript">
$('a.delete').click(function(e){
  if (confirm('言語マップを削除します。\nよろしいですか')) {
    var id = $(this).data('lang-id');
    console.log("message: "+id);
    // TODO: get を postにするとエラーになってしまう...
    $.get('/language/del/'+id, {},
      function(res){
        console.log("message: "+res.status);
        if (res == null || res.status == 0) {
          return;
        }
        if (res.status == 'success') {
          $('#item_'+id).fadeOut();
        }
      }, 'json');
  };
  return false;
});
</script>
