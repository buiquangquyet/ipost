<div id="main_box">
	<article class="head_navi">
		<h1>iPostお申込フォーム</h1>
		<nav>
			<ul>
				<li><a href="#">代理店番号:&nbsp;<?php echo $userId;?></a></li>
			</ul>
		</nav>
		<div class="c"></div>
	</article>

	<article class="form_box">
		<div class="form_in">
			<div class="txt_top cent">このフォームにてiPostの登録を行います。</div>
			<h1 class="cent">必要事項を入力してください。</h1>

			<div class="form_main">
				<?php echo $this->Form->create(false, array('id' => 'form1', 'url' => array('controller' => 'client', 'action' => 'regist', $userId), 'novalidate' => true)); ?>
					<div class="form_main_l index_input">
					<label for="textfield"></label>
					<?php echo $this->Form->input('Shop.shop_name', array('type' => 'text', 'div' => false, 'label' => false, 'placeholder' => '店名', 'class' => 'span_login'));?>
					<div class="form_span"></div>
						<label for="textfield"></label>
						<?php echo $this->Form->input('User.email', array('type' => 'text', 'div' => false, 'label' => false, 'placeholder' => '登録Eメール', 'class' => 'span_login'));?>
					</div>

					<div class="form_main_r">
						<input type="hidden" name="agent_id" value="{$agent->id}" />
						<input type="hidden" name="cd" value="{$fieldset->value('cd')}" />

						<input type="button" class="css_btn_class" value="&nbsp;&nbsp;&nbsp;送&nbsp;&nbsp;信&nbsp;&nbsp;&nbsp;" onclick="document.form1.submit();">
					</div>
					<div class="c"></div>
				<?php echo $this->Form->end();?>

				<div id="" class="tyuyaku error"><?php echo $this->Session->flash(); ?></div>

				<!--
				<div class="tyuyaku">
				送信すると<a href="/policy" target="_brank">iPost利用規約</a>に同意したことになります。
				</div>
				-->

				<div class="tyuyaku">
					登録内容はお間違いのないようご注意ください。
				</div>
			</div>

			<div class="form_span2"></div>
			<div class="c"></div>
		</div>
	</article>
</div>

