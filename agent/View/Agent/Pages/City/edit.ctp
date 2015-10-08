<div class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<a href="/city"><?php echo __('都市の管理'); ?></a>&nbsp;>&nbsp;<?php echo __('都市の更新'); ?></div>
  <h2><i class="fa fa-star">&nbsp;</i><?php echo __('都市の管理'); ?><span>｜<?php echo __('都市の更新'); ?></span></h2>

  <h3><?php echo __('都市の更新'); ?></h3>

  <!-- ▼ アカウント新規登録 -->
  <fieldset>
    <div role="alert">
      <?php echo $this->Session->flash(); ?>
    </div>

    <?php echo $this->Form->create(false, array('url' => array('action' => 'edit', $cities['City']['id']),'type' => 'post', 'novalidate' => true)); ?>
      <table>
        <tr>
          <td class="subject"><?php echo __('市名'); ?></td>
          <td><?php echo $this->Form->input('City.name', array('type' => 'text', 'div' => false, 'label' => false, 'placeholder' => __('市名')));?></td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('郵便番号'); ?></td>
          <td><?php echo $this->Form->input('City.code', array('type' => 'text', 'div' => false, 'label' => false, 'placeholder' => __('郵便番号')));?></td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('ステータス'); ?></td>
          <td>
            <?php echo $this->Form->input('City.status', array('type' => 'select', 'div' => false, 'label' => false, 'required' => true, 'options' => [1 => __('アクティブ'), 2 => __('ディアクティブ')]));?>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('国'); ?></td>
          <td>
            <?php echo $this->Form->input('City.countries_id', array('type' => 'select', 'div' => false, 'label' => false, 'required' => true, 'options' => $countries));?>
          </td>
        </tr>
      </table>
      <div class="btn_center">
        <input type="button" value="<?php echo __('戻る');?>" class="btn btn_gray" onclick="document.location='/city/view/<?php echo $cities['City']['id'];?>';" />&nbsp;
        <input type="submit" class="btn btn_orange" value="<?php echo __('変更');?>" onclick="return confirm('<?php echo __('よろしいですか?'); ?>');" />
      </div>
    <?php echo $this->Form->end();?>
  </fieldset>
  <!-- ▲ アカウント新規登録 -->

</div>
