<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/client/list"><?php echo __('クライアント一覧'); ?></a></li>
  <li class="actice"><?php echo __('クライアント情報'); ?></li>
</ol>

<h2><?php echo __('クライアント情報'); ?><small>&nbsp;|&nbsp;<?php echo __('クライアント'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div id="shopInfo"><!-- AngularJS用 id -->

<div id="user" class="panel panel-default">
  <div class="panel-heading"><?php echo __('クライアント基本情報'); ?></div>

  <div class="panel-body">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('ID'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo $userInfo['User']['id']; ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('氏名'); ?></label>
        <div class="col-sm-10">
          <p class="ruby-block"><small><?php echo $userInfo['User']['user_name_furi']; ?></small></p>
          <p class="form-control-static"><?php echo $userInfo['User']['user_name']; ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('メールアドレス'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo $userInfo['User']['email']; ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('最終ログイン日時'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo $userInfo['User']['last_login']; ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('登録日時'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo $userInfo['User']['created']; ?></p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <a href="/client/edit/<?php echo $userInfo['User']['id'];?>" class="btn btn-default"><?php echo __('編集'); ?></a>
        </div>
      </div>
    </div>
  </div>
</div>

<a href="/client/list" class="btn btn-default mb_20"><?php echo __('一覧に戻る'); ?></a>

<div id="agent" class="panel panel-default">
  <div class="panel-heading"><?php echo __('所属代理店情報'); ?></div>

  <div class="panel-body">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('ID'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static"><a href="/agent/info/<?php echo $agentInfo['User']['id']; ?>"><?php echo $agentInfo['User']['id']; ?></a></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('会社名'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo $agentInfo['UserDetail'][0]['company_name']; ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('氏名'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static"><a href="/agent/info/<?php echo $agentInfo['User']['id']; ?>"><?php echo $agentInfo['User']['user_name']; ?></a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<a href="/client/list" class="btn btn-default mb_20"><?php echo __('一覧に戻る'); ?></a>

<div id="status" class="panel panel-default" ng-controller="shopStatusController">
  <div class="panel-heading"><?php echo __('クライアントの状態'); ?></div>

  <div class="panel-body">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('アプリ状況'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static">{{shopStatus.status_disp}}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('有効期限'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static">{{shopStatus.expired}}</p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <a href="/shop/status/<?php echo $userInfo['User']['id'];?>" class="btn btn-default"><?php echo __('編集'); ?></a>
        </div>
      </div>
    </div>
  </div>
</div>

<a href="/client/list" class="btn btn-default mb_20"><?php echo __('一覧に戻る'); ?></a>

<div id="status" class="panel panel-default">
  <div class="panel-heading"><?php echo __('対応言語'); ?></div>

  <div class="panel-body">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('対応言語'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static">
            <?php if (empty($langInfo)) : ?>
              未設定
            <?php else: ?>
            <?php foreach ($langInfo as $lang) : ?>
              <img src="/img/common/flag_icons/<?php echo $lang['UserLang']['lang']; ?>.png" alt="">
            <?php endforeach; ?>
            <?php endif; ?>
          </p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <a href="/client/lang/<?php echo $userInfo['User']['id'];?>" class="btn btn-default"><?php echo __('編集'); ?></a>
        </div>
      </div>
    </div>
  </div>
</div>

<a href="/client/list" class="btn btn-default mb_20"><?php echo __('一覧に戻る'); ?></a>

<div id="shop" class="panel panel-default" ng-controller="shopInfoController">
  <div class="panel-heading"><?php echo __('お店情報'); ?></div>

  <div class="panel-body">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('お店の名前'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static">{{shopInfo.profile.shop_name}}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('電話番号'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static">{{shopInfo.profile.tel1}}&nbsp;-&nbsp;
          {{shopInfo.profile.tel2}}&nbsp;-&nbsp;
          {{shopInfo.profile.tel3}}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('FAX番号'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static">{{shopInfo.profile.fax1}}&nbsp;-&nbsp;
          {{shopInfo.profile.fax2}}&nbsp;-&nbsp;
          {{shopInfo.profile.fax3}}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('携帯電話'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static">{{shopInfo.profile.mobile_tel1}}&nbsp;-&nbsp;
          {{shopInfo.profile.mobile_tel2}}&nbsp;-&nbsp;
          {{shopInfo.profile.mobile_tel3}}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('郵便番号'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static">{{shopInfo.profile.zip_code1}}&nbsp;-&nbsp;{{shopInfo.profile.zip_code2}}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('都道府県'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static">{{shopInfo.profile.pref_disp}}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('市区町村'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static">{{shopInfo.profile.city}}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('住所（番地）'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static">{{shopInfo.profile.address_opt1}}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('住所（建物）'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static">{{shopInfo.profile.address_opt2}}</p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <a href="/shop/edit/<?php echo $userInfo['User']['id'];?>" class="btn btn-default"><?php echo __('編集'); ?></a>
        </div>
      </div>
    </div>
  </div>
</div>

<a href="/client/list" class="btn btn-default mb_20"><?php echo __('一覧に戻る'); ?></a>

<div id="store" class="panel panel-default" ng-controller="storeInfoController">
  <div class="panel-heading"><?php echo __('ストア情報'); ?></div>

  <div class="panel-body">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('App Store'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static">{{storeInfo.url.apple}}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('Google Play'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static">{{storeInfo.url.google}}</p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <a href="/store/url/<?php echo $userInfo['User']['id'];?>" class="btn btn-default"><?php echo __('編集'); ?></a>
        </div>
      </div>
    </div>
  </div>
</div>

<a href="/client/list" class="btn btn-default mb_20"><?php echo __('一覧に戻る'); ?></a>

<div id="pem" class="panel panel-default">
  <div class="panel-heading"><?php echo __('pemファイル'); ?></div>

  <div class="panel-body">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('状態'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static"></p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <a href="/store/pem/<?php echo $userInfo['User']['id'];?>" class="btn btn-default"><?php echo __('編集'); ?></a>
        </div>
      </div>
    </div>
  </div>
</div>

<a href="/client/list" class="btn btn-default mb_20"><?php echo __('一覧に戻る'); ?></a>

<div id="remarks" class="panel panel-default" ng-controller="shopInfoController">
  <div class="panel-heading"><?php echo __('備考欄'); ?></div>

  <div class="panel-body">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('備考欄'); ?></label>
        <div class="col-sm-10">
          <?php echo $this->Form->create(false, array('url' => array('action' => 'info', $userInfo['User']['id']))); ?>
            <?php echo $this->Form->input('UserDetail.user_id', array('type' => 'hidden'));?>
            <?php echo $this->Form->input('UserDetail.remarks_manager', array('type' => 'textarea', 'div' => false, 'label' => false, 'class'=>'form-control mb_10', 'placeholder' => __('備考欄')));?>
            <input type="submit" class="btn btn-default" value="<?php echo __('更新する'); ?>">
          <?php echo $this->Form->end(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<a href="/client/list" class="btn btn-default mb_20"><?php echo __('一覧に戻る'); ?></a>

<div class="panel panel-danger">
  <div class="panel-heading"><?php echo __('クライアント削除'); ?></div>
  <div class="panel-body">
    <a href="/client/delete/<?php echo $userInfo['User']['id'];?>"><?php echo __('クライアント削除'); ?></a>
    <p class="help-block">アカウント情報の削除を行う画面へ移動します。</p>
  </div>
</div>

</div><!-- ▲ #shopInfo -->

<a href="/client/list" class="btn btn-default mb_20"><?php echo __('一覧に戻る'); ?></a>

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
