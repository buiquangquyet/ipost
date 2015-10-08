<style type="text/css">
textarea{
  height: 20em!important;
}
</style>

<div class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('アカウント一覧'); ?></div>
  <h2><i class="fa fa-file-text">&nbsp;</i><?php echo __('審査申請アプリ'); ?><span>｜<?php echo __('申請リスト'); ?></span></h2>

  <?php echo $this->Session->flash(); ?>

  <h3><?php echo __('申請状態'); ?></h3>
  <fieldset>
    <table>
      <tr>
        <td class="subject"><?php echo __('クライアントID'); ?></td>
        <td><a href="/client/info/<?php echo $userInfo['User']['id']; ?>" class="simple-link"><?php echo $userInfo['User']['id']; ?></a></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('クライアント名'); ?></td>
        <td><a href="/client/info/<?php echo $userInfo['User']['id']; ?>" class="simple-link"><?php echo $userInfo['User']['user_name']; ?></a></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('受付日時'); ?></td>
        <td><?php echo $requestInfo['InspectRequest']['created']; ?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('経過時間'); ?></td>
        <td><?php echo $elapsed_time; ?></td>
      </tr>
      <tr>
        <td class="subject"><?php echo __('状態'); ?></td>
        <td><?php echo $requestInfo['InspectRequest']['status']; ?></td>
      </tr>
    </table>
  </fieldset>

  <h3>簡易審査</h3>
  <fieldset>
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Form->create('Reject', array('url' => array('controller' => 'inspect', 'action' => 'info', $requestInfo['InspectRequest']['id']))); ?>
      <table>
        <tr>
          <td class="subject"><?php echo __('リジェクト理由'); ?></td>
          <td><?php echo $this->Form->input('Reject.type', array('type' => 'select', 'options' => Configure::read('InspectRejectType'), 'label' => false, 'div' => false, 'class' => 'form-select'));?></td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('リジェクトタイトル'); ?></td>
          <td><?php echo $this->Form->input('Reject.title', array('type' => 'text', 'div' => false, 'label' => false, 'class'=>'form-txt form-5', 'placeholder' => __('リジェクトタイトル')));?></td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('リジェクトコメント'); ?></td>
          <td><?php echo $this->Form->input('Reject.body', array('type' => 'textarea', 'div' => false, 'label' => false, 'placeholder' => __('リジェクトコメント')));?></td>
        </tr>
        <tr>
          <td class="subject"><?php echo __('テンプレート言語'); ?></td>
          <td>
            <?php echo $this->Form->input('Reject.lang
            ', array('type' => 'select', 'options' => $langOptions, 'label' => false, 'div' => false, 'class' => 'form-select mt_10 mb_0'));?>
            <p class="help-block">送信されるメールの内容言語を選択できます。<br>選択されない場合は、日本語のテンプレートで送信されます。</p>
          </td>
        </tr>
        <tr>
          <td colspan="2"><input type="submit" class="btn btn_red" value="<?php echo __('リジェクト'); ?>" /></td>
        </tr>
      </table>
    <?php echo $this->Form->end();?>
    <hr>
    <table>
      <tr>
        <td colspan="2"><a href="/inspect/pass/<?php echo $requestInfo['InspectRequest']['id']; ?>" class="btn btn_green"><?php echo __('代理店審査通過'); ?></a></td>
      </tr>
    </table>
  </fieldset>
</div>


<!-- ▼ Script -->
<script type="text/javascript">
$(document).ready(function(){
  moduleBase.controller('shopInfoController', ['$scope', 'AjaxUrlAccess', function($scope, AjaxUrlAccess) {
    $scope.shopInfo = <?php echo $shopInfo; ?>;
    $scope.registShopInfo = function(id) {
      if (window.confirm('<?php echo __('代理店情報を更新します。よろしいですか'); ?>')) {
        resultObject = AjaxUrlAccess.postData(id);
        $scope.validate = resultObject.error;
        $scope.shopInfo.process = resultObject.result;
      };
    };
  }]);
  angular.bootstrap($('#shopInfo'), ['moduleBase']);
});
</script>

<!-- ▲ Script -->
