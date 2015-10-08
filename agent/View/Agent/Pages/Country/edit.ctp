<div class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<a href="/country"><?php echo __('国管理'); ?></a>&nbsp;>&nbsp;<?php echo __('国の更新'); ?></div>
  <h2><i class="fa fa-life-ring">&nbsp;</i><?php echo __('国管理'); ?><span>｜<?php echo __('国の更新'); ?></span></h2>

  <h3><?php echo __('国の更新'); ?></h3>

  <!-- ▼ アカウント新規登録 -->
  <fieldset>
    <div role="alert">
      <?php echo $this->Session->flash(); ?>
    </div>

    <?php echo $this->Form->create(false, array('url' => array('action' => 'edit', $countries['Country']['id']),'type' => 'post', 'novalidate' => true)); ?>
      <table>
        <tr>
          <td class="subject"><?php echo __('国名'); ?></td>
          <td><?php echo $this->Form->input('Country.name', array('type' => 'text', 'div' => false, 'label' => false, 'placeholder' => __('国名')));?></td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('ステータス'); ?></td>
          <td>
            <?php //echo $this->Form->input('Country.status', array('type' => 'select', 'div' => false, 'label' => false, 'required' => true, 'options' => [1 => __('アクティブ'), 2 => __('ディアクティブ')]));?>
            <?php echo $this->Form->input('Country.status', array('type' => 'checkbox', 'div' => false, 'label' => false, 'required' => true)); ?>
          </td>
        </tr>
      </table>
      <div class="btn_center">
        <input type="button" value="<?php echo __('戻る');?>" class="btn btn_gray" onclick="window.history.back();" />&nbsp;
        <input type="submit" class="btn btn_orange" value="<?php echo __('変更');?>" onclick="return confirm('<?php echo __('国情報を更新致します。宜しいでしょうか。'); ?>');" />
      </div>
    <?php echo $this->Form->end();?>
  </fieldset>
  <!-- ▲ アカウント新規登録 -->

</div>
