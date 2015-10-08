 <div id="shopInfo" class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('アカウント新規登録'); ?></div>
  <h2><i class="fa fa-user">&nbsp;</i><?php echo __('ユーザー管理'); ?></a><span>｜<?php echo __('クライアント管理'); ?></span></h2>

  <!-- ▼ アカウント新規登録 -->
  <h3><?php echo __('アカウント新規登録'); ?></h3>
  <fieldset ng-controller='shopInfoController'>

    <div role="alert">
      <?php echo $this->Session->flash(); ?>
    </div>

    <?php echo $this->Form->create(false); ?>
      <table>
        <tr>
          <td class="subject"><?php echo __('氏名'); ?></td>
          <td>
            <?php echo $this->Form->input('User.user_name', array('type' => 'text', 'div' => false, 'label' => false, 'placeholder' => __('氏名')));?>
          </td>
        </tr>

        <tr>
          <td class="subject"><?php echo __('氏名（ふりがな）'); ?></td>
          <td>
            <?php echo $this->Form->input('User.user_name_furi', array('type' => 'text', 'div' => false, 'label' => false, 'placeholder' => __('氏名（ふりがな）')));?>
          </td>
        </tr>

        <tr>
          <td class="subject"><?php echo __('メールアドレス'); ?></td>
          <td>
            <?php echo $this->Form->input('User.email', array('type' => 'text', 'div' => false, 'label' => false, 'placeholder' => __('メールアドレス')));?>
          </td>
        </tr>

        <tr>
          <td class="subject"><?php echo __('対応言語'); ?></td>
          <td>
            <label><?php echo $this->Form->input('0.UserLang.lang', array('type' => 'checkbox', 'div' => false, 'label' => false, 'hiddenField' => false, 'value' => 'ja')); ?>&nbsp;<img src="/img/common/flag_icons/ja.png" alt="" height="16">&nbsp;<?php echo __('日本語版アプリ'); ?></label><br>
            <label><?php echo $this->Form->input('1.UserLang.lang', array('type' => 'checkbox', 'div' => false, 'label' => false, 'hiddenField' => false, 'value' => 'en')); ?>&nbsp;<img src="/img/common/flag_icons/en.png" alt="" height="16">&nbsp;<?php echo __('英語版アプリ'); ?></label><br>
            <label><?php echo $this->Form->input('2.UserLang.lang', array('type' => 'checkbox', 'div' => false, 'label' => false, 'hiddenField' => false, 'value' => 'zh')); ?>&nbsp;<img src="/img/common/flag_icons/zh.png" alt="" height="16">&nbsp;<?php echo __('広東語版アプリ'); ?></label><br>
            <label><?php echo $this->Form->input('3.UserLang.lang', array('type' => 'checkbox', 'div' => false, 'label' => false, 'hiddenField' => false, 'value' => 'vi')); ?>&nbsp;<img src="/img/common/flag_icons/vi.png" alt="" height="16">&nbsp;<?php echo __('ベトナム語版アプリ'); ?></label>
            <?php if (isset($lang_error)) : ?>
            <div class="error-message">最低１つは選択してください</div>
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('テンプレート言語'); ?></td>
          <td>
            <?php echo $this->Form->input('User.lang', array('type' => 'select', 'options' => $langOptions, 'label' => false, 'div' => false, 'class' => 'form-select mt_10 mb_0'));?>
            <p class="help-block">送信されるメールの内容言語を選択できます。<br>選択されない場合は、日本語のテンプレートで送信されます。</p>
          </td>
        </tr>
      </table>

      <div class="btn_center">
        <?php echo $this->Form->input('User.password', array('type' => 'hidden', 'div' => false, 'label' => false));?>
        <?php echo $this->Form->input('User.type', array('type' => 'hidden', 'div' => false, 'label' => false, 'value' => 2));?>
        <?php echo $this->Form->input('User.status', array('type' => 'hidden', 'div' => false, 'label' => false, 'value' => 2));?>

        <input type="button" value="<?php echo __('戻る'); ?>" class="btn btn_gray" onclick="document.location='/client/list';" />&nbsp;
        <?php echo $this->Form->submit(__('登録'), array('type' => 'submit', 'div' => false, 'class' => 'btn btn_orange', 'onclick' => 'return confirm(\'' . __('クライアント情報を登録します。よろしいですか') . '\');'));?>
      </div>
    <?php echo $this->Form->end();?>
  </fieldset>
  <!-- ▲ アカウント新規登録 -->

</div>
