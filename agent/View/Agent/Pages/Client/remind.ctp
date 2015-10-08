<div class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('アカウント一覧'); ?>&nbsp;>&nbsp;<?php echo __('アカウント情報'); ?>&nbsp;>&nbsp;<?php echo __('パスワード再発行'); ?></div>
  <h2><i class="fa fa-user">&nbsp;</i><?php echo __('ユーザー管理'); ?></a><span>｜<?php echo __('クライアント管理'); ?></span></h2>

  <h3><?php echo __('パスワード再発行'); ?></h3>

  <!-- ▼ アカウント新規登録 -->
  <fieldset>
    <div role="alert">
      <?php echo $this->Session->flash(); ?>
    </div>

    <?php echo $this->Form->create(false, array('url' => array('action' => 'remind_confirm', $user['User']['id']), 'novalidate' => true)); ?>
      <div>
        <strong><?php echo $user['User']['email']; ?></strong>&nbsp;<?php echo __('宛にメールをお送りします。'); ?>
      </div>
      <hr>
      <div>
        <label class="subject"><?php echo __('メール本文'); ?></label>
        <div>
          <p class="help-block"><?php echo __('下記の記号は、送信される際に置換されます。'); ?><br>
          %%%user_name%%%&nbsp;=>&nbsp;<?php echo __('登録されているクライアント名に置換されます。'); ?><br>
          %%%login_url%%%&nbsp;=>&nbsp;<?php echo __('クライアント管理画面のURLに置換されます。'); ?><br>
          %%%password%%%&nbsp;=>&nbsp;<?php echo __('新しく発行されるパスワードに置換されます。'); ?></p>
        </div>
        <?php echo $this->Form->input('body', array('type' => 'textarea', 'div' => false, 'label' => false, 'value' => $body, 'style' => 'width:100%;height:30em;'));?>
      </div>

      <div>
        <ul class="help-block">
          <li><?php echo __('※クライアントへメールが届かない場合は下記の事項をご確認ください。'); ?></li>
          <li><?php echo __('※ドメイン指定受信を設定している方は、「hiropro.co.jp」を受信できるように設定してください。'); ?></li>
          <li><?php echo __('※お使いのメールソフトで、迷惑メールフォルダに入っていないかご確認ください。'); ?></li>
        </ul>
      </div>

      <div class="btn_center">
        <input type="button" value="<?php echo __('戻る'); ?>" class="btn btn_gray" onclick="document.location='/client/info/<?php echo $user['User']['id'];?>';" />&nbsp;
        <input type="submit" class="btn btn_orange" value="<?php echo __('確認'); ?>" />
      </div>
    <?php echo $this->Form->end();?>
  </fieldset>
  <!-- ▲ アカウント新規登録 -->

</div>
