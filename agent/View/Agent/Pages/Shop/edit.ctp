<div id="shopInfo" class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('アカウント一覧'); ?>&nbsp;>&nbsp;<?php echo __('アカウント情報'); ?></div>
  <h2><i class="fa fa-user">&nbsp;</i><?php echo __('ユーザー管理'); ?><span>｜<?php echo __('クライアント管理'); ?></span></h2>

  <h3><?php echo __('クライアント情報の編集'); ?></h3>

  <fieldset ng-controller='shopInfoController'>
    <?php echo $this->Form->create(false, array('id' => 'shopInfoForm', 'url' => array('controller' => 'ajax', 'action' => 'regist', $userInfo['User']['id']), 'novalidate' => true)); ?>
      <table>
        <tr>
          <td class="subject"><?php echo __('お店の名前'); ?></td>
          <td>
            <?php echo $this->Form->input('Shop.shop_name', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-5', 'placeholder' => __('お店の名前'), 'ng-model' => 'shopInfo.profile.shop_name'));?>
            <p ng-repeat="validate_message in validate.message.shop_name" style="color: red;">{{validate_message}}</p>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('電話番号'); ?></td>
          <td>
            <?php echo $this->Form->input('Shop.tel1', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'placeholder' => __('市外局番'), 'maxlength' => '3', 'ng-model' => 'shopInfo.profile.tel1'));?>
            <?php echo $this->Form->input('Shop.tel2', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'placeholder' => __('上4桁'), 'maxlength' => '4', 'ng-model' => 'shopInfo.profile.tel2'));?>
            <?php echo $this->Form->input('Shop.tel3', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'placeholder' => __('下4桁'), 'maxlength' => '4', 'ng-model' => 'shopInfo.profile.tel3'));?>
            <p ng-repeat="validate_message in validate.message.tel" style="color: red;">{{validate_message}}</p>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('FAX'); ?></td>
          <td>
            <?php echo $this->Form->input('Shop.fax1', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'placeholder' => __('市外局番'), 'maxlength' => '3', 'ng-model' => 'shopInfo.profile.fax1'));?>
            <?php echo $this->Form->input('Shop.fax2', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'placeholder' => __('上4桁'), 'maxlength' => '4', 'ng-model' => 'shopInfo.profile.fax2'));?>
            <?php echo $this->Form->input('Shop.fax3', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'placeholder' => __('下4桁'), 'maxlength' => '4', 'ng-model' => 'shopInfo.profile.fax3'));?>
            <p ng-repeat="validate_message in validate.message.fax" style="color: red;">{{validate_message}}</p>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('携帯電話'); ?></td>
          <td>
            <?php echo $this->Form->input('Shop.mobile_tel1', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'placeholder' => __('市外局番'), 'maxlength' => '3', 'ng-model' => 'shopInfo.profile.mobile_tel1'));?>
            <?php echo $this->Form->input('Shop.mobile_tel2', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'placeholder' => __('上4桁'), 'maxlength' => '4', 'ng-model' => 'shopInfo.profile.mobile_tel2'));?>
            <?php echo $this->Form->input('Shop.mobile_tel3', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'placeholder' => __('下4桁'), 'maxlength' => '4', 'ng-model' => 'shopInfo.profile.mobile_tel3'));?>
            <p ng-repeat="validate_message in validate.message.mobile_tel" style="color: red;">{{validate_message}}</p>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('郵便番号'); ?></td>
          <td>
            <?php echo $this->Form->input('Shop.zip_code1', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'placeholder' => __('上3桁'), 'maxlength' => '3', 'ng-model' => 'shopInfo.profile.zip_code1'));?>
            <?php echo $this->Form->input('Shop.zip_code2', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-2', 'placeholder' => __('下4桁'), 'maxlength' => '4', 'ng-model' => 'shopInfo.profile.zip_code2'));?>
            <p ng-repeat="validate_message in validate.message.zip_code" style="color: red;">{{validate_message}}</p>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('都道府県'); ?></td>
          <td>
            <?php echo $this->Form->input('Shop.pref', array('type' => 'select', 'options' => Configure::read('PrefList'), 'label' => false, 'div' => false, 'class' => 'form-select', 'ng-model' => 'shopInfo.profile.pref'));?>
            <p ng-repeat="validate_message in validate.message.pref" style="color: red;">{{validate_message}}</p>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('市区町村'); ?></td>
          <td>
            <?php echo $this->Form->input('Shop.city', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-5', 'placeholder' => __('市区町村'), 'ng-model' => 'shopInfo.profile.city'));?>
            <p ng-repeat="validate_message in validate.message.city" style="color: red;">{{validate_message}}</p>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('住所（番地）'); ?></td>
          <td>
            <?php echo $this->Form->input('Shop.address_opt1', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-5', 'placeholder' => __('住所（番地）'), 'ng-model' => 'shopInfo.profile.address_opt1'));?>
            <p ng-repeat="validate_message in validate.message.address_opt1" style="color: red;">{{validate_message}}</p>
          </td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('住所（建物）'); ?></td>
          <td>
            <?php echo $this->Form->input('Shop.address_opt2', array('type' => 'text', 'div' => false, 'label' => false, 'error'=> false, 'class'=>'form-txt form-5', 'placeholder' => __('住所（番地）'), 'ng-model' => 'shopInfo.profile.address_opt2'));?>
            <p ng-repeat="validate_message in validate.message.address_opt2" style="color: red;">{{validate_message}}</p>
          </td>
        </tr>
      </table>

      <div class="btn_center">
        <input type="button" value="<?php echo __('キャンセル'); ?>" onclick="document.location='/client/info/<?php echo $userInfo['User']['id']?>';" class="btn btn_gray"/>&nbsp;<button type="button" class="btn btn_orange" ng-click="registShopInfo('#shopInfoForm')"><?php echo __('更新'); ?></button>
      </div>
    <?php echo $this->Form->end(); ?>
  </fieldset>
</div>

<!-- ▼ Script -->
<script type="text/javascript">
$(document).ready(function(){
  moduleBase.controller('shopInfoController', ['$scope', 'AjaxUrlAccess', function($scope, AjaxUrlAccess) {
    $scope.shopInfo = <?php echo $shopInfo; ?>;
    $scope.registShopInfo = function(id) {
      if (window.confirm('<?php echo __('代理店情報を更新します。よろしいですか'); ?>')) {
        resultObject = AjaxUrlAccess.postData(id, 'redirectUrl()');
        console.log(resultObject);
        $scope.validate = resultObject.error;
        $scope.shopInfo.process = resultObject.result;
      };
    };
  }]);
  angular.bootstrap($('#shopInfo'), ['moduleBase']);
});
function redirectUrl() {
  <?php  ?>
  location.href = '<?php echo Router::url(array('action' => 'edit_success', $userInfo['User']['id'])); ?>';
}
</script>
<!-- ▲ Script -->
