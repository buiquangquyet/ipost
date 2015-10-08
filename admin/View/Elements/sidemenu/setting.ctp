<div id="setting" class="button_item"><!-- ▼ ウェブビューブロック -->
  <div class="frame_main_box box_kage">
    <div class="c"></div>
    <header class="panel-heading panel-title"><?php echo __('セッティング'); ?></header>
    <div class="form_top"></div>

    <?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'enable', 'novalidate' => true, 'id' => 'setting_enable')); ?>
    <div class="form-group">
        <label for="form_enable" class="form-label"><?php echo __('表示'); ?></label>
        <div class="checkbox_box">
          <?php echo $this->Form->input("Sidemenu.setting.enable", array('type' => 'radio', 'options' => Configure::read('SidemenuDisp'), 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;margin-left:30px;margin-top:8px;', 'onchange' => 'postData("setting_enable")')); ?>
        </div>
        <p class="form-help fml_184"><?php echo __('お客様に見せるかどうかを選ぶことができます。'); ?></p>
      <div class="form_hr"></div>
    </div>
    <?php echo $this->Form->end(); ?>


    <!-- ▼ 入力ボックス -->
    <div class="form-group">
      <?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'regist', 'novalidate' => true, 'id' => 'setting_form')); ?>
        <label for="coupon_html" class="form-label"><?php echo __('メニュー名'); ?></label>
        <?php echo $this->Form->input("Sidemenu.setting.name", array('type' => 'text', 'class' => 'form-txt form-5', 'placeholder' => __('メニュー名の入力'), 'label' => false)); ?>

        <div class="button_box di ml_10 pt_0">
          <?php echo $this->Html->link(__('<i class="fa fa-edit mg-r-xs"></i>変更'), "javascript:postData('setting_form');", array('escape' => false, 'class' => 'btn btn-info btn-sm')); ?>
        </div>
      <?php echo $this->Form->end(); ?>
      <div class="form_hr"></div>
    </div>
    <!-- ▲ -->

    <div class="button_box mt_20">
      <?php echo $this->Html->link('<i class="fa fa-chevron-up"></i>', array('action' => 'movePos', '?' => array('target' => 'setting', 'type' => 'forward')), array('class' => 'btn btn-default btn-sm up', 'escape' => false)); ?>
      <?php echo $this->Html->link('<i class="fa fa-chevron-down"></i>', array('action' => 'movePos','?' => array('target' => 'setting', 'type' => 'backword')), array('class' => 'btn btn-default btn-sm down', 'escape' => false)); ?>
    </div>


    <div class="frame_bottom_box">
      <div class="padding10"></div>
    </div>
  </div>
  <!-- ▲ -->

</div>