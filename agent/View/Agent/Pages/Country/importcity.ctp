<div class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<a href="/country"><?php echo __('国管理'); ?></a>&nbsp;>&nbsp;<a href="/country/listcity/<?php echo $countries['Country']['id']?>"><?php echo __('都市の一覧'); ?></a>&nbsp;>&nbsp;<?php echo __('リストをインポート'); ?></div>
  <h2><i class="fa fa-life-ring">&nbsp;</i><?php echo __('国管理'); ?><span>｜<?php echo __('都市の一覧'); ?></span></h2>

  <h3><?php echo __('%s の都市を入力', $countries['Country']['name']); ?></h3>

  <!-- ▼ アカウント新規登録 -->
  <fieldset>
    <div role="alert">
      <?php echo $this->Session->flash(); ?>
    </div>

    <?php echo $this->Form->create(false, array('url' => array('action' => 'importcity', $countries['Country']['id']), 'type' => 'file', 'enctype' => "multipart/form-data")); ?>
      <table>
        <tr>
          <td class="subject"><?php echo __('国名'); ?></td>
          <td><?php echo $countries['Country']['name'];?></td>
        </tr>
        <!-- <tr>
          <td class="subject"><?php //echo __('ステータス'); ?></td>
          <td><?php //if($countries['Country']['status'] == 1) echo '<i class="fa fa-circle" style="color:green;"></i>'; else echo '<i class="fa fa-circle" style="color:#c3c3c3;"></i>';?></td>
        </tr> -->
        <tr>
          <td class="subject"><?php echo __('ファイル形式（XLS、XLSX）'); ?></td>
          <td><?php echo $this->Form->file("file", array('class' => '', 'label' => false, 'name' => 'file', 'required' => 'required')); ?></td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('市名 (XLS,XLSX) ファイルの例'); ?></td>
          <td><a href="/files/demo.xlsx" class="simple-link"><?php echo __('デモファイルをダウンロード')?></a></td>
        </tr>
      </table>
      <div class="btn_center">
      	<input type="hidden" value="<?php echo $countries['Country']['id'];?>" name="countries_id" />
        <input type="button" value="<?php echo __('戻る');?>" class="btn btn_gray" onclick="document.location='/country/listcity/<?php echo $countries['Country']['id']?>';" />&nbsp;
        <input type="submit" class="btn btn_orange" value="<?php echo __('インポート');?>"  />
      </div>
    <?php echo $this->Form->end();?>
  </fieldset>
  <!-- ▲ アカウント新規登録 -->

</div>
