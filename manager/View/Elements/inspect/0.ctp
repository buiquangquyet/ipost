  <div class="panel-body">
    <?php echo $this->Form->create('Reject', array('url' => array('controller' => 'inspect', 'action' => 'info', $requestInfo['InspectRequest']['id']))); ?>

      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label">審査官選択</label>
          <div class="col-sm-10 form-inline">
            <?php echo $this->Form->input('Reject.master_id', array('type' => 'select', 'options' => $managers, 'value' => $requestInfo['InspectRequest']['master_id'], 'label' => false, 'div' => false, 'class' => 'form-control'));?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">&nbsp;</label>
          <div class="col-sm-10 form-inline">
            <input type="submit" class="btn btn-default" value="担当者設定">
          </div>
        </div>
      </div>
    <?php echo $this->Form->end();?>

      <hr>

      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label">&nbsp;</label>
          <div class="col-sm-10 form-inline">
            <p>本クライアントは簡易リジェクトを受け、現在修正対応をお願いしている状態です。<br>クライアントからの簡易審査の再申請があるまで待機してください。</p>
          </div>
        </div>
      </div>

    </div>
  </div>
