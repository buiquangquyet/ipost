<ol class="breadcrumb">
  <li><a href="/">HOME</a></li>
  <li><a href="/client/list">アカウント一覧</a></li>
  <li><a href="/client/info/<?php echo $userInfo['User']['id']; ?>">クライアント情報</a></li>
  <li class="actice">クライアントの状態</li>
</ol>

<h2>クライアントの状態<small>&nbsp;|&nbsp;クライアント</small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-default">
  <div class="panel-heading">入力フォーム</div>

  <?php echo $this->Form->create(false, array('url' => array('action' => 'edit', $userInfo['User']['id']), 'novalidate' => true)); ?>
  <div class="panel-body form-horizontal">
    <div class="form-group">
      <label class="col-sm-2 control-label">アプリ状況</label>
      <div class="col-sm-10 form-inline">
        <?php echo $this->Form->input('Status.status', array('type' => 'select', 'options' => Configure::read('ShopStatusInfo'), 'div' => false, 'label' => false, 'class' => 'form-control'));?>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">有効期限</label>
      <div class="col-sm-10 form-inline">
        <?php echo $this->Form->input('Status.expired_year', array('type' => 'select', 'options' => $optYear,'selected' => date('Y'), 'div' => false, 'label' => false, 'class' => 'form-control'));?>&nbsp;年&nbsp;
        <?php echo $this->Form->input('Status.expired_month', array('type' => 'select', 'options' => $optMonth,'selected' => date('m'), 'div' => false, 'label' => false, 'class' => 'form-control'));?>&nbsp;月&nbsp;
        <?php echo $this->Form->input('Status.expired_day', array('type' => 'select', 'options' => $optDay,'selected' => date('d'), 'div' => false, 'label' => false, 'class' => 'form-control'));?>&nbsp;日&nbsp;
        <p class="help-block">有効期限を選択してください。<br>現在の日付より未来を選択するようにお願いします。<br>過去を選択場合は、公開中のアプリはご利用できなくなります。</p>
      </div>
    </div>

    <hr>

    <div class="form-group">
      <label class="col-sm-2 control-label">&nbsp;</label>
      <div class="col-sm-10">
        <button class="btn btn-default" onclick="return confirm('クライアントの状態を更新します。\nよろしいですか');">更新</button>
      </div>
    </div>
  </div>
  <?php echo $this->Form->end(); ?>
</div>

<a href="/client/info/<?php echo $userInfo['User']['id'];?>" class="btn btn-default">詳細に戻る</a>
