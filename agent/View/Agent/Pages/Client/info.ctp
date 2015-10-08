<div id="shopInfo" class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('アカウント一覧'); ?>&nbsp;>&nbsp;<?php echo __('アカウント情報'); ?></div>
  <h2><i class="fa fa-user">&nbsp;</i><?php echo __('ユーザー管理'); ?><span>｜<?php echo __('クライアント管理'); ?></span></h2>

  <div role="alert">
    <?php echo $this->Session->flash(); ?>
  </div>

  <!-- ▼ ステータス
  <h3><?php echo __('ステータス');?></h3>
  <fieldset ng-controller='shopStatusController'>
    <table>
       <tr>
         <td class="subject"><?php echo __('アプリ状況'); ?></td>
         <td>{{shopStatus.status_disp}}</td>
       </tr>
       <tr>
         <td class="subject"><?php echo __('有効期限'); ?></td>
         <td>{{shopStatus.expired}}</td>
       </tr>
    </table>
    <div class="btn_center">
      <a href="/account/shop/status/update/<?php echo $userInfo['User']['id'];?>" class="btn"><?php echo __('編集');?></a>
    </div>
  </fieldset>
▲ ステータス -->

  <!-- ▼ 選択言語 -->
  <h3><?php echo __('対応言語');?></h3>
  <fieldset>
    <table>
      <tr>
        <td class="subject"><?php echo __('対応言語'); ?></td>
        <?php if (empty($userInfo['UserLang'])) : ?>
        <td>未選択</td>
        <?php else: ?>
        <td><?php foreach($userInfo['UserLang'] as $item) : ?></td>
        <td>&nbsp;<img src="/img/common/flag_icons/<?php echo $item['lang']; ?>.png" alt="" width="30" >&nbsp;</td>
        <?php endforeach; ?>
        <?php endif; ?>
      </tr>
    </table>

    <div class="btn_center">
      <a href="/client/lang/<?php echo $userInfo['User']['id'];?>" class="btn"><?php echo __('編集');?></a>
    </div>
  </fieldset>
  <!-- ▲ クライアント情報 -->

  <!-- ▼ 選択言語 -->
  <h3><?php echo __('クライアント基本情報');?></h3>
  <fieldset>
    <table>
      <tr>
        <td class="subject"><?php echo __('ID'); ?></td>
        <td><?php echo $userInfo['User']['id'];?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('氏名'); ?></td>
        <td><?php echo $userInfo['User']['user_name']?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('メールアドレス'); ?></td>
        <td><?php echo $userInfo['User']['email']?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('最終ログイン日時'); ?></td>
        <td><?php echo $userInfo['User']['last_login']?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('登録日時'); ?></td>
        <td><?php echo $userInfo['User']['created']?></td>
      </tr>
    </table>

    <div class="btn_center">
      <a href="/client/edit/<?php echo $userInfo['User']['id'];?>" class="btn"><?php echo __('編集');?></a>
    </div>
  </fieldset>
  <!-- ▲ クライアント情報 -->

  <!-- ▼ お店情報 -->
  <h3><?php echo __('お店情報');?></h3>
  <fieldset ng-controller='shopInfoController'>
    <table>
      <tr>
        <td class="subject"><?php echo __('お店の名前'); ?></td>
        <td>
          {{shopInfo.profile.shop_name}}
        </td>
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
      <a href="/shop/edit/<?php echo $userInfo['User']['id'];?>" class="btn"><?php echo __('編集');?></a>
    </div>
  </fieldset>
  <!-- ▲ お店情報 -->

  <!-- ▼ 備考欄 -->
  <h3><?php echo __('備考欄');?></h3>
  <fieldset ng-controller='shopInfoController'>
    <div>
      <?php echo $this->Form->create(false); ?>
        <?php echo $this->Form->input('UserDetail.remarks_agent', array('type' => 'textarea', 'div' => false, 'label' => false, 'placeholder' => __('備考欄'), 'style' => 'width:100%;height:10em;'));?>
        <div class="btn_center">
        <?php echo $this->Form->input('UserDetail.id', array('type' => 'hidden'));?>
          <?php echo $this->Form->submit(__('更新'), array('type' => 'submit', 'div' => false, 'class' => 'btn btn_orange', 'onclick' => 'return confirm(\'' . __('備考欄を更新します。よろしいですか') . '\');'));?>
        </div>
      </form>
    </div>
  </fieldset>
  <!-- ▲ 備考欄 -->

  <!-- ▼ Store URL -->
  <h3><?php echo __('Store URL');?></h3>
  <fieldset ng-controller='storeInfoController'>
    <div>iTunes:&nbsp;{{storeInfo.url.apple}}</div>
    <div>Google Play:&nbsp;{{storeInfo.url.google}}</div>
  </fieldset>
  <!-- ▲ Store URL -->

  <!-- ▼ パスワード再発行 -->
  <h3><?php echo __('パスワード再発行');?></h3>
  <fieldset ng-controller='storeInfoController'>
    <div><a href="/client/remind/<?php echo $userInfo['User']['id'];?>"><?php echo __('パスワード再発行');?></a></div>
  </fieldset>
  <!-- ▲ パスワード再発行 -->

</div>

<!-- ▼ Script -->
<?php echo $this->Html->scriptStart(array('inline' => false)) ?>
$(document).ready(function(){
moduleBase.controller('shopStatusController', ['$scope', 'AjaxUrlAccess', function($scope, AjaxUrlAccess) {
  $scope.shopStatus = <?php echo $shopStatus;?>;
}]);
moduleBase.controller('shopInfoController', ['$scope', 'AjaxUrlAccess', function($scope, AjaxUrlAccess) {
  $scope.shopInfo = <?php echo $shopInfo;?>;
}]);
moduleBase.controller('storeInfoController', ['$scope', 'AjaxUrlAccess', function($scope, AjaxUrlAccess) {
  $scope.storeInfo = <?php echo $storeInfo;?>;
}]);
angular.bootstrap($('#shopInfo'), ['moduleBase']);
});
<?php echo $this->Html->scriptEnd(); ?>
<!-- ▲ Script -->
