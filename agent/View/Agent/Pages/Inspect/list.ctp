<div class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('アカウント一覧'); ?></div>
  <h2><i class="fa fa-file-text">&nbsp;</i><?php echo __('審査申請アプリ'); ?><span>｜<?php echo __('申請リスト'); ?></span></h2>

  <div role="alert">
    <?php echo $this->Session->flash(); ?>
  </div>

  <h3><?php echo __('アプリ一覧'); ?></h3>
  <fieldset>

    <table border="1" bordercolor="#CCCCCC" cellspacing="0" cellpadding="10" class="list">
      <thead>
        <tr>
          <th><?php echo __('申請日時'); ?></th>
          <th><?php echo __('申請者'); ?></th>
          <th><?php echo __('アプリ名'); ?></th>
          <th><?php echo __('状態'); ?></th>
          <th><?php echo __('アプリ情報'); ?></th>
          <th><?php echo __('ストア情報'); ?></th>
          <th><?php echo __('操作'); ?></th>
        </tr>
      </thead>
      <tbody>
<?php foreach ((array)$list as $item) : ?>
<?php if ($item['InspectRequest']['agent_result'] === '0') : ?>
      <tr class="list-group-item-danger">
<?php elseif ($item['InspectRequest']['master_result'] === '1') : ?>
      <tr class="list-group-item-success">
<?php elseif ($item['InspectRequest']['agent_result'] === '1') : ?>
      <tr class="list-group-item-info">
<?php else : ?>
      <tr>
<?php endif; ?>
          <td><?php echo $item['InspectRequest']['requeted']; ?></td><!-- 申請日時 -->
          <td><a href="/client/info/<?php echo $item['InspectRequest']['user_id']; ?>" class="simple-link"><?php echo $item['InspectRequest']['user_name']; ?></a></td><!-- 申請者 -->
          <td><?php echo $item['InspectRequest']['app_name']; ?></td><!-- アプリ名 -->
          <td><?php echo $item['InspectRequest']['status_disp']; ?></td><!-- 状態 -->
          <td><a href="/appli/info/<?php echo $item['InspectRequest']['user_id']; ?>" class="simple-link"><?php echo __('アプリ情報'); ?></a></td><!-- アプリ情報 -->
          <td><a href="/store/info/<?php echo $item['InspectRequest']['user_id']; ?>" class="simple-link"><?php echo __('ストア情報'); ?></a></td><!-- ストア情報 -->
          <td>
          <?php if ($item['InspectRequest']['agent_result'] === null) : ?>
            <a href="/inspect/info/<?php echo $item['InspectRequest']['id']; ?>" class="simple-link"><?php echo __('更新'); ?></a>
          <?php else: ?>
            ----
          <?php endif; ?>
          </td>
        </tr>
<?php endforeach; ?>
      </tbody>
    </table>
  </fieldset>
</div>
