  <div class="panel-body">
    <?php echo $this->Form->create('Reject', array('url' => array('controller' => 'inspect', 'action' => 'manager_update', $requestInfo['InspectRequest']['id']))); ?>
      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label">審査官選択</label>
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

    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          <p>Appleからの審査結果に応じて以下のリンク/ボタンから処理を進めて下さい</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          <a href="/inspect/ios_reject/<?php echo $requestInfo['InspectRequest']['id']; ?>" class="btn btn-danger">Apple審査リジェクト</a>
        </div>
      </div>
    </div>

    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          <a href="/inspect/ios_pass/<?php echo $requestInfo['InspectRequest']['id']; ?>" class="btn btn-success" onclick="return confirm('本当に更新処理を行いますか？');">Apple審査通過</a>
        </div>
      </div>
    </div>
  </div>
