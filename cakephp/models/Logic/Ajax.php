<?php

App::uses('AppModel', 'Model');

class Ajax extends AppModel {

	/**
	 *
	 */
	public function dispatchSaveData($userId=null, $baseData) {
		$modelName = key($baseData);
		App::uses($modelName,'Model');
		$this->{$modelName} = new $modelName();
		$this->{$modelName}->saveData($userId, $baseData[$modelName]);
	}
}
