<div id="shopInfo" class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<a href="/country"><?php echo __('国管理'); ?></a>&nbsp;>&nbsp;<?php echo __('新規国の登録'); ?></div>
  <h2><i class="fa fa-life-ring">&nbsp;</i><?php echo __('国管理'); ?></span></h2>

  <!-- ▼ 新規国の登録 -->
  <h3><?php echo __('新規国の登録'); ?></h3>
  <fieldset ng-controller='shopInfoController'>
	<div role="alert">
	  <?php echo $this->Session->flash(); ?>
	</div>
    <?php echo $this->Form->create(false); ?>
      <table>
        <tr>
          <td class="subject"><?php echo __('国名'); ?></td>
          <td>
            <?php echo $this->Form->input('Country.name', array('type' => 'text', 'div' => false, 'label' => false, 'required' => true, 'placeholder' => __('国名')));?>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('ステータス'); ?></td>
          <td>
            <?php //echo $this->Form->input('Country.status', array('type' => 'select', 'div' => false, 'label' => false, 'required' => true, 'options' => [1 => __('アクティブ'), 2 => __('ディアクティブ')]));?>
            <?php echo $this->Form->input('Country.status', array('type' => 'checkbox', 'div' => false, 'label' => false, 'required' => true, 'checked')); ?>
          </td>
        </tr>
      </table>

      <div class="btn_center">
        <input type="button" value="<?php echo __('戻る'); ?>" class="btn btn_gray" onclick="window.history.back();" />&nbsp;
        <?php echo $this->Form->submit(__('登録'), array('type' => 'submit', 'div' => false, 'class' => 'btn btn_orange', 'onclick' => 'return confirm(\'' . __('国情報を登録致します。宜しいでしょうか。') . '\');'));?>
      </div>
    <?php echo $this->Form->end();?>
  </fieldset>
  <!-- ▲ アカウント新規登録 -->

</div>