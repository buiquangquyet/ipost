<div id="shopInfo" class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<a href="/city"><?php echo __('都市の管理'); ?></a>&nbsp;>&nbsp;<?php echo __('詳細都市'); ?></div>
  <h2><i class="fa fa-star">&nbsp;</i><?php echo __('都市の管理'); ?></h2>

  <div role="alert">
    <?php echo $this->Session->flash(); ?>
  </div>

  <h3><?php echo __('詳細都市');?></h3>
  <fieldset>
    <table>
      <tr>
        <td class="subject"><?php echo __('ID'); ?></td>
        <td><?php echo $cities['City']['id'];?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('市名'); ?></td>
        <td><?php echo $cities['City']['name']?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('郵便番号'); ?></td>
        <td><?php echo $cities['City']['code']?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('ステータス'); ?></td>
        <td><?php if($cities['City']['status'] == 1) echo '<i class="fa fa-circle" style="color:green;"></i>'; else echo '<i class="fa fa-circle" style="color:#c3c3c3;"></i>';?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('国'); ?></td>
        <td>
        	<a href="/country/view/<?php echo $cities['City']['countries_id']?>" target="_blank" class="simple-link"><?php echo $countries[$cities['City']['countries_id']]?></a><br>
        </td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('登録日時'); ?></td>
        <td><?php echo $cities['City']['created']?></td>
      </tr>
    </table>

    <div class="btn_center">
    	<a href="/city" class="btn btn_gray"><?php echo __('戻る');?></a>
      	<a href="/city/edit/<?php echo $cities['City']['id'];?>" class="btn"><?php echo __('編集');?></a>
    </div>
  </fieldset>
  <!-- ▲ クライアント情報 -->
</div>