<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li class="actice"><?php echo __('クライアント一覧'); ?></li>
</ol>

<h2><?php echo __('クライアント一覧'); ?><small>&nbsp;|&nbsp;<?php echo __('クライアント'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<a href="/client/add" class="btn btn-default mb_20"><?php echo __('アカウント新規登録'); ?></a>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><?php echo __('クライアント一覧'); ?></div>
  <table class="table">
    <thead>
      <tr>
        <th><?php echo $this->Paginator->sort('User.id', 'ID'); ?></th>
        <th><?php echo $this->Paginator->sort('User.user_name', '氏名'); ?></th>
        <th><?php echo $this->Paginator->sort('User.email', 'メールアドレス'); ?></th>
        <th><?php echo __('所属代理店'); ?></th>
        <th><?php echo __('対応言語'); ?></th>
        <th><?php echo $this->Paginator->sort('User.status', __('状態')); ?></th>
        <th><?php echo $this->Paginator->sort('User.last_login', '最終ログイン日時'); ?></th>
        <th><?php echo __('操作'); ?></th>
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
        <td><a href="/client/info/<?php echo $user['User']['id']; ?>"><?php echo $user['User']['user_name']; ?></a></td>
        <td><?php echo $user['User']['email']; ?></td>
        <td><a href="/agent/info/<?php echo $user['Agent'][0]['User']['id']; ?>"><?php echo $user['Agent'][0]['User']['user_name']; ?></a></td>
        <td>
          <?php if (empty($user['UserLang'])) : ?>
            未設定
          <?php else: ?>
          <?php foreach ($user['UserLang'] as $key => $lang) : ?>
            <img src="/img/common/flag_icons/<?php echo $lang['lang']; ?>.png">
          <?php endforeach; ?>
          <?php endif; ?>
        </td>
        <td><?php echo $user['User']['status_disp']; ?></td>
        <td><?php echo $user['User']['last_login']; ?></td>
        <td><a href="/client/info/<?php echo $user['User']['id']; ?>"><?php echo __('詳細'); ?></a></td>
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
