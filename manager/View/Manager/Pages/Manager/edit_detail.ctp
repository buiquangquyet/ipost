<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/agent/list"><?php echo __('代理店一覧'); ?></a></li>
  <li><a href="/agent/info/<?php echo $userDetail['UserDetail']['user_id']; ?>">代理店情報</a></li>
  <li class="actice">会社情報編集</li>
</ol>

<h2>会社情報編集<small>&nbsp;|&nbsp;<?php echo __('代理店'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <div class="panel-body">
    <a href="/agent/edit_info/<?php echo $userDetail['UserDetail']['user_id']; ?>">基本情報変種</a>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">入力フォーム</div>

  <?php echo $this->Form->create(false, array('url' => array('controller' => 'agent', 'action' => 'edit_detail', $userDetail['UserDetail']['user_id']), 'novalidate' => true)); ?>
    <div class="panel-body form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label">会社名</label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('UserDetail.company_name', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '会社名'));?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">電話番号</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('UserDetail.tel1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '市外局番', 'maxlength' => '3'));?>
          <?php echo $this->Form->input('UserDetail.tel2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '上4桁', 'maxlength' => '4'));?>
          <?php echo $this->Form->input('UserDetail.tel3', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '下4桁', 'maxlength' => '4'));?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">FAX番号</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('UserDetail.fax1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '市外局番', 'maxlength' => '3'));?>
          <?php echo $this->Form->input('UserDetail.fax2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '上4桁', 'maxlength' => '4'));?>
          <?php echo $this->Form->input('UserDetail.fax3', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '下4桁', 'maxlength' => '4'));?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">携帯電話</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('UserDetail.mobile_tel1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '市外局番', 'maxlength' => '3'));?>
          <?php echo $this->Form->input('UserDetail.mobile_tel2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '上4桁', 'maxlength' => '4'));?>
          <?php echo $this->Form->input('UserDetail.mobile_tel3', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '下4桁', 'maxlength' => '4'));?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">郵便番号</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('UserDetail.zip_code1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '上3桁', 'maxlength' => '3'));?>
          <?php echo $this->Form->input('UserDetail.zip_code2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '下4桁', 'maxlength' => '4'));?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">都道府県</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('UserDetail.pref', array('type' => 'select', 'options' => Configure::read('PrefList'), 'label' => false, 'div' => false, 'class' => 'form-control'));?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">市区町村</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('UserDetail.city', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '市区町村'));?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">住所（番地）</label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('UserDetail.address_opt1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '住所（番地）'));?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">住所（建物）</label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('UserDetail.address_opt2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '住所（建物）'));?>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          <a href="/agent/info/<?php echo $userDetail['UserDetail']['user_id']; ?>" class="btn btn-default">詳細に戻る</a>
          <button class="btn btn-default" onclick="return confirm('会社情報を更新します。\nよろしいですか');">更新</button>
        </div>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>
