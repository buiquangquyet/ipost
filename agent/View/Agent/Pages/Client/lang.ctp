 <div id="shopInfo" class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('アカウント新規登録'); ?></div>
  <h2><i class="fa fa-user">&nbsp;</i><?php echo __('ユーザー管理'); ?></a><span>｜<?php echo __('クライアント管理'); ?></span></h2>

  <!-- ▼ アカウント新規登録 -->
  <h3><?php echo __('対応言語編集'); ?></h3>
  <fieldset>

    <div role="alert">
      <?php echo $this->Session->flash(); ?>
    </div>

    <?php echo $this->Form->create(false); ?>
      <table>
        <tr>
          <td class="subject"><?php echo __('対応言語'); ?></td>
          <td>
            <label><?php echo $this->Form->input('langs.', array('type' => 'checkbox', 'div' => false, 'label' => false, 'hiddenField' => false, 'value' => 'ja', $langList[0])); ?>&nbsp;<img src="/img/common/flag_icons/ja.png" alt="" height="16">&nbsp;<?php echo __('日本語版アプリ'); ?></label><br>
            <label><?php echo $this->Form->input('langs.', array('type' => 'checkbox', 'div' => false, 'label' => false, 'hiddenField' => false, 'value' => 'en', $langList[1])); ?>&nbsp;<img src="/img/common/flag_icons/en.png" alt="" height="16">&nbsp;<?php echo __('英語版アプリ'); ?></label><br>
            <label><?php echo $this->Form->input('langs.', array('type' => 'checkbox', 'div' => false, 'label' => false, 'hiddenField' => false, 'value' => 'zh', $langList[2])); ?>&nbsp;<img src="/img/common/flag_icons/zh.png" alt="" height="16">&nbsp;<?php echo __('広東語版アプリ'); ?></label><br>
            <label><?php echo $this->Form->input('langs.', array('type' => 'checkbox', 'div' => false, 'label' => false, 'hiddenField' => false, 'value' => 'vi', $langList[3])); ?>&nbsp;<img src="/img/common/flag_icons/vi.png" alt="" height="16">&nbsp;<?php echo __('ベトナム語版アプリ'); ?></label>
            <?php if (isset($lang_error)) : ?>
            <div class="error-message">最低１つは選択してください</div>
            <?php endif; ?>
          </td>
        </tr>
      </table>

      <div class="btn_center">
        <input type="button" value="<?php echo __('戻る'); ?>" class="btn btn_gray" onclick="document.location='/client/list';" />&nbsp;
        <?php echo $this->Form->submit(__('変更'), array('type' => 'submit', 'div' => false, 'class' => 'btn btn_orange', 'onclick' => 'return confirm(\'' . __('対応言語情報を登録します。よろしいですか') . '\');'));?>
      </div>
    <?php echo $this->Form->end();?>
  </fieldset>
  <!-- ▲ 対応言語編集 -->

</div>
