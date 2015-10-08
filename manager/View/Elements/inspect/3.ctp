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

    <?php echo $this->Form->create('Reject', array('url' => array('controller' => 'inspect', 'action' => 'release_android', $requestInfo['InspectRequest']['id']))); ?>
      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label">&nbsp;</label>
          <div class="col-sm-10 form-inline">
            <p>GooglePlayへのURLの登録は済んでいますか？</p>
            <input type="submit" class="btn btn-default" value="Androidアプリ リリース完了" onclick="return confirm('GooglePlayへのURLの登録は済んでいますか？\nこのまま更新処理を行いますか？');" />
          </div>
        </div>
      </div>
    <?php echo $this->Form->end();?>
  </div>
