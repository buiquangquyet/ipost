<div id="top_block"><div class="block margin-medium images">
	<div class="caroufredsel_wrapper">
		<div id="block-image">
			<?php foreach($Block['image']['images'] as $imageInfo) { 
				if(!empty($imageInfo['image'])) {
					echo $this->Html->image(array('controller' => 'media', 'action' => 'image/' . $imageInfo['image']), array('width' => 236, 'height' => 155));
				}
			}?>
		</div>
	</div>
</div>

<?php echo $this->Html->scriptStart(array('inline' => false)) ?>
	$(document).ready(function(){
		$("#block-image").carouFredSel({
		  circular: true,
		  infinite: true,
		  auto    : true,
		  pagination  : ".block.images-paging"
		});
	});
<?php echo $this->Html->scriptEnd(); ?>