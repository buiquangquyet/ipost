<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li class="actice">マスター一覧</li>
</ol>

<h2>マスター一覧<small>&nbsp;|&nbsp;マスター</small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<a href="/manager/add" class="btn btn-default mb_20">マスター新規登録</a>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">マスター一覧</div>

  <!-- Table -->
  <table class="table">
    <thead>
      <tr>
        <th><?php echo $this->Paginator->sort('User.id', __('ID')); ?></th>
        <th><?php echo $this->Paginator->sort('User.user_name', __('氏名')); ?></th>
        <th><?php echo $this->Paginator->sort('User.email', __('メールアドレス')); ?></th>
        <th><?php echo $this->Paginator->sort('User.status', __('状態')); ?></th>
        <th><?php echo $this->Paginator->sort('User.last_login', __('最終ログイン日時')); ?></th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
<?php foreach ($users as $user) : ?>
<?php if ($user['User']['status'] == 1) : ?>
      <tr class="list-group-item-info">
<?php elseif ($user['User']['status'] == 3) : ?>
      <tr class="list-group-item-warning">
<?php elseif ($user['User']['status'] == 9) : ?>
      <tr class="list-group-item-danger">
<?php else : ?>
      <tr>
<?php endif; ?>
        <td><span class="num"><?php echo $user['User']['id']; ?></span></td>
        <td><a href="/manager/info/<?php echo $user['User']['id']; ?>"><?php echo $user['User']['user_name']; ?></a></td>
        <td><?php echo $user['User']['email']; ?></td>
        <td><?php echo $user['User']['status_disp']; ?></td>
        <td><?php echo $user['User']['last_login']; ?></td>
<?php if ($user['User']['status'] == 1) : ?>
        <td><a href="/manager/permit/<?php echo $user['User']['id']; ?>"><?php echo __('詳細'); ?></a></td>
<?php else : ?>
        <td><a href="/manager/info/<?php echo $user['User']['id']; ?>"><?php echo __('詳細'); ?></a></td>
<?php endif; ?>
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