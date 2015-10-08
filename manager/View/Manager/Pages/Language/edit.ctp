<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li><a href="/language/list" title=""><?php echo __('言語マップ一覧'); ?></a></li>
  <li class="actice"><?php echo __('言語マップ登録'); ?></li>
</ol>

<h2><?php echo __('言語マップ登録'); ?><small>&nbsp;|&nbsp;<?php echo __('言語マップ'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<a href="/language/list" class="btn btn-default mb_20"><?php echo __('言語マップ一覧に戻る'); ?></a>

<div id="shopInfo" class="panel panel-default" ng-controller="shopInfoController">
  <div class="panel-heading"><?php echo __('入力フォーム'); ?></div>

  <?php echo $this->Form->create(false, array()); ?>
    <div class="panel-body form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('対応言語'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('LangMap.lang_after', array('type' => 'select', 'options' => Configure::read('LanguagesList'), 'div' => false, 'label' => false, 'class' => 'form-control'));?>
          <p class="help-block"><?php echo __('対応する言語を選択してください。'); ?></p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('言語'); ?></label>
        <div class="col-sm-10 form-inline">
          <?php echo $this->Form->input('LangMap.lang_before', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => __('jpn')));?>
          <p class="help-block"><?php echo __('アクセスしてくる言語を入力してください。'); ?></p>
        </div>
      </div>

      <hr>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <?php echo $this->Form->input('LangMap.id', array('type' => 'hidden'));?>
          <?php echo $this->Form->submit(__('登録'), array('class' => 'btn btn-default'));?>
        </div>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>
