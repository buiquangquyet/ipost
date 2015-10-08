<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'registEnable', 'novalidate' => true, 'id' => 'enable')); ?>
	<div class="frame_main_box box_kage">
		<div class="c"></div>
		<header class="panel-heading panel-title"><?php echo __('機能 ON /OFF'); ?></header>
		<div class="form_top"></div>

		<div class="form-group">
			<label for="form_enable" class="form-label"><?php echo __('予約カレンダーの使用'); ?></label>
			<div class="checkbox_box">
				<?php echo $this->Form->input("enable", array('type' => 'radio', 'options' => Configure::read('ReserveDisp'), 'label' => true, 'div' => false, 'legend' => false, 'style' => 'width:20px;margin-left:30px;margin-top:8px;', 'onchange' => 'postData("enable")')); ?>
			</div>
			<p class="form-help ml_180"><?php echo __('サイドメニューに、予約カレンダーを表示させるか選択できます。'); ?></p>
		</div>

		<div class="button_box">
		</div>

		<div class="frame_bottom_box">
			<div class="padding10"></div>
		</div>
	</div>
<?php echo $this->Form->end(); ?>



<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'registRule', 'novalidate' => true, 'id' => 'rule_body')); ?>
<div class="frame_main_box box_kage">
	<div class="c"></div>
	<header class="panel-heading panel-title"><?php echo __('ご利用方法'); ?></header>
	<div class="form_top"></div>

	<div class="form-group">
		<label for="" class="form-label"><?php echo __('ご利用方法'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
		<?php echo $this->Form->textarea("rule_body", array('class' => 'form-txt form-textarea', 'type' => 'textarea', 'label' => false, 'rows' => 10, 'cols' => 30)); ?>
		<p class="form-help ml_180"></p>
		<div class="form_hr"></div>
	</div>

	<div class="btn_center">
		<button type="button" class="btn btn-info btn-sm" onclick="postData('rule_body')"><?php echo __('<i class="fa fa-edit mg-r-xs"></i>変更'); ?></button>
	</div>

	<div class="frame_bottom_box">
		<div class="padding10"></div>
	</div>
</div>
<?php echo $this->Form->end(); ?>



<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'registMail', 'novalidate' => true, 'id' => 'mail_body')); ?>
<div class="frame_main_box box_kage">
	<div class="c"></div>
	<header class="panel-heading panel-title"><?php echo __('メール本文'); ?></header>
	<div class="form_top"></div>

	<div class="form-group">
		<label for="" class="form-label"><?php echo __('メール本文'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
		<?php echo $this->Form->textarea("mail_body", array('class' => 'form-txt form-textarea', 'type' => 'textarea', 'label' => false, 'rows' => 10, 'cols' => 30)); ?>

			<p class="form-help ml_180"><?php echo __('予約メールを送信する際に、ユーザーに記載してほしい項目を編集できます。'); ?><br>
			<?php echo __('予約希望日は、選択された日付が自動で挿入されます。'); ?></p>
			<div class="form_hr"></div>
		</div>

		<div class="btn_center">
			<button type="button" class="btn btn-info btn-sm" onclick="postData('mail_body')"><?php echo __('<i class="fa fa-edit mg-r-xs"></i>変更'); ?></button>
		</div>

	<div class="frame_bottom_box">
		<div class="padding10"></div>
	</div>
</div>
<?php echo $this->Form->end(); ?>


<?php echo $this->Form->create(false, array('type' => 'post', 'action' => 'registTelMail', 'novalidate' => true, 'id' => 'tel_mail')); ?>
<div class="frame_main_box box_kage">
	<div class="c"></div>
	<header class="panel-heading panel-title"><?php echo __('予約用連絡先'); ?></header>
	<div class="form_top"></div>

	<div class="form-group">
		<label for="form_tel1" class="form-label"><?php echo __('電話番号'); ?><span class="nin"><?php echo __('任意'); ?></span></label>
		<?php echo $this->Form->input("tel1", array('class' => 'form-txt form-2', 'type' => 'text', 'label' => false, 'div' => false, 'placeholder' => __('市外局番'), 'maxlength' => 4)); ?>&nbsp;
		<?php echo $this->Form->input("tel2", array('class' => 'form-txt form-2', 'type' => 'text', 'label' => false, 'div' => false, 'placeholder' => __('市外局番'), 'maxlength' => 4)); ?>&nbsp;
		<?php echo $this->Form->input("tel3", array('class' => 'form-txt form-2', 'type' => 'text', 'label' => false, 'div' => false, 'placeholder' => __('市外局番'), 'maxlength' => 4)); ?>
		<p class="form-help ml_180"><?php echo __('予約受け付け用の電話番号を指定できます。指定しない場合は、店舗情報に登録されている電話番号が利用されます。'); ?></p>
		<div class="form_hr"></div>
	</div>

	<hr>

	<div class="form-group">
		<label for="form_email" class="form-label"><?php echo __('メールアドレス'); ?><span class="nin"><?php echo __('任意'); ?></span></label>

		<?php echo $this->Form->input("email", array('class' => 'form-txt form-5', 'type' => 'text', 'label' => false, 'placeholder' => __('メールアドレスを入力'), 'maxlength' => 256)); ?>

		<p class="form-help ml_180"><?php echo __('予約受け付け用のメールアドレスを指定できます。指定しない場合は、登録されているログインメールアドレス宛に送信されます。'); ?></p>
		<div class="form_hr"></div>
	</div>

	<div class="btn_center">
		<button type="button" class="btn btn-info btn-sm" onclick="postData('tel_mail')"><?php echo __('<i class="fa fa-edit mg-r-xs"></i>変更'); ?></button>
	</div>

	<div class="frame_bottom_box">
		<div class="padding10"></div>
	</div>
</div>
<?php echo $this->Form->end(); ?>


<?php echo $this->Html->scriptStart(array('inline' => false)) ?>

	function postData(id) {
		$('#' + id).submit();
	}

<?php echo $this->Html->scriptEnd(); ?>