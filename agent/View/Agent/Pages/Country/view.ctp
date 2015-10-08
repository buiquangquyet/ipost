<div id="shopInfo" class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<a href="/country"><?php echo __('国管理'); ?></a>&nbsp;>&nbsp;<?php echo __('詳細国'); ?></div>
  <h2><i class="fa fa-life-ring">&nbsp;</i><?php echo __('国管理'); ?></h2>
  <h3><?php echo __('詳細国');?></h3>
  <fieldset>
	<div role="alert">
    	<?php echo $this->Session->flash(); ?>
  	</div>
    <table>
      <tr>
        <td class="subject"><?php echo __('ID'); ?></td>
        <td><?php echo $countries['Country']['id'];?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('国名'); ?></td>
        <td><?php echo $countries['Country']['name']?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('ステータス'); ?></td>
        <td><?php if($countries['Country']['status'] == 1) echo '<i class="fa fa-circle" style="color:green;"></i>'; else echo '<i class="fa fa-circle" style="color:#c3c3c3;"></i>';?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('都市の一覧'); ?></td>
        <td>
        	<?php if($cities) :?>
        	<?php foreach($cities as $key => $value) :?>
        	<a href="/country/editcity/<?php echo $value['City']['id']?>" class="simple-link"><?php echo $value['City']['name']?> - [<?php echo $value['City']['code']?>]</a><br>
        	<?php endforeach;?>
        	<?php else :?>
        	<?php echo __('データなし');?>
        	<?php endif;?>
        </td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('登録日時'); ?></td>
        <td><?php echo $countries['Country']['created']?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('輸入する'); ?></td>
        <td><a href="/country/importcity/<?php echo $countries['Country']['id'];?>" class="simple-link"><?php echo __('此処'); ?></a></td>
      </tr>
    </table>

    <div class="btn_center">
    	<a href="javascript:;" onclick="window.history.back();" class="btn btn_gray"><?php echo __('戻る');?></a>
      	<a href="/country/edit/<?php echo $countries['Country']['id'];?>" class="btn"><?php echo __('編集');?></a>
    </div>
  </fieldset>
  <!-- ▲ クライアント情報 -->
</div>