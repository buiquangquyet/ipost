<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/inspect/list"><?php echo __('審査申請アプリ一覧'); ?></a></li>
  <li class="actice"><?php echo __('審査申請結果通知'); ?></li>
</ol>

<h2><?php echo __('審査申請結果通知'); ?><small>&nbsp;|&nbsp;<?php echo __('アプリ審査'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <div class="panel-heading"><?php echo __('申請状態'); ?></div>

  <div class="panel-body">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('ユーザーID'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static"><a href="/client/info/<?php echo $userInfo['User']['id']; ?>"><?php echo $userInfo['User']['id']; ?></a></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('ユーザー名'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static"><a href="/client/info/<?php echo $userInfo['User']['id']; ?>"><?php echo $userInfo['User']['user_name']; ?></a></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('受付日時'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo $requestInfo['InspectRequest']['created']; ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('経過時間'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo $elapsed_time; ?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('状態'); ?></label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo $requestInfo['InspectRequest']['status_disp']; ?></p>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="panel panel-default">
  <div class="panel-heading"><?php echo __('申請結果通知'); ?></div>

  <?php echo $this->element('inspect/'.$requestInfo['InspectRequest']['status']); ?>
</div>

<a href="/inspect/list" class="btn btn-default"><?php echo __('一覧に戻る'); ?></a>

