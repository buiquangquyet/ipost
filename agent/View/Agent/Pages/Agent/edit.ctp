<div class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('代理店情報'); ?></div>
  <h2><i class="fa fa-building">&nbsp;</i><?php echo __('代理店情報'); ?></h2>

  <?php echo $this->Session->flash(); ?>

  <h3><?php echo __('代理店情報の編集'); ?></h3>

  <fieldset>
    <?php echo $this->Form->create('UserDetail', array('id' => 'shopInfoForm', 'url' => array('controller' => 'agent', 'action' => 'edit'), 'novalidate' => true)); ?>
      <table>
        <tr>
          <td class="subject"><?php echo __('氏名'); ?></td>
          <td><?php echo $userInfo['User']['user_name'];?></td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('メールアドレス'); ?></td>
          <td><?php echo $userInfo['User']['email']?></td>
        </tr>

        <tr>
          <td class="subject"><?php echo __('会社名'); ?></td>
          <td><?php echo $this->Form->input('UserDetail.company_name', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-5', 'placeholder' => __('会社名')));?></td>
        </tr>

        <tr>
          <td class="subject"><?php echo __('電話番号'); ?></td>
          <td>
            <?php echo $this->Form->input('UserDetail.tel1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-2', 'placeholder' => __('市外局番'), 'maxlength' => '4'));?>
            <?php echo $this->Form->input('UserDetail.tel2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-2', 'placeholder' => __('上4桁'), 'maxlength' => '4'));?>
            <?php echo $this->Form->input('UserDetail.tel3', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-2', 'placeholder' => __('下4桁'), 'maxlength' => '4'));?>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('FAX'); ?></td>
          <td>
            <?php echo $this->Form->input('UserDetail.fax1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-2', 'placeholder' => __('市外局番'), 'maxlength' => '4'));?>
            <?php echo $this->Form->input('UserDetail.fax2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-2', 'placeholder' => __('上4桁'), 'maxlength' => '4'));?>
            <?php echo $this->Form->input('UserDetail.fax3', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-2', 'placeholder' => __('下4桁'), 'maxlength' => '4'));?>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('携帯電話'); ?></td>
          <td>
            <?php echo $this->Form->input('UserDetail.mobile_tel1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-2', 'placeholder' => __('市外局番'), 'maxlength' => '3'));?>
            <?php echo $this->Form->input('UserDetail.mobile_tel2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-2', 'placeholder' => __('上4桁'), 'maxlength' => '4'));?>
            <?php echo $this->Form->input('UserDetail.mobile_tel3', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-2', 'placeholder' => __('下4桁'), 'maxlength' => '4'));?>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('郵便番号'); ?></td>
          <td>
            <?php echo $this->Form->input('UserDetail.zip_code1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-2', 'placeholder' => __('上3桁'), 'maxlength' => '3'));?>
            <?php echo $this->Form->input('UserDetail.zip_code2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-2', 'placeholder' => __('下4桁'), 'maxlength' => '4'));?>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('都道府県'); ?></td>
          <td>
            <?php echo $this->Form->input('UserDetail.pref', array('type' => 'select', 'options' => Configure::read('PrefList'), 'label' => false, 'div' => false, 'class' => 'form-select'));?>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('市区町村'); ?></td>
          <td>
            <?php echo $this->Form->input('UserDetail.city', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-5', 'placeholder' => __('市区町村')));?>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('住所（番地）'); ?></td>
          <td>
            <?php echo $this->Form->input('UserDetail.address_opt1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-5', 'placeholder' => __('住所（番地）')));?>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('住所（建物）'); ?></td>
          <td>
            <?php echo $this->Form->input('UserDetail.address_opt2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-5', 'placeholder' => __('住所（番地）')));?>
          </td>
        </tr>
      </table>

      <div class="btn_center">
        <input type="button" value="<?php echo __('キャンセル'); ?>" onclick="document.location='/agent/info';" class="btn btn_gray"/>&nbsp;<button type="submit" class="btn btn_orange" onclick="return confirm('<?php echo __('代理店情報を更新します。よろしいですか'); ?>');"><?php echo __('更新'); ?></button>
      </div>
    <?php echo $this->Form->end(); ?>
  </fieldset>
</div>
