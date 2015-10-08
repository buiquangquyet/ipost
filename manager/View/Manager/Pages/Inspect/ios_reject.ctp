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

  <div class="panel-body">
    <?php echo $this->Form->create('Reject', array('url' => array('controller' => 'inspect', 'action' => 'ios_reject', $requestInfo['InspectRequest']['id']))); ?>
      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label"><?php echo __('リジェクト理由'); ?></label>
          <div class="col-sm-10 form-inline">
            <?php echo $this->Form->input('Reject.type', array('type' => 'select', 'options' => Configure::read('InspectRejectAppleType'), 'label' => false, 'div' => false, 'class' => 'form-control'));?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label"><?php echo __('リジェクトコメント'); ?></label>
          <div class="col-sm-10">
            <?php echo $this->Form->input('Reject.body', array('type' => 'textarea', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => __('リジェクトコメント')));?>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <a href="/inspect/info/<?php echo $requestInfo['InspectRequest']['id']; ?>" class="btn btn-default"><?php echo __('戻る'); ?></a>
            <input type="submit" class="btn btn-danger" value="<?php echo __('リジェクト'); ?>" />
          </div>
        </div>
      </div>
    <?php echo $this->Form->end();?>
  </div>
</div>

