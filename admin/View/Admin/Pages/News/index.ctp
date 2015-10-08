 <div class="frame_main_box box_kage">
  <div class="c"></div>
  <header class="panel-heading panel-title"><?php echo __('ニュースの新規登録'); ?></header>
  <div class="form_top"></div>

  <p class="form-help gml_184"><?php echo __('ニュースの新規登録になります'); ?><br><?php echo __('アプリへの表示・プッシュ通知の送信は致しませんので、ご注意下さい。'); ?></p>

  <div class="btn_center" id="news_result_new">
    <?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>ニュースの新規作成'), "javascript:toggleForm('news', 'new');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
  </div>

  <!-- 入力フォーム -->
  <div id="news_form_new" style="display: none;">
    <?php echo $this->Form->create(false, array('type' => 'file', 'action' => 'regist', 'novalidate' => true, 'id' => 'new', 'class' => 'newinfo')); ?>

      <hr>
      <p class="ta_c f_d"><?php echo __('画像、もしくはYoutube動画を任意で登録することが出来ます。'); ?></p>

      <div class="regist_button_box clearfix">
        <input type="button" value="<?php echo __('どちらも利用しない');?>" onclick="toggleLinkTypeForm(0, 'new')" class="btn btn-default btn-sm mr_5">
        <input type="button" value="<?php echo __('画像を登録する');?>" onclick="toggleLinkTypeForm(1, 'new')" class="btn btn-default btn-sm mr_5">
        <input type="button" value="<?php echo __('Youtube動画を登録する');?>" onclick="toggleLinkTypeForm(3, 'new')" class="btn btn-default btn-sm wau">
      </div>

      <div id="image_ext_1_new" style="display:none;">
        <hr>
        <div class="form-group">
          <label id="prev" class="form-label no-hand ml_70">
            <?php
              echo $this->Html->image("/img/common/noimage/noimage_menu_news.png", array('class' => 'avatar avatar-sm2', 'id' => 'ImageViewer_new'));
              ?>
          </label>
          <div class="form_hr"></div>
        </div>

        <div class="form-group">
          <label for="upload" class="form-label"><?php echo __('画像の選択'); ?>
            <span class="nin"><?php echo __('任意'); ?></span>
          </label>
          <?php echo $this->Form->file("image", array('class' => 'wau pt_10 ImageSelect', 'label' => false, 'pos' => 'new')); ?>
          <p class="form-help fml_184"><?php echo __('ファイルサイズ：3MBまで');?><br><?php echo __('横幅&nbsp;640px&nbsp;以上の大きさを推奨'); ?><br><?php echo __('高さの指定はありません。'); ?></p>
          <div class="form_hr"></div>
        </div>
      </div>

      <div id="image_ext_3_new" style="display:none;">
        <hr>
        <div class="form-group">
          <label for="form_youtube" class="form-label"><?php echo __('Youtube'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
          <?php echo $this->Form->input("youtube", array('class' => 'form-txt form-5', 'type' => 'text', 'label' => false, 'placeholder' => 'https://www.youtube.com/ XXXXX')); ?>
          <p class="form-help fml_184"><?php echo __('対象のYoutubeのURLをコピー＆貼り付けをしてください。');?></p>
          <div class="form_hr"></div>
        </div>
      </div>

    <hr>

    <div class="form-group">
      <label for="form_title" class="form-label"><?php echo __('タイトル'); ?><span class="hisu"><?php echo __('必須'); ?></span></label>

      <?php echo $this->Form->input("title", array('class' => 'form-txt form-5', 'type' => 'text', 'label' => false, 'placeholder' => __('タイトル'), 'data-rule-required'=>"true", 'data-msg-required' => __("タイトルの選択が必要になります。"))); ?>

      <p class="form-help fml_184"><?php echo __('文字数：全角20文字以内を推奨'); ?></p>
      <div class="form_hr"></div>
    </div>

    <div class="form-group">
      <label for="form_body" class="form-label"><?php echo __('本文'); ?><span class="hisu"><?php echo __('必須'); ?></span></label>
      <?php echo $this->Form->textarea("body", array('class' => 'form-txt form-textarea', 'type' => 'textarea', 'label' => false, 'data-rule-required'=>"true", 'data-msg-required' => __("本文の選択が必要になります。"))); ?>
      <div class="form_hr"></div>
    </div>
    <hr>

    <div class="form-group">
      <label for="form_notice" class="form-label"><?php echo __('PUSH通知'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
      <div class="checkbox_box">
        <?php echo $this->Form->input("notice", array('type' => 'radio', 'options' => Configure::read('news_push'), 'value' => 1, 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;')); ?>
      </div>
      <p class="form-help fml_184"><?php echo __('ニュースを配信した時に、お客様に通知するかどうかを選べます。'); ?></p>
      <div class="form_hr"></div>
    </div>
    <hr>

    <div class="form-group">
          <label for="form_notice_display" class="form-label"><?php echo __('配信日時'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
          <div class="checkbox_box">
            <?php echo $this->Form->input("notice_flg", array('type' => 'radio', 'options' => Configure::read('news_push'), 'value' => 0, 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;')); ?>
          </div>
          <p class="form-help fml_184"></p>
          <div class="form_hr"></div>
        </div>

        <div class="form-group notice_date_display">
          <label for="form_body" class="form-label">&nbsp;</label>
          <span>
            <?php echo $this->Form->input("notice_date", array('class' => 'form-txt form-2 calendar', 'type' => 'text', 'label' => false, 'placeholder' => __('日時を選択'))); ?>
          </span>
          <div class="select_custom">
            <?php echo $this->Form->input("notice_hour", array('type' => 'select', 'options' => $time['hour'], 'label' => false, 'div' => false, 'class' => 'form-select'));?>
            <?php echo $this->Form->input("notice_minute", array('type' => 'select', 'options' => $time['min'], 'label' => false, 'div' => false, 'class' => 'form-select'));?>
          </div>
          <p class="form-help fml_184">
            <?php echo __('配信希望日が指定できます。'); ?><br>
            <?php echo __('配信されたニュースの日時変更は出来ません。'); ?><br>
            <?php echo __('未設定の場合は、手動配信での設定になります。'); ?><br>
            <?php echo __('指定できる時間は、10分後からになっています。'); ?>
          </p>
          <div class="form_hr"></div>
        </div>
    <hr>

    <div class="button_box">
      <?php echo $this->Html->link(__('<i class="fa fa-mail-reply mg-r-xs"></i>戻る'), "javascript:toggleForm('news', 'new');", array('escape' => false, 'class' => 'btn btn-default btn-sm')); ?>
      <?php echo $this->Html->link(__('<i class="fa fa-plus mg-r-xs"></i>登録'), "javascript:postData('new');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
    </div>
  </div>

  <div class="frame_bottom_box">
    <div class="padding10"></div>
  </div>
  <?php echo $this->Form->end(); ?>

</div>

<div role="alert">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h4><?php echo __('ニュース一覧'); ?></h4>
  </div>

  <ul class="list-group">

    <?php foreach($dataInfoList as $key => $dataInfo) { ?>
    <li class="list-group-item clearfix">
      <div id="news_result_<?php echo $dataInfo['News']['id']; ?>">
        <span class="pull-left mg-t-xs mg-r-md">
          <?php
            if(!empty($dataInfo['News']['image']) && $dataInfo['News']['image'] != '') {
              echo $this->Html->image("/media/image/{$dataInfo['News']['image']}", array('class' => 'avatar avatar-sm2'));
            } else {
              echo $this->Html->image("/img/common/noimage/noimage_menu_news.png", array('class' => 'avatar avatar-sm2'));
            }
          ?>
        </span>

        <div class="show no-margin pd-t-xs">
          <?php echo $dataInfo['News']['title']; ?>
          <small class="pull-right"><?php echo __('登録日時:'); ?>&nbsp;<?php echo $dataInfo['News']['created']; ?></small>
        </div>

        <small class="text-muted"><div class="mt_5"><?php echo $dataInfo['News']['body']; ?></div>&nbsp;
          <?php if ($dataInfo['News']['notice'] != '0') { ?>
            <span class="badge bg-danger"><i class="fa fa-volume-up mg-r-xs"></i><?php echo __('プッシュ通知')?></span>
          <?php } ?>
          <?php if ($this->request->data[$dataInfo['News']['id']]['notice_flg'] != 0) { ?>
           <span class="badge bg-info"><i class="fa fa-clock-o mg-r-xs"></i><?php echo __('予約配信指定')?></span>
          <?php } ?>
        </small>

        <div class="pull-right pt_10">
          <?php echo $this->Html->link(__('<i class="fa fa-edit mg-r-xs"></i>変更'), "javascript:toggleForm('news', '{$dataInfo['News']['id']}');", array('escape' => false, 'class' => 'btn btn-danger btn-sm')); ?>
          <a class="btn btn-danger btn-sm" onclick="if (confirm('<?php echo __("本当に削除してもよろしいですか？")?>')) { document.location.href='/news/delete?id=<?php echo $dataInfo['News']['id']?>'; } event.returnValue = false; return false;" href="#"><?php echo __('<i class="fa fa-trash-o mg-l-xs"></i>削除')?></a>
          <?php //echo $this->Html->link(__('<i class="fa fa-trash-o mg-l-xs"></i>削除'), '', array('escape' => false, 'class' => 'btn btn-danger btn-sm', 'onclick' => 'if (confirm("'.__("本当に削除してもよろしいですか？").'")) { document.location.href="/news/delete?id='.$dataInfo['News']['id'].'"; } event.returnValue = false; return false;')); ?>
        </div>
      </div>

      <!-- 変更 -->
      <div class="contents_form" id="news_form_<?php echo $dataInfo['News']['id']; ?>" style="display: none;">
        <?php echo $this->Form->create(false, array('type' => 'file', 'action' => 'regist', 'novalidate' => true, 'id' => $dataInfo['News']['id'], 'class' => 'newinfo newinfo_edit new_edit_'.$dataInfo['News']['id'])); ?>
          <?php echo $this->Form->input('id' , array('type' => 'hidden', 'value' => $dataInfo['News']['id'])); ?>

          <div class="form-group">
            <label class="form-label no-hand ml_70">
              <?php
                if(!empty($dataInfo['News']['image']) && $dataInfo['News']['image'] != '') {
                  echo $this->Html->image("/media/image/{$dataInfo['News']['image']}", array('class' => 'path-img-block-imglist', 'id' => 'ImageViewer_' . $dataInfo['News']['id']));
                } else {
                  echo $this->Html->image("/img/common/noimage/noimage_menu_news.png", array('class' => 'path-img-block-imglist', 'id' => 'ImageViewer_' . $dataInfo['News']['id']));
                }
              ?>
              <?php echo $this->Form->input('old_image_id', array('type' => 'hidden', 'value' => $dataInfo['News']['image'])) ?>
            </label>
            <div class="form_hr"></div>
          </div>

          <div class="form-group">
            <label for="upload" class="form-label"><?php echo __('画像の選択'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
            <?php echo $this->Form->file("image", array('class' => 'wau pt_10 ImageSelect', 'label' => false, 'pos' => $dataInfo['News']['id'])); ?>
            <p class="form-help fml_184">
              <?php echo __('ファイルサイズ：3MBまで'); ?><br><?php echo __('横幅&nbsp;640px&nbsp;以上の大きさを推奨');?><br><?php echo __('高さの指定はありません。'); ?>
            </p>
            <div class="form_hr"></div>
        </div>
         <hr>
        <div class="form-group">
          <label for="form_youtube" class="form-label">Youtube<span class="nin"><?php echo __('任意'); ?></span></label>
          <?php echo $this->Form->input("{$dataInfo['News']['id']}.youtube", array('class' => 'form-txt form-5', 'type' => 'text', 'label' => false, 'placeholder' => 'https://www.youtube.com/ XXXXX')); ?>
          <p class="form-help"></p>
          <p class="form-help fml_184"><?php echo __('対象のYoutubeのURLをコピー＆貼り付けをしてください。'); ?></p>
          <div class="form_hr"></div>
        </div>

        <hr>

        <div class="form-group">
          <label for="form_title" class="form-label"><?php echo __('タイトル'); ?><span class="hisu"><?php echo __('必須'); ?></span></label>
          <?php echo $this->Form->input("{$dataInfo['News']['id']}.title", array('class' => 'form-txt form-5', 'type' => 'text', 'label' => false, 'placeholder' => __('タイトル'), 'data-rule-required'=>"true", 'data-msg-required' => __("タイトルの選択が必要になります。"))); ?>
          <p class="form-help fml_184"><?php echo __('文字数：全角20文字以内を推奨'); ?></p>
          <div class="form_hr"></div>
        </div>

        <div class="form-group">
          <label for="form_body" class="form-label"><?php echo __('本文'); ?><span class="hisu"><?php echo __('必須'); ?></span></label>
          <?php echo $this->Form->textarea("{$dataInfo['News']['id']}.body", array('class' => 'form-txt form-textarea', 'type' => 'textarea', 'label' => false, 'data-rule-required'=>"true", 'data-msg-required' => __("本文の選択が必要になります。"))); ?>
          <div class="form_hr"></div>
        </div>

        <hr>

        <div class="form-group">
          <label for="form_notice" class="form-label"><?php echo __('PUSH通知'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
          <div class="checkbox_box">
            <?php echo $this->Form->input("{$dataInfo['News']['id']}.notice", array('type' => 'radio', 'options' => Configure::read('news_push'), 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;')); ?>
          </div>
          <p class="form-help fml_184"><?php echo __('ニュースを配信した時に、お客様に通知するかどうかを選べます。'); ?></p>
          <div class="form_hr"></div>
        </div>

        <hr>

        <div class="form-group">
          <label for="form_notice_display" class="form-label"><?php echo __('配信日時'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
          <div class="checkbox_box">
            <?php echo $this->Form->input("{$dataInfo['News']['id']}.notice_flg", array('type' => 'radio', 'options' => Configure::read('news_push'), 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;')); ?>
          </div>
          <p class="form-help fml_184"></p>
          <div class="form_hr"></div>
        </div>

        <div class="form-group notice_date_display">
          <label for="form_body" class="form-label">&nbsp;</label>
          <span>
            <?php echo $this->Form->input("{$dataInfo['News']['id']}.notice_date", array('class' => 'form-txt form-2 calendar', 'type' => 'text', 'label' => false, 'placeholder' => __('日時を選択'))); ?>
          </span>
          <div class="select_custom">
            <?php echo $this->Form->input("{$dataInfo['News']['id']}.notice_hour", array('type' => 'select', 'options' => $time['hour'], 'label' => false, 'div' => false, 'class' => 'form-select'));?>
            <?php echo $this->Form->input("{$dataInfo['News']['id']}.notice_minute", array('type' => 'select', 'options' => $time['min'], 'label' => false, 'div' => false, 'class' => 'form-select'));?>
          </div>
          <p class="form-help fml_184">
            <?php echo __('配信希望日が指定できます。'); ?><br>
            <?php echo __('配信されたニュースの日時変更は出来ません。'); ?><br>
            <?php echo __('未設定の場合は、手動配信での設定になります。'); ?><br>
            <?php echo __('指定できる時間は、10分後からになっています。'); ?>
          </p>
          <div class="form_hr"></div>
        </div>
        <hr>

        <div class="btn_center">
          <?php echo $this->Html->link(__('<i class="fa fa-mail-reply mg-r-xs"></i>戻る'), "javascript:toggleForm('news', '{$dataInfo['News']['id']}');", array('escape' => false, 'class' => 'btn btn-default btn-sm')); ?>
          <?php echo $this->Html->link(__('<i class="fa fa-edit mg-r-xs"></i>変更'), "javascript:postData('{$dataInfo['News']['id']}');", array('escape' => false, 'class' => 'btn btn-warning btn-sm')); ?>
        </div>
      <?php echo $this->Form->end(); ?>
      </div>
    </li>
    <?php } ?>

  </ul>
</div>


<div class="pagination">
  <?php echo $this->Paginator->prev(__('«'), array('tag' => 'span'), null, array('tag' => 'span','class' => '','disabledTag' => 'a')); ?>
  <?php echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => '','tag' => 'span','first' => 1)); ?>
  <?php echo $this->Paginator->next(__('»'), array('tag' => 'span','currentClass' => ''), null, array('tag' => 'span','class' => '','disabledTag' => 'a')); ?>
</div>
<!-- <div class="pagination">
  <?php echo $this->Paginator->prev(__('«'), array('tag' => 'li'), null, array('tag' => 'li','class' => '','disabledTag' => 'a')); ?>
  <?php echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => '','tag' => 'li','first' => 1)); ?>
  <?php echo $this->Paginator->next(__('»'), array('tag' => 'li','currentClass' => ''), null, array('tag' => 'li','class' => '','disabledTag' => 'a')); ?>
</div> -->



<?php echo $this->Html->scriptStart(array('inline' => false)) ?>

  $(document).ready(function(){
    // DatePickerの初期化
    $(".calendar").datepicker({dateFormat:'yy-mm-dd'});

    $("#new").validate({
		messages: {
		}
	});
	<?php foreach($dataInfoList as $key => $dataInfo) { ?>
		$(".new_edit_<?php echo $dataInfo['News']['id'];?>").validate({
			messages: {
			}
		});
	<?php }?>
  });

  function toggleLinkTypeForm(targetForm, id) {

    formName = ['0', '1', '3']; //0 なし 1 画像 3 YOUTUBE

    for(i=0; i< formName.length; i++) {
      if (targetForm == 0) {

        $('#image_ext_1_' + id).hide();
        $('#image_ext_3_' + id).hide();

      } else if (targetForm == formName[i]) {

        $('#image_ext_' + formName[i] + '_' + id).show();

      } else {

        $('#image_ext_' + formName[i] + '_' + id).hide();

      }
    }
  }

  function postData(id) {
    console.log("submit id => "+id);
    $('#' + id).submit();
  }

  function toggleForm(target, id) {
    $('#' + target + '_result_' + id).toggle();
    $('#' + target + '_form_' + id).toggle();
  }


$(function () {
  $('.ImageSelect').on('change', function() {
    if (! this.files.length) {
      return;
    }

    var file = this.files[0];
    if (! file.type.match('image.*')) {
      alert('<?php echo __('画像を選択してください'); ?>');
      return;
    }

    if (! file.size > (3 * 1024 * 1024)) {
      alert('<?php echo __('サイズが大きすぎます'); ?>');
      return;
    }

    pos = $(this).attr('pos');
    var reader = new FileReader();
    reader.onload = (function(theFile) {
      return function(e) {
        $('#ImageViewer_' + pos).each(function() {
          $(this).attr('src', e.target.result);
        });
      };
    })(file);

    reader.readAsDataURL(file);
  });
});
<?php echo $this->Html->scriptEnd(); ?>