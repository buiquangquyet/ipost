<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i>&nbsp;<?php echo __('トップ'); ?></a></li>
  <li class="actice"><?php echo __('審査申請アプリ一覧'); ?></li>
</ol>

<h2><?php echo __('審査申請アプリ一覧'); ?><small>&nbsp;|&nbsp;<?php echo __('アプリ審査'); ?></small></h2>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="form-inline mb_10">
<?php echo $this->Form->input('InspectRequest.status', array('type' => 'select', 'options' => Configure::read('InspectStatusInfo'), 'label' => false, 'div' => false, 'class' => 'form-control', 'value' => $current_status, 'onchange' => 'searchStatus();'));?>
</div>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><?php echo __('審査申請アプリ一覧'); ?></div>

  <!-- Table -->
  <table class="table">
    <thead>
      <tr>
        <th><?php echo $this->Paginator->sort('InspectRequest.created', '申請日時'); ?></th>
        <th><?php echo __('申請者'); ?></th>
        <th><?php echo __('アプリ名'); ?></th>
        <th><?php echo $this->Paginator->sort('InspectRequest.status', '状態'); ?></th>
        <th><?php echo __('アプリ情報'); ?></th>
        <th><?php echo __('ストア情報'); ?></th>
        <th><?php echo __('操作'); ?></th>
      </tr>
    </thead>
    <tbody>
<?php foreach ((array)$list as $item) : ?>
      <tr>
        <td><?php echo $item['InspectRequest']['requeted']; ?></td>
        <td><a href="/client/info/<?php echo $item['InspectRequest']['user_id']; ?>"><?php echo $item['InspectRequest']['user_name']; ?></a></td>
        <td><?php echo $item['InspectRequest']['app_name']; ?></td>
        <td><?php echo $item['InspectRequest']['status_disp']; ?></td>
        <td><a href="/appli/info/<?php echo $item['InspectRequest']['user_id']; ?>" class="simple-link"><?php echo __('アプリ情報'); ?></a></td>
        <td><a href="/store/info/<?php echo $item['InspectRequest']['user_id']; ?>" class="simple-link"><?php echo __('ストア情報'); ?></a></td>
        <td><a href="/inspect/info/<?php echo $item['InspectRequest']['id']; ?>" class="simple-link"><?php echo __('更新'); ?></a></td>
      </tr>
<?php endforeach; ?>
    </tbody>
  </table>

  <div class="panel-footer txt_c">
    <?php echo $this->Paginator->prev(__('< 前へ'), array(), null, array('class' => 'prev disabled'));?>
    <?php echo $this->Paginator->numbers(array('class' => 'paginate', 'currentClass'=>'active'));?>
    <?php echo $this->Paginator->next(__('次へ >'), array(), null, array('class' => 'next disabled'));?>
  </div>

</div>

<script type="text/javascript">
function searchStatus() {
  var status = $('#InspectRequestStatus').val();
  console.log(status);
  window.location.href = '/inspect/list/' + status;
};
</script>
