<?php

App::uses('BasicInfoLogic', 'Model');

class HeaderColor extends BasicInfoLogic {
	protected $infoName = 'header_info';

	protected function formatEachLogic($info, $data) {
		$info = json_decode($info);
		$info->header->color = $data['color'];
		return json_encode($info);
	}
}
