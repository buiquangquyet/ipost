<?php

App::uses('BasicInfoLogic', 'Model');

class BackgroundColor extends BasicInfoLogic {
	protected $infoName = 'background_info';

	protected function formatEachLogic($info, $data) {
		$info = json_decode($info);
		$info->background->color = $data['color'];
		return json_encode($info);
	}
}
