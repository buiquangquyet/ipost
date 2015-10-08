<div class="col-sm-6 col-sm-offset-3">
  <div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-sign-in"></i>&nbsp;<?php echo __('ログイン'); ?></div>

    <div class="panel-body">
      <?php echo $this->Form->create(false); ?>

        <div role="alert">
          <?php echo $this->Session->flash(); ?>
        </div>

        <div class="form-group">
          <label for="UserEmail" class="control-label"><?php echo __('メールアドレス'); ?></label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
            <?php echo $this->Form->input('User.email', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => __('メールアドレス')));?>
          </div>
        </div>

        <div class="form-group">
          <label for="UserPassword" class="control-label"><?php echo __('パスワード'); ?></label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-key"></i></span>
            <?php echo $this->Form->input('User.password', array('div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => __('パスワード')));?>
          </div>
        </div>

        <div class="form-group">
          <input type="submit" id="button" class="btn btn-default" value="<?php echo __('ログイン'); ?>">
        </div>
      <?php echo $this->Form->end();?>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-body">
    <a href="/auth/regist"><i class="fa fa-user"></i>&nbsp;<?php echo __('アカウントの発行依頼'); ?></a>
    </div>
  </div>
</div>
