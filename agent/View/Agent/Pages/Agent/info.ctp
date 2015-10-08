<div class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('代理店情報'); ?></div>
  <h2><i class="fa fa-building">&nbsp;</i><?php echo __('代理店情報'); ?></h2>

  <h3><?php echo __('代理店情報'); ?></h3>
  <fieldset>
    <table>
      <tr>
        <td class="subject"><?php echo __('代理店ID'); ?></td>
        <td><?php echo $userInfo['User']['id']; ?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('氏名'); ?></td>
        <td><?php echo $userInfo['User']['user_name']; ?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('メールアドレス'); ?></td>
        <td><?php echo $userInfo['User']['email']; ?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('会社名'); ?></td>
        <td><?php echo $userDetail['UserDetail']['company_name']; ?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('電話番号'); ?></td>
        <td>
        <!--
          <?php echo $userDetail['UserDetail']['tel1']; ?>&nbsp;-&nbsp;
          <?php echo $userDetail['UserDetail']['tel2']; ?>&nbsp;-&nbsp;
          <?php echo $userDetail['UserDetail']['tel3']; ?>
         -->
         <?php echo $userDetail['UserDetail']['tel']; ?>
        </td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('FAX番号'); ?></td>
        <td>
        <!--
          <?php echo $userDetail['UserDetail']['fax1']; ?>&nbsp;-&nbsp;
          <?php echo $userDetail['UserDetail']['fax2']; ?>&nbsp;-&nbsp;
          <?php echo $userDetail['UserDetail']['fax3']; ?>
        -->
        <?php echo $userDetail['UserDetail']['fax']; ?>
        </td>
      </tr>
      <!--
      <tr>
        <td class="subject"><?php echo __('携帯電話'); ?></td>
        <td>
          <?php echo $userDetail['UserDetail']['mobile_tel1']; ?>&nbsp;-&nbsp;
          <?php echo $userDetail['UserDetail']['mobile_tel2']; ?>&nbsp;-&nbsp;
          <?php echo $userDetail['UserDetail']['mobile_tel3']; ?>
        <?php echo $userDetail['UserDetail']['mobile_tel']; ?>
        </td>
      </tr>
      -->
      <tr>
        <td class="subject"><?php echo __('郵便番号'); ?></td>
        <td>
        <!--
        <?php echo $userDetail['UserDetail']['zip_code1']; ?>&nbsp;-&nbsp;<?php echo $userDetail['UserDetail']['zip_code2']; ?></td>
        -->
        <?php echo $userDetail['UserDetail']['post_code']; ?>
        </td>
      </tr>
      <!--
      <tr>
        <td class="subject"><?php echo __('都道府県'); ?></td>
        <td><?php echo $userDetail['UserDetail']['pref_disp']; ?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('市区町村'); ?></td>
        <td><?php echo $userDetail['UserDetail']['city']; ?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('住所（番地）'); ?></td>
        <td><?php echo $userDetail['UserDetail']['address_opt1']; ?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('住所（建物）'); ?></td>
        <td><?php echo $userDetail['UserDetail']['address_opt2']; ?></td>
      </tr>
      -->
      <tr>
        <td class="subject"><?php echo __('住所'); ?></td>
        <td><?php echo $userDetail['UserDetail']['address']; ?></td>
      </tr>
    </table>

    <div class="btn_center">
      <a href="/agent/edit" class="btn btn_blue"><?php echo __('更新'); ?></a>
    </div>
  </fieldset>

</div>
