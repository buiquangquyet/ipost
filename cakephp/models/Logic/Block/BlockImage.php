<?php

App::uses('ImageLogic', 'Model');

class BlockImage extends ImageLogic {
    protected $infoName = 'block_info';

    protected function formatEachLogic($info, $data) {

    	if(empty($data['Image']['image_id'])) {
    		return $info;
    	}

    	$info = json_decode($info, true);
    	$info['image']['images'][$data['orgParams']['pos']]['image'] = $data['Image']['image_id'];
    	return json_encode($info);
    }
}
