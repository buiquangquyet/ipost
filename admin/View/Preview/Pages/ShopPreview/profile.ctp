<div class="preview shop-profile">

	<!-- お店画像 -->
	<div class="profile image">
		<?php if(!empty($Shop['image'])) {
			echo $this->Html->image(array('controller' => 'media', 'action' => $Shop['image']), array('width' => 255, 'height' => 148));
		} ?>
	</div>
	<!--  -->

	<!-- お店情報 -->
	<div>
		<ul>
			<li class="profile name">
				<span><?php echo $Shop['profile']['shop_name']; ?></span>
			</li>

			<?php if(!empty($Shop['profile']['pref']) && !empty($Shop['profile']['zip_code1']) && !empty($Shop['profile']['zip_code2']) && !empty($Shop['profile']['city']) && !empty($Shop['profile']['address_opt1']) && !empty($Shop['profile']['address_opt2'])) { ?>
				<li class="profile address">
					<label><?php echo __('住所')?></label>
					<div>
						<?php if(!empty($Shop['profile']['zip_code1']) && !empty($Shop['profile']['zip_code2'])) {
							echo __('〒') . $Shop['profile']['zip_code1'] . '-' . $Shop['profile']['zip_code2'] . '<br>';
						} ?>

						<?php echo $Shop['profile']['pref']; ?>
						<?php echo $Shop['profile']['city']; ?>
						<?php echo $Shop['profile']['address_opt1']; ?><br>
						<?php echo $Shop['profile']['address_opt2']; ?>
					</div>
				</li>
			<?php } ?>

			<?php if(!empty($Shop['profile']['tel1']) && !empty($Shop['profile']['tel2']) && !empty($Shop['profile']['tel3'])) { ?>
				<li class="profile tel">
					<label><?php echo __('TEL')?></label>
					<span><?php echo $Shop['profile']['tel1']; ?>&nbsp;-&nbsp;<?php echo $Shop['profile']['tel2']; ?>&nbsp;-&nbsp;<?php echo $Shop['profile']['tel3']; ?></span>
				</li>
			<?php } ?>

			<?php if(!empty($Shop['profile']['fax1']) && !empty($Shop['profile']['fax2']) && !empty($Shop['profile']['fax3'])) { ?>
				<li class="profile fax">
					<label><?php echo __('FAX')?></label>
					<span><?php echo $Shop['profile']['fax1']; ?>&nbsp;-&nbsp;<?php echo $Shop['profile']['fax2']; ?>&nbsp;-&nbsp;<?php echo $Shop['profile']['fax3']; ?></span>
				</li>
			<?php } ?>

			<?php if(!empty($Shop['profile']['email'])) { ?>
			<li class="profile mail">
				<label><?php echo __('Email')?></label>
				<span><?php echo $Shop['profile']['email']; ?></span>
			</li>
			<?php } ?>

			<?php if(!empty($Shop['profile']['email'])) { ?>
			<li class="profile email">
				<label><?php echo __('Email')?></label>
				<span><?php echo $Shop['profile']['email']; ?></span>
			</li>
			<?php } ?>

			<?php if(!empty($Shop['profile']['url'])) { ?>
			<li class="profile url">
				<label><?php echo __('URL')?></label>
				<span><?php echo $Shop['profile']['url']; ?></span>
			</li>
			<?php } ?>

			<?php if(!empty($Shop['profile']['online_shop'])) { ?>
			<li class="profile url">
				<label><?php echo __('オンラインショップ')?></label>
				<br>
				<span><?php echo $Shop['profile']['online_shop']; ?></span>
			</li>
			<?php } ?>

			<?php if(!empty($Shop['profile']['open_hours'])) { ?>
			<li class="profile open">
				<label><?php echo __('営業時間')?></label>
				<span><?php echo $Shop['profile']['open_hours']; ?></span>
			</li>
			<?php } ?>

			<?php if(!empty($Shop['profile']['holiday'])) { ?>
			<li class="profile close">
				<label><?php echo __('定休日')?></label>
				<span><?php echo $Shop['profile']['holiday']; ?></span>
			</li>
			<?php } ?>
		</ul>
	</div>
	<!--  -->

</div>