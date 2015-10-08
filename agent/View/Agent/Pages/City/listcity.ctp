<div class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<a href="/country/lists"><?php echo __('国管理'); ?></a>&nbsp;>&nbsp;<?php echo __('都市の一覧'); ?></div>
  <h2><i class="fa fa-star">&nbsp;</i><?php echo __('都市の一覧'); ?></h2>

  <h3><i class="fa fa-list">&nbsp;</i><?php echo __('%s のリストの市', $countries['Country']['name']); ?></h3>
  <fieldset>
	<div role="alert">
      <?php echo $this->Session->flash(); ?>
    </div>
  
    <div>
    	<a href="/city/addcity/<?php echo $countries['Country']['id']?>" style="float:left;">&gt;&gt;<?php echo __('新規都市の登録'); ?></a>
    	<a href="/country/importcity/<?php echo $countries['Country']['id']?>" style="min-width:215px; float:left; margin-left: 10px;">&gt;&gt;<?php echo __('リストをインポート'); ?></a>
    </div>

    <table border="1" bordercolor="#CCCCCC" cellspacing="0" cellpadding="10" class="list">
      <thead>
        <tr>
          <th><?php echo __('ID'); ?></th>
          <th><?php echo __('市名'); ?></th>
          <th><?php echo __('郵便番号'); ?></th>
          <th><?php echo __('ステータス'); ?></th>
          <th><?php echo __('国'); ?></th>
          <th><?php echo __('操作'); ?></th>
        </tr>
      </thead>
      <tbody>
<?php foreach ($cities as $ct) : ?>
        <tr>
          <td><span class="num"><?php echo $ct['City']['id']; ?></span></td>
          <td><?php echo $ct['City']['name']; ?></td>
          <td><?php echo $ct['City']['code']; ?></td>
          <td><?php if($ct['City']['status'] == 1) echo '<i class="fa fa-circle" style="color:green;"></i>'; else echo '<i class="fa fa-circle" style="color:#c3c3c3;"></i>';?></td>
          <td><a href="/country/view/<?php echo $ct['City']['countries_id'];?>" class="simple-link"><?php echo $countries['Country']['name']; ?></a></td>
          <td>
          	<!-- <a href="/city/view/<?php echo $ct['City']['id']; ?>" class="simple-link"><?php echo __('詳細'); ?></a><br /> -->
          	<a href="/city/edit/<?php echo $ct['City']['id']; ?>" class="simple-link"><?php echo __('編集'); ?></a><br />
          	<?php
                echo $this->Form->postLink(
                    __('削除'),
                    array('action' => 'delete', $ct['City']['id']),
                    array('confirm' => __('削除致します。宜しいでしょうか。'), 'class' => "simple-link")
                );?>
          </td>
        </tr>
<?php endforeach; ?>
      </tbody>
      <!-- <tfoot>
        <tr>
          <td colspan="6" align="center">
            <?php //echo $this->Paginator->prev('< ' . __('前に戻る'), array(), null, array('class' => 'prev disabled'));?>
            <?php //echo $this->Paginator->numbers(array('class' => 'paginate', 'currentClass'=>'active'));?>
            <?php //echo $this->Paginator->next(__('次へ') . ' >', array(), null, array('class' => 'next disabled'));?>
          </td>
        </tr> -->
      </tfoot>
    </table>
  </fieldset>
</div>
