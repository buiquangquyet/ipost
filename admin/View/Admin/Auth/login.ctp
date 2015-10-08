<div id="login_box">
	<div class="login_top bg-info">
		<div class="logo2"></div>
	</div>

	<div class="login_main">

		<!-- <div class="login_txt"><?php //echo __('IDとパスワードを入力してください。');?></div> -->

		<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'login', 'class' => 'ama_form', 'novalidate' => true)); ?>
			<div class="form-group">

				<div class="login-label"><?php echo __('メールアドレス');?></div>
				<?php echo $this->Form->input('User.email', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-txt form-login', 'placeholder' => __('メールアドレス')));?>
				<div class="c"></div>
				<div class="login-label"><?php echo __('パスワード');?></div>
				<?php echo $this->Form->input('User.password', array('div' => false, 'label' => false, 'class' => 'form-txt form-login', 'placeholder' => __('パスワード')));?>
			</div>

			<div class="c10"></div>

			<?php echo $this->Session->flash(); ?>

			<div class="btn_center">
				<input type="submit" id="button" class="btn btn-success btn-sm" value="<?php echo __('ログイン');?>">
			</div>

			<div class="c"></div>

		<?php echo $this->Form->end();?>
	</div>
</div>