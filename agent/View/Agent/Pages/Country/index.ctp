<div class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('国管理'); ?><?php //echo __('国の一覧'); ?></div>
  <h2><i class="fa fa-life-ring">&nbsp;</i><?php echo __('国管理'); ?></span></h2>

  <h3><i class="fa fa-list">&nbsp;</i><?php echo __('国の一覧'); ?></h3>
  <fieldset>
	<div role="alert">
      <?php echo $this->Session->flash(); ?>
    </div>

    <div><a href="/country/add">&gt;&gt;<?php echo __('新規国の登録'); ?></a></div>

    <table border="1" bordercolor="#CCCCCC" cellspacing="0" cellpadding="10" class="list">
      <thead>
        <tr>
          <th><?php echo __('ID'); ?></th>
          <th><?php echo __('国名'); ?></th>
          <th><?php echo __('ステータス'); ?></th>
          <th><?php echo __('操作'); ?></th>
        </tr>
      </thead>
      <tbody>
<?php foreach ($countries as $country) : ?>
        <tr>
          <td><span class="num"><?php echo $country['Country']['id']; ?></span></td>
          <td><?php echo $country['Country']['name']; ?></td>
          <td><?php if($country['Country']['status'] == 1) echo '<i class="fa fa-circle" style="color:green;"></i>'; else echo '<i class="fa fa-circle" style="color:#c3c3c3;"></i>';?></td>
          <td>
          	<div><a target="_self" href="/country/listcity/<?php echo $country['Country']['id']?>" class="simple-link"><?php echo __('都市の一覧'); ?></a></div>
          	<!-- <a href="/country/view/<?php echo $country['Country']['id']; ?>" class="simple-link"><?php echo __('詳細'); ?></a><br /> -->
          	<a href="/country/edit/<?php echo $country['Country']['id']; ?>" class="simple-link"><?php echo __('編集'); ?></a><br />
          	<?php
                echo $this->Form->postLink(
                    __('削除'),
                    array('action' => 'delete', $country['Country']['id']),
                    array('confirm' => __('国情報を削除致します。宜しいでしょうか'), 'class' => "simple-link")
                );?>
          </td>
        </tr>
<?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="6" align="center">
            <?php //echo $this->Paginator->prev('< ' . __('前に戻る'), array(), null, array('class' => 'prev disabled'));?>
            <?php echo $this->Paginator->numbers(array('class' => 'paginate', 'currentClass'=>'active'));?>
            <?php //echo $this->Paginator->next(__('次へ') . ' >', array(), null, array('class' => 'next disabled'));?>
          </td>
        </tr>
      </tfoot>
    </table>
  </fieldset>
</div>
