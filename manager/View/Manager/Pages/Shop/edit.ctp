<ol class="breadcrumb">
  <li><a href="/"><?php echo __('トップ'); ?></a></li>
  <li><a href="/client/list"><?php echo __('クライアント一覧'); ?></a></li>
  <li><a href="/client/info/<?php echo $userInfo['User']['id']; ?>">クライアント情報</a></li>
  <li class="actice">お店情報編集</li>
</ol>

<h2>お店情報編集<small>&nbsp;|&nbsp;<?php echo __('クライアント'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="well well-sm">
  <a href="/client/edit/<?php echo $userInfo['User']['id']; ?>">基本情報編集</a>&nbsp;|&nbsp;
  <a href="/shop/edit/<?php echo $userInfo['User']['id']; ?>">お店情報の編集</a>
</div>

<div class="panel panel-default">
  <div class="panel-heading">入力フォーム</div>

  <?php echo $this->Form->create(false, array('url' => array('action' => 'edit', $userInfo['User']['id']), 'novalidate' => true)); ?>
    <div class="panel-body form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label">お店の名前</label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('Shop.shop_name', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => 'お店の名前', 'ng-model' => 'shopInfo.profile.shop_name')); ?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">電話番号</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('Shop.tel1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '市外局番', 'maxlength' => '3')); ?>
          <?php echo $this->Form->input('Shop.tel2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '上4桁', 'maxlength' => '4')); ?>
          <?php echo $this->Form->input('Shop.tel3', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '下4桁', 'maxlength' => '4')); ?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">FAX番号</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('Shop.fax1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '市外局番', 'maxlength' => '3')); ?>
          <?php echo $this->Form->input('Shop.fax2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '上4桁', 'maxlength' => '4')); ?>
          <?php echo $this->Form->input('Shop.fax3', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '下4桁', 'maxlength' => '4')); ?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">携帯電話</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('Shop.mobile_tel1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '市外局番', 'maxlength' => '3')); ?>
          <?php echo $this->Form->input('Shop.mobile_tel2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '上4桁', 'maxlength' => '4')); ?>
          <?php echo $this->Form->input('Shop.mobile_tel3', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '下4桁', 'maxlength' => '4')); ?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">郵便番号</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('Shop.zip_code1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '上3桁', 'maxlength' => '3')); ?>
          <?php echo $this->Form->input('Shop.zip_code2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '下4桁', 'maxlength' => '4')); ?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">都道府県</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('Shop.pref', array('type' => 'select', 'options' => Configure::read('PrefList'), 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">市区町村</label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('Shop.city', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '市区町村')); ?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">住所（番地）</label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('Shop.address_opt1', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '住所（番地）を入力')); ?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">住所（建物）</label>
        <div class="col-sm-10">
          <?php echo $this->Form->input('Shop.address_opt2', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-control', 'placeholder' => '住所（番地）を入力')); ?>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          <button class="btn btn-default" onclick="return confirm('お店情報を更新します。\nよろしいですか');">更新</button>
        </div>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>

<a href="/client/info/<?php echo $userInfo['User']['id']; ?>" class="btn btn-default">詳細に戻る</a>
