<!-- ▼ HTML 入力フォーム -->
<div class="frame_main_box" id="webInfo">
  <!-- div id="swiffycontainer" style="width: 100%; height: 250px; vertical-align: top;"></div>
  <div class="c"></div -->

  <header class="panel-heading panel-title"><?php echo __('HTMLの編集'); ?></header>
  <div class="form_top"></div>

  <div ng-controller="webInfoController">
    <?php echo $this->Form->create(false, array('id' => 'registHtml', 'url' => array('controller' => 'ajax', 'action' => 'regist'), 'novalidate' => true)); ?>
      <p><font color="#0000ff" class="ml_30"><?php echo __('HTML 入力エリア'); ?></font></p>
      <?php echo $this->Form->input('WebHtml.html', array('type' => 'textarea', 'div' => false, 'label' => false, 'error' => false, 'class' => '', 'ng-model' => 'webInfo.htmltext')); ?>

      <div class="btn_center">
        <button type="button" class="btn btn-warning btn-sm" ng-click="registHtml('#registHtml');"><i class="fa fa-plus mg-r-xs"></i><?php echo __('更新'); ?></button>
      </div>
    <?php echo $this->Form->end(); ?>

    <hr />

    <div id="disp_web_image">
      <div class="form-group center_box">
        <div class="button_box">
          <button class="btn btn-warning btn-sm mt_10" onClick="toggleForm('web_image')"><i class="fa fa-plus mg-r-xs"></i><?php echo __('画像を選択'); ?></button>
        </div>
      </div>
      <div class="c10"></div>
    </div>

    <div id="form_web_image" style="display: none;">
      <div class="form-group">
        <label id="" class="form-label no-hand ml_70">
          <img ng-src="" alt="<?php echo __('画像'); ?>" class="avatar avatar-sm2 path-img-block-imglist wau ImageViewer" />
        </label>
        <div class="form_hr"></div>
      </div>
      <?php echo $this->Form->create(false, array('type' => 'file', 'id' => 'registWebImage', 'url' => array('controller' => 'ajax', 'action' => 'regist'), 'novalidate' => true)); ?>
        <div class="form-group">
          <label for="upload" class="form-label"><?php echo __('画像の選択'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
          <?php echo $this->Form->file('WebImage.image', array('id' => 'ImageSelector', 'div' => false, 'label' => false, 'error' => false, 'class' => 'wau pt_10')); ?>
          <p class="form-help"><?php echo __('ファイルサイズ：3MBまで<br />htmlに表示させる画像を登録してください。'); ?></p>
        </div>
      <?php echo $this->Form->end(); ?>
      <div class="btn_center">
        <span id="imgfilename"></span>
        <button type="button" class="btn btn-default btn-sm" onClick="toggleForm('web_image')"><i class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る'); ?></button>
        <button type="button" class="btn btn-warning btn-sm" ng-click="registWebImage('#registWebImage');"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録'); ?></button>
      </div>
    </div>

    <p><font color="#0000ff" class="ml_30"><?php echo __('画像リスト'); ?></font></p>
    <span ng-hide="webInfo.image_list"><font color="#ff0000" class="ml_30"><?php echo __('画像が登録されていません。'); ?></font></span>
    <span ng-show="webInfo.image_list"><font color="#ff0000" class="ml_30"><?php echo __('画像の&nbsp;img&nbsp;タグをコピー＆ペーストしてご利用ください。'); ?></font></span>
    <ul class="img-thum-list ml_30" ng-show="webInfo.image_list">
      <li id="image-list-{{image.id}}" class="clearfix" ng-repeat="image in webInfo.image_list">
        <div class="fl">
          <img ng-src="/media/image/{{image.file_name}}/"alt="" class="img-thum" style="height: 100px; width: 133px;"/>
          &lt;img src="./img/{{image.file_name}}.png" /&gt;
        </div>
        <div class="del-button fr">
          <?php echo $this->Form->create(false, array("id" => 'deleteWebImage-{{$index}}', 'url' => array('controller' => 'ajax', 'action' => 'delete'), 'novalidate' => true)); ?>
            <?php echo $this->Form->input("WebImage.image", array("type" => "hidden", "div" => false, "label" => false, "error" => false, "class" => "", "ng-model" => "image.id")); ?>
            <button type="button" class="btn btn-danger btn-sm" ng-click="deleteWebImage(this)"><i class="fa fa-trash-o mg-l-xs"></i>&nbsp;<?php echo __('削除'); ?></button>
          <?php echo $this->Form->end(); ?>
        </div>
      </li>
    </ul>

    <br /><br /><br />

    <header class="panel-heading panel-title"><?php echo __('CSSの編集'); ?></header>
    <div class="form_top"></div>

    <div>
      <?php echo $this->Form->create(false, array('id' => 'registCss', 'url' => array('controller' => 'ajax', 'action' => 'regist'), 'novalidate' => true)); ?>
        <p class="ml_30">
          <font color="#20b2aa"><?php echo __('CSS 入力エリア'); ?></font><br />
          <?php echo __('CSS へのリンクタグは下記のものになります。'); ?><br />
          <br />
          &lt;link rel="stylesheet" type="text/css" href="css/style.css" media="all" /&gt;
        </p>
        <?php echo $this->Form->input("WebCss.css", array("type" => "textarea", "div" => false, "label" => false, "error" => false, "class" => "", "ng-model" => "webInfo.csstext")); ?>

        <hr />

        <div class="btn_center">
          <button type="button" class="btn btn-warning btn-sm" ng-click="registCss('#registCss');"><i class="fa fa-plus mg-r-xs"></i><?php echo __('更新'); ?></button>
        </div>
      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</div>

<?php echo $this->Html->scriptStart(array('inline' => false)) ?>
$(document).ready(function() {
    moduleBase.controller('webInfoController', ['$scope', 'AjaxUrlAccess', function($scope, AjaxUrlAccess) {
        $scope.webInfo = <?php echo $webInfo; ?>;
        if ($scope.webInfo.html == '') {
            $scope.webInfo.htmltext = '';
        } else {
            // resultObject = AjaxUrlAccess.getJsonInfo('/media/' + $scope.webInfo.html + '/');
        }
        if ($scope.webInfo.css == '') {
            $scope.webInfo.csstext = '';
        } else {
            // resultObject = AjaxUrlAccess.getJsonInfo('/media/' + $scope.webInfo.html + '/');
        }

        $scope.registHtml = function(id) {
            if (window.confirm('<?php echo __('HTMLを登録します。よろしいですか'); ?>')) {
                resultObject = AjaxUrlAccess.postData(id);
                $scope.validate = resultObject.error;
            }
        }

        $scope.registWebImage = function(id) {
            if (window.confirm('<?php echo __('画像を登録します。よろしいですか'); ?>')) {
                resultObject = AjaxUrlAccess.postData(id);
                $scope.validate = resultObject.error;
            }
        }

        $scope.deleteWebImage = function(id) {
            if (window.confirm('<?php echo __('画像を削除します。よろしいですか'); ?>')) {
                resultObject = AjaxUrlAccess.postData(id);
                $scope.validate = resultObject.error;
            }
        }

        $scope.registCss = function(id) {
            if (window.confirm('<?php echo __('CSSを登録します。よろしいですか'); ?>')) {
                resultObject = AjaxUrlAccess.postData(id);
                $scope.validate = resultObject.error;
            }
        }
    }]);
    angular.bootstrap($('#webInfo'), ['moduleBase']);
});
<?php echo $this->Html->scriptEnd(); ?>
