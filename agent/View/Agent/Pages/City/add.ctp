 <div id="shopInfo" class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<a href="/city"><?php echo __('都市の管理'); ?></a>&nbsp;>&nbsp;<?php echo __('新規都市の登録'); ?></div>
  <h2><i class="fa fa-star">&nbsp;</i><?php echo __('都市の管理'); ?></span></h2>

  <h3><?php echo __('新規都市の登録'); ?></h3>
  <fieldset ng-controller='shopInfoController'>
  	<div role="alert">
	<?php echo $this->Session->flash(); ?>
	</div>
    <?php echo $this->Form->create(false); ?>
      <table>
        <tr>
          <td class="subject"><?php echo __('市名'); ?></td>
          <td>
            <?php echo $this->Form->input('City.name', array('type' => 'text', 'div' => false, 'label' => false, 'required' => true, 'placeholder' => __('市名')));?>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('郵便番号'); ?></td>
          <td>
            <?php echo $this->Form->input('City.code', array('type' => 'text', 'div' => false, 'label' => false, 'required' => true, 'placeholder' => __('郵便番号を入力')));?>
          </td>
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
        <input type="button" value="<?php echo __('戻る'); ?>" class="btn btn_gray" onclick="document.location='/city';" />&nbsp;
        <?php echo $this->Form->submit(__('登録'), array('type' => 'submit', 'div' => false, 'class' => 'btn btn_orange', 'onclick' => 'return confirm(\'' . __('よろしいですか?') . '\');'));?>
      </div>
    <?php echo $this->Form->end();?>
  </fieldset>

</div>
