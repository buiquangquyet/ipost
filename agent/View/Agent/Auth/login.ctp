<p class="login_head"><img src="/img/common/logo.png" class="w_100"></p>
<fieldset class="login_box">
<p class="f_g ta_c mb_20 mt_0"><?php echo __('IDとパスワードを入力してください。'); ?></p>

<?php echo $this->Session->flash(); ?>

<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'login', 'novalidate' => true)); ?>
<table class="ml_20">
<tr>
<td class="f_g s_dn"><?php echo __('メールアドレス'); ?></td>
<td><?php echo $this->Form->input('User.email', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-txt form-login', 'placeholder' => __('メールアドレス')));?></td>
</tr>
<tr>
<td class="f_g s_dn"><?php echo __('パスワード'); ?></td>
<td><?php echo $this->Form->input('User.password', array('div' => false, 'label' => false, 'placeholder' => __('パスワード')));?></td>
</tr>

</table>
<div class="btn_center">
<input type="submit" id="button" class="btn btn-success btn-sm" value="<?php echo __('ログイン'); ?>">
</div>
<?php echo $this->Form->end();?>
</fieldset>
