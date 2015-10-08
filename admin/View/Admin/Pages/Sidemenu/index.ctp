<div id="topInfo">
	<div>
		<!-- ▼ トップ画像の変更 -->
		<div class="frame_main_box box_kage">
			<div class="c"></div>
		</div>

		<?php foreach($Sidemenu as $key => $sidemenuInfo) { ?>
			<?php echo $this->element('sidemenu/' . $key); ?>
		<?php } ?>
	</div>
</div>


<?php echo $this->Html->scriptStart(array('inline' => false)) ?>

	function postData(id) {
		$('#' + id).submit();
	}

<?php echo $this->Html->scriptEnd(); ?>