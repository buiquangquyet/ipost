<div id="shopInfo" class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('アカウント一覧'); ?>&nbsp;>&nbsp;<?php echo __('アカウント情報'); ?></div>
  <h2><i class="fa fa-user">&nbsp;</i><?php echo __('ユーザー管理'); ?><span>｜<?php echo __('クライアント管理'); ?></span></h2>

  <h3><?php echo __('店舗情報'); ?></h3>

  <fieldset ng-controller='shopInfoController'>
    <table>
      <tr>
        <td class="subject"><?php echo __('氏名'); ?></td>
        <td><?php echo $userInfo['User']['user_name']?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('メールアドレス'); ?></td>
        <td><?php echo $userInfo['User']['email']?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('電話番号'); ?></td>
        <td>
          {{shopInfo.profile.tel1}}&nbsp;-&nbsp;
          {{shopInfo.profile.tel2}}&nbsp;-&nbsp;
          {{shopInfo.profile.tel3}}
        </td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('FAX番号'); ?></td>
        <td>
          {{shopInfo.profile.fax1}}&nbsp;-&nbsp;
          {{shopInfo.profile.fax2}}&nbsp;-&nbsp;
          {{shopInfo.profile.fax3}}
        </td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('携帯電話'); ?></td>
        <td>
          {{shopInfo.profile.mobile_tel1}}&nbsp;-&nbsp;
          {{shopInfo.profile.mobile_tel2}}&nbsp;-&nbsp;
          {{shopInfo.profile.mobile_tel3}}
        </td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('郵便番号'); ?></td>
        <td>{{shopInfo.profile.zip_code1}}&nbsp;-&nbsp;{{shopInfo.profile.zip_code2}}</td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('都道府県'); ?></td>
        <td>{{shopInfo.profile.pref_disp}}</td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('市区町村'); ?></td>
        <td>{{shopInfo.profile.city}}</td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('住所（番地）'); ?></td>
        <td>{{shopInfo.profile.address_opt1}}</td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('住所（建物）'); ?></td>
        <td>{{shopInfo.profile.address_opt2}}</td>
      </tr>
    </table>

    <div class="btn_center">
      <a href="/agent/edit" class="btn btn_blue"><?php echo __('更新'); ?></a>
    </div>
  </fieldset>

</div>

<!-- ▼ Script -->
<?php echo $this->Html->scriptStart(array('inline' => false)) ?>
$(document).ready(function(){
moduleBase.controller('shopInfoController', ['$scope', 'AjaxUrlAccess', function($scope, AjaxUrlAccess) {
  $scope.shopInfo = <?php echo $shopInfo; ?>;
}]);
angular.bootstrap($('#shopInfo'), ['moduleBase']);
});
<?php echo $this->Html->scriptEnd(); ?>
<!-- ▲ Script -->
