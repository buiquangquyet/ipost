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

    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          <p>本クライアントはAppleのリジェクトを受け、現在修正対応をお願いしている状態です。<br>クライアントからのApple審査の再申請があるまで待機してください。</p>
        </div>
      </div>
    </div>
  </div>
