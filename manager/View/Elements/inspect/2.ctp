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

    <?php echo $this->Form->create('Reject', array('url' => array('controller' => 'inspect', 'action' => 'info', $requestInfo['InspectRequest']['id']))); ?>
      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label">リジェクト理由</label>
          <div class="col-sm-10 form-inline">
            <?php echo $this->Form->input('Reject.type', array('type' => 'select', 'options' => Configure::read('InspectRejectType'), 'label' => false, 'div' => false, 'class' => 'form-control'));?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">リジェクトタイトル</label>
          <div class="col-sm-10">
            <?php echo $this->Form->input('Reject.title', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => 'リジェクトタイトル'));?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">リジェクトコメント</label>
          <div class="col-sm-10">
            <?php echo $this->Form->input('Reject.body', array('type' => 'textarea', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => 'リジェクト理由'));?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">&nbsp;</label>
          <div class="col-sm-10">
            <input type="submit" class="btn btn-danger" value="リジェクト" />
          </div>
        </div>
      </div>
    <?php echo $this->Form->end();?>

    <hr>

    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          <a href="/inspect/pass/<?php echo $requestInfo['InspectRequest']['id']; ?>" class="btn btn-success" onclick="return confirm('このアプリを審査通過させます。\n本当に処理しますか？');">簡易審査通過</a>
        </div>
      </div>
    </div>
  </div>
