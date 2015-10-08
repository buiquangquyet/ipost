  <div class="panel-body">
    <?php echo $this->Form->create('Reject', array('url' => array('controller' => 'inspect', 'action' => 'manager_update', $requestInfo['InspectRequest']['id']))); ?>
      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label">アプリ審査:&nbsp;担当者</label>
          <div class="col-sm-10 form-inline">
            <?php echo $this->Form->input('Reject.master_id', array('type' => 'select', 'options' => $managers, 'value' => $requestInfo['InspectRequest']['master_id'], 'label' => false, 'div' => false, 'class' => 'form-control'));?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">&nbsp;</label>
          <div class="col-sm-10">
            <input type="submit" class="btn btn-default" value="担当者設定">
          </div>
        </div>
      </div>
    <?php echo $this->Form->end();?>

    <hr>

    <?php echo $this->Form->create('Reject', array('url' => array('controller' => 'inspect', 'action' => 'ios_inspect', $requestInfo['InspectRequest']['id']))); ?>
      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label">&nbsp;</label>
          <div class="col-sm-10">
            <p>「iOSアプリ生成」と、「Appleへの審査申請が完了」したら下のボタンを押してください</p>
            <input type="submit" class="btn btn-default" value="Apple審査申請完了" onclick="return confirm('本当に更新処理を行いますか？');" />
          </div>
        </div>
      </div>
    <?php echo $this->Form->end();?>
  </div>
