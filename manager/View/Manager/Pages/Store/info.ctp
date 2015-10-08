<div id="storeInfo" class="main" ng-controller="StoreInfoController">

<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/inspect/list">審査申請アプリ一覧</a></li>
  <li class="actice">ストア情報</li>
</ol>

<h2>ストア情報<small>&nbsp;|&nbsp;アプリ審査</small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <div class="panel-heading">ストア基本情報</div>

  <div class="panel-body">
    <div class="form-horizontal">

      <div class="form-group">
        <label class="col-sm-2 control-label">アプリ名</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{storeInfo.text.app_name}}</p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">ストア名</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{storeInfo.text.store_name}}</p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">アプリ説明文</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{storeInfo.text.description}}</p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">AppleStore<br>メインカテゴリー</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{storeInfo.category.apple1}}</p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">AppleStore<br>サブカテゴリー</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{storeInfo.category.apple2}}</p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">GooglePlay<br>カテゴリー</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{storeInfo.category.android}}</p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">AppStoreキーワード</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{storeInfo.text.keyword}}</p>
        </div>
      </div>

    </div><!-- /.form-horizontal -->
  </div><!-- /.panel-body -->
</div>

<div class="panel panel-default">
  <div class="panel-heading">ストア掲載画像</div>

  <div class="panel-body">
    <div class="form-horizontal">

      <div class="form-group">
        <label class="col-sm-2 control-label">アプリ名</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{storeInfo.image.icon}}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">アプリ名</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{storeInfo.image.publicity}}</p>
        </div>
      </div>

    </div><!-- /.form-horizontal -->
  </div><!-- /.panel-body -->
</div><!-- /.panel.panel-default -->

</div><!-- /#storeInfo -->

<a href="/inspect/list" class="btn btn-default mb_20">一覧に戻る</a>

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
