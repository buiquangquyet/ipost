<?php foreach($Block as $key => $blockInfo) {
	if ($key != 'margin') { 
		echo $this->element('preview/block/' . $key);
	}
} ?>