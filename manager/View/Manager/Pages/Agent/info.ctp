<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/agent/list"><?php echo __('代理店一覧'); ?></a></li>
  <li class="actice"><?php echo __('代理店情報'); ?></li>
</ol>

<h2><?php echo __('代理店情報'); ?><small>&nbsp;|&nbsp;<?php echo __('代理店'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <div class="panel-heading"><?php echo __('代理店基本情報'); ?></div>

  <div class="panel-body form-horizontal">
    <div class="form-group">
      <label class="col-sm-2 control-label"><?php echo __('代理店ID'); ?></label>
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

    <hr>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <a href="/agent/edit_info/<?php echo $userInfo['User']['id']; ?>" class="btn btn-default"><?php echo __('編集'); ?></a>
      </div>
    </div>
  </div>
</div>

<a href="/agent/list" class="btn btn-default mb_20"><?php echo __('一覧に戻る'); ?></a>

<div class="panel panel-default">
  <div class="panel-heading"><?php echo __('代理店会社情報'); ?></div>

  <div class="panel-body form-horizontal">
    <div class="form-group">
      <label class="col-sm-2 control-label"><?php echo __('会社名'); ?></label>
      <div class="col-sm-10">
        <p class="form-control-static"><?php echo $userDetail['company_name']; ?></p>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"><?php echo __('電話番号'); ?></label>
      <div class="col-sm-10">
        <p class="form-control-static"><?php echo $userDetail['tel1']; ?>&nbsp;-&nbsp;<?php echo $userDetail['tel2']; ?>&nbsp;-&nbsp;<?php echo $userDetail['tel3']; ?></p>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"><?php echo __('FAX番号'); ?></label>
      <div class="col-sm-10">
        <p class="form-control-static"><?php echo $userDetail['fax1']; ?>&nbsp;-&nbsp;<?php echo $userDetail['fax2']; ?>&nbsp;-&nbsp;<?php echo $userDetail['fax3']; ?></p>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"><?php echo __('携帯電話'); ?></label>
      <div class="col-sm-10">
        <p class="form-control-static"><?php echo $userDetail['mobile_tel1']; ?>&nbsp;-&nbsp;<?php echo $userDetail['mobile_tel2']; ?>&nbsp;-&nbsp;<?php echo $userDetail['mobile_tel3']; ?></p>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"><?php echo __('郵便番号'); ?></label>
      <div class="col-sm-10">
        <p class="form-control-static"><?php echo $userDetail['zip_code1']; ?>&nbsp;-&nbsp;<?php echo $userDetail['zip_code2']; ?></p>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"><?php echo __('都道府県'); ?></label>
      <div class="col-sm-10">
        <p class="form-control-static"><?php echo $userDetail['pref_disp']; ?></p>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"><?php echo __('市区町村'); ?></label>
      <div class="col-sm-10">
        <p class="form-control-static"><?php echo $userDetail['city']; ?></p>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"><?php echo __('住所（番地）'); ?></label>
      <div class="col-sm-10">
        <p class="form-control-static"><?php echo $userDetail['address_opt1']; ?></p>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"><?php echo __('住所（建物）'); ?></label>
      <div class="col-sm-10">
        <p class="form-control-static"><?php echo $userDetail['address_opt2']; ?></p>
      </div>
    </div>

    <hr>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <a href="/agent/edit_detail/<?php echo $userInfo['User']['id']; ?>" class="btn btn-default"><?php echo __('編集'); ?></a>
      </div>
    </div>
  </div>
</div>

<a href="/agent/list" class="btn btn-default mb_20"><?php echo __('一覧に戻る'); ?></a>

<div class="panel panel-default">
  <div class="panel-heading"><?php echo __('所属クライアント一覧'); ?></div>

  <!-- Table -->
  <table class="table">
    <thead>
      <tr>
        <th><?php echo $this->Paginator->sort('User.id', __('ID')); ?></th>
        <th><?php echo $this->Paginator->sort('User.user_name', __('氏名')); ?></th>
        <th><?php echo $this->Paginator->sort('User.email', __('メールアドレス')); ?></th>
        <th><?php echo __('店舗名'); ?></th>
        <th><?php echo $this->Paginator->sort('User.last_login', __('最終ログイン日時')); ?></th>
        <th><?php echo __('状態'); ?></th>
        <th><?php echo __('操作'); ?></th>
      </tr>
    </thead>
    <tbody>
  <?php foreach ($users as $user) : ?>
      <tr>
        <td><span class="num"><?php echo $user['User']['id']; ?></span></td>
        <td><a href="/client/info/<?php echo $user['User']['id']; ?>"><?php echo $user['User']['user_name']; ?></a></td>
        <td><?php echo $user['User']['email']; ?></td>
        <td><?php echo $user['Shop']['profile']['shop_name']; ?></td>
        <td><?php echo $user['User']['last_login']; ?></td>
        <td><a href="/inspect/list/<?php echo $user['InspectRequest']['status']; ?>"><?php echo $user['InspectRequest']['status_disp']; ?></a></td>
        <td><a href="/client/info/<?php echo $user['User']['id']; ?>"><?php echo __('詳細'); ?></a></td>
      </tr>
  <?php endforeach; ?>
    </tbody>
  </table>

  <div class="panel-footer txt_c">
    <?php echo $this->Paginator->prev(__('< 前へ'), array(), null, array('class' => 'prev disabled'));?>
    <?php echo $this->Paginator->numbers(array('class' => 'paginate', 'currentClass'=>'active'));?>
    <?php echo $this->Paginator->next(__('次へ >'), array(), null, array('class' => 'next disabled'));?>
  </div>
</div>

<a href="/agent/list" class="btn btn-default mb_20"><?php echo __('一覧に戻る'); ?></a>

<div class="panel panel-danger">
  <div class="panel-heading"><?php echo __('代理店削除'); ?></div>
  <div class="panel-body">
    <a href="/agent/delete/<?php echo $userInfo['User']['id'];?>"><?php echo __('代理店削除'); ?></a>
  </div>
</div>

<a href="/agent/list" class="btn btn-default mb_20"><?php echo __('一覧に戻る'); ?></a>

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
