<div class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('アカウント一覧'); ?>&nbsp;>&nbsp;<?php echo __('クライアント情報の編集'); ?></div>
  <h2><i class="fa fa-user">&nbsp;</i><?php echo __('ユーザー管理'); ?></a><span>｜<?php echo __('クライアント管理'); ?></span></h2>

  <h3><?php echo __('クライアント情報の編集'); ?></h3>

  <!-- ▼ アカウント新規登録 -->
  <fieldset>
    <div role="alert">
      <?php echo $this->Session->flash(); ?>
    </div>

    <?php echo $this->Form->create(false, array('url' => array('action' => 'edit', $user['User']['id']),'type' => 'post', 'novalidate' => true)); ?>
      <table>
        <tr>
          <td class="subject"><?php echo __('氏名'); ?></td>
          <td><?php echo $this->Form->input('User.user_name', array('type' => 'text', 'div' => false, 'label' => false, 'placeholder' => __('氏名')));?></td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('氏名（ふりがな）'); ?></td>
          <td><?php echo $this->Form->input('User.user_name_furi', array('type' => 'text', 'div' => false, 'label' => false, 'placeholder' => __('氏名（ふりがな）')));?></td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('メールアドレス'); ?></td>
          <td><?php echo $this->Form->input('User.email', array('type' => 'text', 'div' => false, 'label' => false, 'placeholder' => __('メールアドレス')));?></td>
        </tr>
        <tr>
      </table>
      <div class="btn_center">
        <input type="button" value="<?php echo __('戻る');?>" class="btn btn_gray" onclick="document.location='/client/info/<?php echo $user['User']['id'];?>';" />&nbsp;
        <input type="submit" class="btn btn_orange" value="<?php echo __('変更');?>" onclick="return confirm('<?php echo __('クライアント情報を変更します。よろしいですか'); ?>');" />
      </div>
    <?php echo $this->Form->end();?>
  </fieldset>
  <!-- ▲ アカウント新規登録 -->

</div>
