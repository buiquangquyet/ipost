<?php

App::uses('AppModel', 'Model');

/**
 *
 */
class BasicInfo extends AppModel {

	// HIRO
	public function getInfo($userId, $type) {

		$conditionList = array(
			'conditions' => array(
				'user_id' => $userId,
				'type' => $type,
				//'lang' => Configure::read('Config.language'), // Hss add for get data from default language
			),
		);

		return $this->find('first', $conditionList);
	}

	// Hss add $lang for multilanguage
	public function getInfoApi($userId, $type, $lang=NULL) {

		$conditionList = array(
				'conditions' => array(
						'user_id' => $userId,
						'type' => $type,
						'lang' => $lang?$lang:Configure::read('Config.language'), // Hss $lang for multilanguage
				),
		);

		return $this->find('first', $conditionList);
	}
}
