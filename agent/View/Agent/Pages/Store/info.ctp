<div id="storeInfo" class="main" ng-controller="StoreInfoController">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('アプリ情報'); ?></div>
  <h2><i class="fa fa-user">&nbsp;</i><?php echo __('ストア掲載情報'); ?></span></h2>

  <h3><?php echo __('ストア基本情報'); ?></h3>

  <fieldset>
    <table>
      <tr>
        <td class="subject"><?php echo __('アプリ名'); ?></td>
        <td>{{storeInfo.store_info.app_name}}</td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('ストア名'); ?></td>
        <td>{{storeInfo.store_info.app_disp_name}}</td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('アプリ説明文'); ?></td>
        <td> {{storeInfo.store_info.description}}</td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('AppleStore'); ?><br><?php echo __('メインカテゴリー'); ?></td>
        <td>{{storeInfo.store_category_info.category_iphone1}}</td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('AppleStore'); ?><br><?php echo __('サブカテゴリー'); ?></td>
        <td>{{storeInfo.store_category_info.category_iphone2}}</td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('GooglePlay'); ?><br><?php echo __('カテゴリー'); ?></td>
        <td>{{storeInfo.store_category_info.category_android}}</td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('AppStoreキーワード'); ?></td>
        <td>{{storeInfo.keyword}}</td>
      </tr>
    </table>
  </fieldset>

  <h3><?php echo __('ストア掲載画像'); ?></h3>
  <fieldset>
    <table>
      <tr>
        <td class="subject"><?php echo __('アプリアイコン'); ?></td>
        <td><img src="<?php echo $admin_domain; ?>/media/image/{{storeInfo.app_icon}}"  width="100" height="100"> </td>
      </tr>

      <!--
      <tr>
        <td class="subject"><?php echo __('GooglePlay宣伝画像'); ?></td>
        <td><img src="http://admin.ipost-hk.com/media/image/{{storeInfo.app_ad_image}}"  width="100" height="100"> </td>
      </tr>
      -->
    </table>
  </fieldset>

</div>

<!-- ▼ Script -->
<script type="text/javascript">
$(document).ready(function(){
  moduleBase.controller('StoreInfoController', ['$scope', 'AjaxUrlAccess', function($scope, AjaxUrlAccess) {
    $scope.storeInfo = <?php echo $storeInfo; ?>;
  }]);
  angular.bootstrap($('#storeInfo'), ['moduleBase']);
});
</script>
<!-- ▲ Script -->
