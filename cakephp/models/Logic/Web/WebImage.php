<?php

App::uses('ImageLogic', 'Model');

class WebImage extends ImageLogic {
    protected $infoName = 'web_info';

    protected function formatEachLogic($info, $data) {
        $info = json_decode($info);
        $info->image_list = array_merge($info->image_list,
                array(array('id' => $data['Image']['id'], 'file_name' => $data['Image']['image_id'])));
        return json_encode($info);
    }
}
