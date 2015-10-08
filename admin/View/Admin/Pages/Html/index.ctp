<div class="frame_main_box">
	<header class="panel-heading panel-title"><?php echo __('HTMLの編集'); ?></header>
	<div class="form_top"></div>

	<div>
		<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'registHtml', 'novalidate' => true, 'id' => 'html')); ?>

			<p><font color="#0000ff" class="ml_30"><?php echo __('HTML 入力エリア'); ?></font></p>
			<?php echo $this->Form->textarea('html' , array('class' => 'ml_30', 'cols' => 80, 'rows' => 10, 'wrap' => 'hard')); ?>
			<hr>

			<div class="btn_center">
				<a href="javascript:void(0);" class="btn btn-info btn-sm" onclick="$('#html').submit();"><?php echo __('<i class="fa fa-plus mg-r-xs"></i>更新'); ?></a>
			</div>
		<?php echo $this->Form->end(); ?>

		<hr>

		<?php echo $this->Form->create(false, array('type' => 'file', 'action' => 'registImage', 'novalidate' => true, 'id' => 'image')); ?>
		<div class="form-group ml_70">
			<label for="upload" class="form-label wau ml_0"><?php echo __('画像の選択'); ?></label>
			<div class="upload_wrapper">
				<div class="upload_btn"><?php echo __('ファイルを選択'); ?></div>
				<?php echo $this->Form->file("image", array('class' => 'pt_10 wau ImageSelect', 'label' => false , 'onChange' => '$("#image").submit();')); ?>
			</div>
			<p class="form-help mr_15 ml_0 mt_10"><?php echo __('ファイルサイズ：3MBまで<br>htmlに表示させる画像を登録してください。'); ?></p>
		</div>
		<?php echo $this->Form->end(); ?>

		<hr>

		<p><font color="#0000ff" class="ml_30"><?php echo __('画像リスト'); ?></font></p>
		<span><font color="#ff0000" class="ml_30"><?php echo __('画像の&nbsp;img&nbsp;タグをコピー＆ペーストしてご利用ください。'); ?></font></span>


		<ul class="img-thum-list ml_30">
			<?php foreach($HtmlInfo['image'] as $key => $image) { ?>
			<li id="image-list-58" class="clearfix">
				<div class="fl">
					<?php echo $this->Html->image("/media/image/{$image}", array('class' => 'img-thum')); ?>
					&lt;img src="<?php echo "/media/image/{$image}"; ?>" /&gt;
				</div>
				<div class="del-button fr">
					<?php echo $this->Html->link('<i class="fa fa-trash-o mg-l-xs"></i>&nbsp;'.__('削除'), array('controller' => 'Html', 'action' => 'removeImage', '?' => array('pos' => $key)), array('escape' => false, 'class' => 'btn btn-danger btn-sm')); ?>
				</div>
			</li>
			<?php } ?>
		</ul>
	</div>

	<div class="frame_bottom_box">
		<div class="padding10"></div>
	</div>
</div>

<div class="frame_main_box">

	<header class="panel-heading panel-title"><?php echo __('CSSの編集')?></header>
	<div class="form_top"></div>

	<div>
		<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'registCss', 'novalidate' => true, 'id' => 'css')); ?>

			<p class="ml_30">
				<font color="#20b2aa"><?php echo __('CSS 入力エリア'); ?></font><br>
				<?php echo __('CSS へのリンクタグは下記のものになります。'); ?><br>
				<br>
				&lt;link rel="stylesheet" type="text/css" href="/cms/css?userId=<?php echo $loginUserInfo['id']; ?>" media="all" /&gt;
			</p>

			<?php echo $this->Form->textarea('css' , array('class' => 'ml_30', 'cols' => 80, 'rows' => 10, 'wrap' => 'hard')); ?>
			<hr>

			<div class="btn_center">
				<a href="javascript:void(0);" class="btn btn-info btn-sm" onclick="$('#css').submit();"><?php echo __('<i class="fa fa-plus mg-r-xs"></i>更新'); ?></a>
			</div>

		<?php echo $this->Form->end(); ?>
	</div>

	<div class="frame_bottom_box">
		<div class="padding10"></div>
	</div>

</div>