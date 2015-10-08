<div class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('アカウント一覧'); ?></div>
  <h2><i class="fa fa-user">&nbsp;</i><?php echo __('ユーザー管理'); ?><span>｜<?php echo __('クライアント管理'); ?></span></h2>

  <div role="alert">
    <?php echo $this->Session->flash(); ?>
  </div>

  <h3><?php echo __('アカウント一覧'); ?></h3>
  <fieldset>

    <div><a href="/client/add">&gt;&gt;<?php echo __('新規登録'); ?></a></div>

    <table border="1" bordercolor="#CCCCCC" cellspacing="0" cellpadding="10" class="list">
      <thead>
        <tr>
          <th><?php echo __('ID'); ?></th>
          <th><?php echo __('氏名'); ?></th>
          <th><?php echo __('メールアドレス'); ?></th>
          <th><?php echo __('対応言語'); ?></th>
          <th><?php echo __('状態'); ?></th>
          <th><?php echo __('操作'); ?></th>
        </tr>
      </thead>
      <tbody>
<?php foreach ($list as $item) : ?>
<?php if ($item['User']['status'] == 1) : ?>
      <tr class="list-group-item-info">
<?php elseif ($item['User']['status'] == 3) : ?>
      <tr class="list-group-item-warning">
<?php elseif ($item['User']['status'] == 9) : ?>
      <tr class="list-group-item-danger">
<?php else : ?>
      <tr>
<?php endif; ?>
          <td><span class="num"><?php echo $item['User']['id']; ?></span></td>
          <td><?php echo $item['User']['user_name']; ?></td>
          <td><?php echo $item['User']['email']; ?></td>
          <td>
          <?php if (empty($item['UserLang'])) : ?>
            未選択
          <?php else: ?>
          <?php foreach ($item['UserLang'] as $key => $lang) : ?>
            <img src="/img/common/flag_icons/<?php echo $lang['lang']; ?>.png" alt="<?php echo $flag_name[$lang['lang']] ?>" title="<?php echo $flag_name[$lang['lang']] ?>">
          <?php endforeach; ?>
          <?php endif; ?>
          </td>
          <td><?php echo $item['User']['status_disp']; ?></td>
          <td><a href="/client/info/<?php echo $item['User']['id']; ?>" class="simple-link"><?php echo __('詳細'); ?></a></td>
        </tr>
<?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="6" align="center">
            <?php echo $this->Paginator->prev('< ' . __('前へ'), array(), null, array('class' => 'prev disabled'));?>
            <?php echo $this->Paginator->numbers(array('class' => 'paginate', 'currentClass'=>'active'));?>
            <?php echo $this->Paginator->next(__('次へ') . ' >', array(), null, array('class' => 'next disabled'));?>
          </td>
        </tr>
      </tfoot>
    </table>
  </fieldset>
</div>
