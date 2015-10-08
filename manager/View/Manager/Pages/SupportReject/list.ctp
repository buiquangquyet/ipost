<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li class="actice">リジェクト選択項目一覧</li>
</ol>

<h2>リジェクト選択項目一覧<small>&nbsp;|&nbsp;アプリ審査</small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<a href="/support/reject/add" class="btn btn-default mb_20">リジェクト選択項目登録</a>

<div class="panel panel-default">
  <div class="panel-heading">リジェクト選択項目一覧</div>

  <table class="table">
    <thead>
      <tr>
        <th><?php echo $this->Paginator->sort('InspectRejectItem.id', 'ID'); ?></th>
        <th><?php echo $this->Paginator->sort('InspectRejectItem.title', '項目名'); ?></th>
        <th><?php echo $this->Paginator->sort('InspectRejectItem.created', '登録日時'); ?></th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
<?php foreach ((array)$list as $item) : ?>
      <tr>
        <td><span class="num"><?php echo $item['InspectRejectItem']['id']; ?></span></td>
        <td><?php echo $item['InspectRejectItem']['title']; ?></td>
        <td><?php echo $item['InspectRejectItem']['created']; ?></td>
        <td><a href="/support/reject/edit/<?php echo $item['InspectRejectItem']['id']; ?>"><?php echo __('編集'); ?></a>&nbsp;|&nbsp;<a href="/support/reject/delete/<?php echo $item['InspectRejectItem']['id']; ?>"><?php echo __('削除'); ?></a></td>
      </tr>
<?php endforeach; ?>
    </tbody>
  </table>

  <div class="panel-footer txt_c">
    <?php echo $this->Paginator->prev(__('< 前へ'), array(), null, array('class' => 'prev disabled'));?>
    <?php echo $this->Paginator->numbers(array('class' => 'paginate', 'currentClass'=>'active'));?>
    <?php echo $this->Paginator->next(__('次へ >'), array(), null, array('class' => 'next disabled'));?>
  </div>
</div>
