<!-- ▼ メニュートップ画像の変更 -->
<div id="menu_top" class="frame_main_box box_kage">

  <!-- <div id="swiffycontainer" style="width: 100%; height: 250px; vertical-align: top;"></div> -->

  <header class="panel-heading panel-title"><?php echo __('メニュートップ画像の変更')?></header>
  <div class="form_top"></div>

  <div id="menu_top">

    <div class="form-group center_box">
      <label class="form-label no-hand p84">
        <span id="prev_top_image">
          <img src="./webroot/img/no_image_menu_head.jpg" class="img-block" alt="<?php echo __('メニュートップ画像')?>" />
        </span>
      </label>
      <div class="form_hr"></div>
    </div>

        <div class="button_box">
      <button type="button" class="btn btn-warning btn-sm mt_10" onclick="ajaxShowTopImageForm();"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録')?></button>
    </div>

    <div class="c10"></div>

  </div>

  <!-- ▼▼ 入力フォーム -->
  <div id="menu_top_form" style="display:none;">

    <form action="/rest/menu/top_image_upload.json" method="POST" name="form1" id="top_image_form" class="form1" enctype="multipart/form-data">

      <div class="form-group">
        <label id='prev_tmp_top_image' class="form-label no-hand ml_96">
          <img src="/assets/img/app/menu/top/600/1417609885.jpg?1422971751" class="avatar avatar-sm2" alt="<?php echo __('メニュートップ画像')?>" />
        </label>
        <div class="form_hr"></div>
      </div>

      <div class="form-group">
        <label for="upload" class="form-label"><?php echo __('画像の選択')?></label>
        <input type="file" name="upload" id="upload" class="wau pt_10" onchange="ajaxUploadTopImage();">
        <p class="form-help fml_184"><?php echo __('ファイルサイズ：3MBまで')?><br /><?php echo __('640px&nbsp;×&nbsp;350px&nbsp;以上の大きさを推奨')?></p>
      </div>

      <div class="form_hr"></div>

    </form>

    <hr />

    <div class="btn_center">
      <form action="/rest/menu/top_image_regist.json" method="POST" name="form1" id="top_form" class="form1">
        <a href="javascript:void(0);" class="btn btn-default btn-sm" onclick="ajaxHideTopImageForm();"><i class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る')?></a>
        <a href="javascript:void(0);" class="btn btn-warning btn-sm" onclick="ajaxRegistTopImage();"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録')?></a>
      </form>
    </div>

  </div>
  <!-- ▲▲ -->

  <div class="frame_bottom_box">
    <div class="padding10"></div>
  </div>

</div>
<!-- ▲ -->

<!-- ▼ 商品の新規登録 -->
<div class="frame_main_box box_kage">

  <header class="panel-heading panel-title"><?php echo __('商品の新規登録')?></header>
  <div class="form_top"></div>

    <div id='menu_item_new'>
    <div class="button_box">
      <a href="javascript:void(0);" class="btn btn-warning btn-sm" onclick="ajaxShowNewItemForm();"><i class="fa fa-plus mg-r-xs"></i><?php echo __('商品の新規登録')?></a>
    </div>
  </div>

  <!-- ▼▼ 入力フォーム -->
  <div id="menu_item_form_new" style="display:none;">

    <hr />

    <form action="/rest/menua/item_image_upload.json" method="POST" name="form1" id="item_top_new" class="form1" enctype="multipart/form-data">

      <span id='prev_new_item' class="form-label no-hand ml_70">
        <img src="/assets/img/common/noimage/noimage_menutop.png?1422971751" class="avatar avatar-sm2" alt="<?php echo __('メニュー商品追加画像')?>" />
      </span>

      <div class="form-group">
        <label for="upload" class="form-label"><?php echo __('画像の選択')?><span class="nin"><?php echo __('任意')?></span></label>
        <input type="file" name="upload" id="upload" class="wau pt_10" onchange="ajaxUploadNewItemImage();">
        <p class="form-help fml_184"><?php echo __('ファイルサイズ：3MBまで')?><br /><?php echo __('640px&nbsp;×&nbsp;350px&nbsp;以上の大きさを推奨')?></p>
        <div class="form_hr"></div>
      </div>

    </form>

    <hr />

    <form action="/rest/menua/item_save.json" method="POST" name="form1" id="item_top_form_new" class="form1" enctype="multipart/form-data">

      <input type="hidden" name="parent_id" value="0">

      <div class="form-group">
        <label for="form_title" class="form-label"><?php echo __('商品名')?><span class="hisu"><?php echo __('必須')?></span></label>
        <input type="text" class="form-txt form-6" placeholder="<?php echo __('商品名の入力')?>" required="required" id="form_title" name="title" value="" />
        <p class="form-help fml_184"><?php echo __('推奨文字数：約全角22文字')?></p>
        <div class="form_hr"></div>
      </div>

      <div class="form-group">
        <label for="form_price" class="form-label"><?php echo __('価格')?><span class="nin"><?php echo __('任意')?></span></label>
        <input type="text" class="form-txt form-6" placeholder="<?php echo __('価格の入力')?>" id="form_price" name="price" value="" />
        <p class="form-help fml_184"><?php echo __('未入力、または0を入力で商品価格の非表示がされます。')?></p>
        <div class="form_hr"></div>
      </div>

      <div class="form-group">
        <label for="form_sub_title" class="form-label"><?php echo __('一覧説明')?><span class="nin"><?php echo __('任意')?></span></label>
        <input type="text" class="form-txt form-6" placeholder="<?php echo __('一覧時の説明文を入力')?>" id="form_sub_title" name="sub_title" value="" />
        <p class="form-help fml_184"><?php echo __('商品一覧時に表示される補足説明になります。')?><br><?php echo __('推奨文字数：約全角22文字')?></p>
        <div class="form_hr"></div>
      </div>

      <div class="form-group">
        <label for="form_description" class="form-label"><?php echo __('商品説明')?><span class="hisu"><?php echo __('必須')?></span></label>
        <textarea class="form-description form-txt form-textarea" required="required" id="form_description" name="description"></textarea>
        <p class="form-help fml_184"><?php echo __('商品の詳細画面で表示される説明文になります。')?></p>
        <div class="form_hr"></div>
      </div>

      <div class="form-group">
        <label for="form_enable" class="form-label"><?php echo __('表示')?><span class="nin"><?php echo __('任意')?></span></label>
        <div class="checkbox_box">
          <span class="chec_txt"><?php echo __('表示しない')?></span>
          <input type="checkbox" value="1" name="enable" id="form_enable" class="js-switch-green bic" checked />
          <span class="chec_txt"><?php echo __('表示する')?></span>
        </div>
        <p class="form-help fml_184"><?php echo __('アプリに表示させるかどうかを選ぶことができます。')?></p>
        <div class="form_hr"></div>
      </div>

      <hr />

      <div class="btn_center">
        <a href="javascript:void(0);" class="btn btn-default btn-sm" onclick="ajaxHideNewItemForm();"><i class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る')?></a>
        <a href="javascript:void(0);" class="btn btn-warning btn-sm" onclick="ajaxRegistItem();"><i class="fa fa-plus mg-r-xs"></i><?php echo __('登録')?></a>
      </div>

    </form>

  </div>
  <!-- ▲▲ -->

  <div class="frame_bottom_box">
    <div class="padding10"></div>
  </div>

</div>
<!-- ▲ -->

<!-- ▼ メニュー一覧 -->
<div id="category_insert">
  <div class="frame_main_box box_kage content">

    <header class="panel-heading panel-title"><?php echo __('メニュー一覧')?></header>
    <div class="form_top"></div>

        <div id="item_box_476">
      <div class="cate_box" id="cate_box_476">

        <!-- ▼▼ メニュー内容表示 -->
        <div class="cate_list_top" id="menu_item_476">

          <div class="ctl_box">
            <div class="oya_img">
                            <img src="./webroot/img/noimage_menu.png" class="avatar avatar-sm2" alt="<?php echo __('メニュー商品画像')?>">
                          </div>
          </div>

          <div class="ctr_box">
            <h2>
              <i class="fa fa-circle c_gri"></i>&nbsp;
              <span id="item_title_476">temp1</span>
            </h2>
            <div class="cate_txt">
              <span id="item_sub_title_476"><?php echo __('商品一覧時に表示される補足説明になります。')?></span>
              <span class="ct_time sm_non fl_n"><i class="fa fa-clock-o"></i>&nbsp;<?php echo __('更新日時:2015/02/03 23:06')?></span>
              <div class="ct_button">

                                <div class="fr">


                                                      <a href="javascript:void(0);" class="btn btn-default btn-sm" onclick="ajaxMoveDownItem(1,476)"><i class="fa fa-chevron-down"></i><!-- ↓ --></a>


                  <a href="javascript:void(0);" class="btn btn-info btn-sm" onclick="ajaxShowUpdateItemForm(476);"><i class="fa fa-edit mg-r-xs"></i><?php echo __('変更')?></a>
                  <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="ajaxDeleteItem(476);"><i class="fa fa-trash-o mg-r-xs"></i><?php echo __('削除')?></a>
                  <span id="category_updown_476"></span>

                </div>

              </div>
            </div>
          </div>

        </div>
        <!-- ▲▲ -->

        <div class="clear"></div>

        <!-- ▼▼ メニュー内容変更 -->
        <div id="menu_item_update_form_476" style="display:none;">

          <hr>

          <form action="/rest/menua/item_image_upload.json" method="POST" name="form1" id="item_top_476" class="form1" enctype="multipart/form-data">

            <span id="prev_item_476" class="form-label no-hand ml_70">
                            <img src="/assets/img/common/noimage/noimage_menu_news.png?1422972432" class="avatar avatar-sm2" alt="<?php echo __('メニュー商品画像')?>">
                          </span>

            <div class="form-group">
              <label for="upload" class="form-label"><?php echo __('画像の選択')?><span class="nin"><?php echo __('任意')?></span></label>
              <input type="file" name="upload" id="upload" class="wau pt_10" onchange="ajaxUploadUpdateItemImage(476);">
              <p class="form-help fml_184"><?php echo __('ファイルサイズ：3MBまで')?><br><?php echo __('640px&nbsp;×&nbsp;350px&nbsp;以上の大きさを推奨')?></p>
              <div class="form_hr"></div>
            </div>

          </form>

          <hr>

          <form action="/rest/menua/item_save.json?i_id=476" method="POST" name="form1" id="item_update_form_476" class="form1" enctype="multipart/form-data">

            <input type="hidden" name="parent_id" value="0">

            <div class="form-group">
              <label for="form_title" class="form-label"><?php echo __('商品名')?><span class="hisu"><?php echo __('必須')?></span></label>
              <input type="text" class="form-txt form-6" placeholder="<?php echo __('商品名の入力')?>" required="required" id="form_title" name="title" value="">
              <p class="form-help fml_184"><?php echo __('推奨文字数：約全角22文字')?></p>
              <div class="form_hr"></div>
            </div>

            <div class="form-group">
              <label for="form_price" class="form-label"><?php echo __('価格')?><span class="nin"><?php echo __('任意')?></span></label>
              <input type="text" class="form-txt form-6" placeholder="<?php echo __('価格の入力')?>" id="form_price" name="price" value="">
              <p class="form-help fml_184"><?php echo __('未入力、または0を入力で商品価格の非表示がされます。')?></p>
              <div class="form_hr"></div>
            </div>

            <div class="form-group">
              <label for="form_sub_title" class="form-label"><?php echo __('一覧説明')?><span class="nin"><?php echo __('任意')?></span></label>
              <input type="text" class="form-txt form-6" placeholder="<?php echo __('一覧時の説明文を入力')?>" id="form_sub_title" name="sub_title" value="">
              <p class="form-help fml_184"><?php echo __('商品一覧時に表示される補足説明になります。')?><br><?php echo __('推奨文字数：約全角22文字')?></p>
              <div class="form_hr"></div>
            </div>

            <div class="form-group">
              <label for="form_description" class="form-label"><?php echo __('商品説明')?><span class="hisu"><?php echo __('必須')?></span></label>
              <textarea class="form-description form-txt form-textarea" required="required" id="form_description" name="description"></textarea>
              <p class="form-help fml_184"><?php echo __('商品の詳細画面で表示される説明文になります。')?></p>
              <div class="form_hr"></div>
            </div>

            <div class="form-group">
              <label for="form_enable" class="form-label"><?php echo __('表示')?><span class="nin"><?php echo __('任意')?></span></label>
              <div class="checkbox_box">
                <span class="chec_txt"><?php echo __('表示しない')?></span>
                                <input type="checkbox" value="1" name="enable" id="form_enable" class="js-switch-green bic " checked="" data-switchery="true" style="display: none;"><span class="switchery" id="form_enable" name="enable" style="border-color: rgb(45, 203, 115); box-shadow: rgb(45, 203, 115) 0px 0px 0px 16px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s; -webkit-transition: border 0.4s, box-shadow 0.4s, background-color 1.2s; background-color: rgb(45, 203, 115);"><small style="left: 22px; transition: left 0.2s; -webkit-transition: left 0.2s;"></small></span>
                                <span class="chec_txt"><?php echo __('表示する')?></span>
              </div>
              <p class="form-help fml_184"><?php echo __('アプリに表示させるかどうかを選ぶことができます。')?></p>
              <div class="form_hr"></div>
            </div>

            <hr>

            <div class="btn_center">
              <a href="javascript:void(0);" class="btn btn-default btn-sm" onclick="ajaxHideUpdateItemForm(476);"><i class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る')?></a>
              <a href="javascript:void(0);" class="btn btn-info btn-sm" onclick="ajaxUpdateItem(476);"><i class="fa fa-edit mg-r-xs"></i><?php echo __('変更')?></a>
            </div>

            <hr>

          </form>

        </div>
        <!-- ▲▲ -->

      </div>
    </div>
        <div id="item_box_477">
      <div class="cate_box" id="cate_box_477">

        <!-- ▼▼ メニュー内容表示 -->
        <div class="cate_list_top" id="menu_item_477">

          <div class="ctl_box">
            <div class="oya_img">
                            <img src="./webroot/img/noimage_menu.png" class="avatar avatar-sm2" alt="<?php echo __('メニュー商品画像')?>">
                          </div>
          </div>

          <div class="ctr_box">
            <h2>
              <i class="fa fa-circle c_gri"></i>&nbsp;
              <span id="item_title_477">temp2</span>
            </h2>
            <div class="cate_txt">
              <span id="item_sub_title_477"></span>
              <span class="ct_time sm_non fl_n"><i class="fa fa-clock-o"></i>&nbsp;<?php echo __('更新日時:2015/02/03 23:07')?></span>
              <div class="ct_button">

                                <div class="fr">


                                    <a href="javascript:void(0);" class="btn btn-default btn-sm" onclick="ajaxMoveUpItem(2,477)"><i class="fa fa-chevron-up"></i><!-- ↑ --></a>


                  <a href="javascript:void(0);" class="btn btn-info btn-sm" onclick="ajaxShowUpdateItemForm(477);"><i class="fa fa-edit mg-r-xs"></i><?php echo __('変更')?></a>
                  <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="ajaxDeleteItem(477);"><i class="fa fa-trash-o mg-r-xs"></i><?php echo __('削除')?></a>
                  <span id="category_updown_477"></span>

                </div>

              </div>
            </div>
          </div>

        </div>
        <!-- ▲▲ -->

        <div class="clear"></div>

        <!-- ▼▼ メニュー内容変更 -->
        <div id="menu_item_update_form_477" style="display:none;">

          <hr>

          <form action="/rest/menua/item_image_upload.json" method="POST" name="form1" id="item_top_477" class="form1" enctype="multipart/form-data">

            <span id="prev_item_477" class="form-label no-hand ml_70">
                            <img src="/assets/img/common/noimage/noimage_menu_news.png?1422972432" class="avatar avatar-sm2" alt="<?php echo __('メニュー商品画像')?>">
                          </span>

            <div class="form-group">
              <label for="upload" class="form-label"><?php echo __('画像の選択')?><span class="nin"><?php echo __('任意')?></span></label>
              <input type="file" name="upload" id="upload" class="wau pt_10" onchange="ajaxUploadUpdateItemImage(477);">
              <p class="form-help fml_184"><?php echo __('ファイルサイズ：3MBまで')?><br><?php echo __('640px&nbsp;×&nbsp;350px&nbsp;以上の大きさを推奨')?></p>
              <div class="form_hr"></div>
            </div>

          </form>

          <hr>

          <form action="/rest/menua/item_save.json?i_id=477" method="POST" name="form1" id="item_update_form_477" class="form1" enctype="multipart/form-data">

            <input type="hidden" name="parent_id" value="0">

            <div class="form-group">
              <label for="form_title" class="form-label"><?php echo __('商品名')?><span class="hisu"><?php echo __('必須')?></span></label>
              <input type="text" class="form-txt form-6" placeholder="<?php echo __('商品名の入力')?>" required="required" id="form_title" name="title" value="">
              <p class="form-help fml_184"><?php echo __('推奨文字数：約全角22文字')?></p>
              <div class="form_hr"></div>
            </div>

            <div class="form-group">
              <label for="form_price" class="form-label"><?php echo __('価格')?><span class="nin"><?php echo __('任意')?></span></label>
              <input type="text" class="form-txt form-6" placeholder="<?php echo __('価格の入力')?>" id="form_price" name="price" value="">
              <p class="form-help fml_184"><?php echo __('未入力、または0を入力で商品価格の非表示がされます。')?></p>
              <div class="form_hr"></div>
            </div>

            <div class="form-group">
              <label for="form_sub_title" class="form-label"><?php echo __('一覧説明')?><span class="nin"><?php echo __('任意')?></span></label>
              <input type="text" class="form-txt form-6" placeholder="<?php echo __('一覧時の説明文を入力')?>" id="form_sub_title" name="sub_title" value="">
              <p class="form-help fml_184"><?php echo __('商品一覧時に表示される補足説明になります。')?><br><?php echo __('推奨文字数：約全角22文字')?></p>
              <div class="form_hr"></div>
            </div>

            <div class="form-group">
              <label for="form_description" class="form-label"><?php echo __('商品説明')?><span class="hisu"><?php echo __('必須')?></span></label>
              <textarea class="form-description form-txt form-textarea" required="required" id="form_description" name="description"></textarea>
              <p class="form-help fml_184"><?php echo __('商品の詳細画面で表示される説明文になります。')?></p>
              <div class="form_hr"></div>
            </div>

            <div class="form-group">
              <label for="form_enable" class="form-label"><?php echo __('表示')?><span class="nin"><?php echo __('任意')?></span></label>
              <div class="checkbox_box">
                <span class="chec_txt"><?php echo __('表示しない')?></span>
                                <input type="checkbox" value="1" name="enable" id="form_enable" class="js-switch-green bic " checked="" data-switchery="true" style="display: none;"><span class="switchery" id="form_enable" name="enable" style="border-color: rgb(45, 203, 115); box-shadow: rgb(45, 203, 115) 0px 0px 0px 16px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s; -webkit-transition: border 0.4s, box-shadow 0.4s, background-color 1.2s; background-color: rgb(45, 203, 115);"><small style="left: 22px; transition: left 0.2s; -webkit-transition: left 0.2s;"></small></span>
                                <span class="chec_txt"><?php echo __('表示する')?></span>
              </div>
              <p class="form-help fml_184"><?php echo __('アプリに表示させるかどうかを選ぶことができます。')?></p>
              <div class="form_hr"></div>
            </div>

            <hr>

            <div class="btn_center">
              <a href="javascript:void(0);" class="btn btn-default btn-sm" onclick="ajaxHideUpdateItemForm(477);"><i class="fa fa-mail-reply mg-r-xs"></i><?php echo __('戻る')?></a>
              <a href="javascript:void(0);" class="btn btn-info btn-sm" onclick="ajaxUpdateItem(477);"><i class="fa fa-edit mg-r-xs"></i><?php echo __('変更')?></a>
            </div>

            <hr>

          </form>

        </div>
        <!-- ▲▲ -->

      </div>
    </div>

    <div class="frame_bottom_box">
      <div class="padding10"></div>
    </div>

  </div>
</div>
<!-- ▲ -->

<!-- ▼ メニューの利用 ON/OFF -->
<div class="frame_main_box box_kage">

  <header class="panel-heading panel-title"><?php echo __('メニューの利用 ON/OFF')?></header>
  <div class="form_top"></div>

  <center class="f_d">
    <p><?php echo __('現在、メニュー機能を利用中です。利用を停止する場合はボタンを押してください。')?></p>
    <p><?php echo __('メニュー機能を停止すると、アプリにメニューが表示されなくなります。')?></p>
  </center>

  <div id="menu_off">

        <div class="button_box">
      <a href="/menu?use=0" class="btn btn-danger btn-sm" onclick="return ajaxStopMenu();"><?php echo __('メニュー機能の利用を停止する')?></a>
    </div>

  </div>

  <div class="frame_bottom_box">
    <div class="padding10"></div>
  </div>

</div>
<!-- ▲ -->

<!-- ▼ メニューのリセット -->
<div class="frame_main_box box_kage">

  <header class="panel-heading panel-title"><?php echo __('メニューのリセット')?></header>
  <div class="form_top"></div>

  <center class="f_d">
    <p><?php echo __('メニュー機能をリセットすると、すべてのメニューは消えてしまいますが')?></p>
    <p><?php echo __('シンプルタイプ/カスタムタイプの選択からやり直すことが出来ます。ご利用にご注意ください。')?></p>
  </center>

  <div id="menu_reset">

        <div class="button_box">
      <a href="/menu?reset=0" class="btn btn-danger btn-sm" onclick="return ajaxResetMenu();"><?php echo __('メニューをリセットする')?></a>
    </div>

  </div>

  <div class="frame_bottom_box">
    <div class="padding10"></div>
  </div>

</div>
<!-- ▲ -->
