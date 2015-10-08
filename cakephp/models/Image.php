<?php

App::uses('AppModel', 'Model');

class Image extends AppModel {

	public function get($imageId) {

		// 念のためdefaultにしてあるものの、実際はどこを見るか検討しないといけない
		$this->setDataSource('default');

		$conditionList = array(
			'conditions' => array(
				'image_id' => $imageId,
				'lang'     => Configure::read('Config.language'),
			),
		);

		return $this->find('first', $conditionList);
	}

	public function getImageId($id)
	{
		$this->setDataSource('default');
		$conditionList = array(
				'conditions' => array(
						'id' => $id,
				),
		);

		$rs = $this->find('first', $conditionList);
		if($rs) return $rs['Image']['image_id'];
		else  return '';
	}

	public function getImageInfo($imageId) {

		// 念のためdefaultにしてあるものの、実際はどこを見るか検討しないといけない
		$this->setDataSource('default');

		$conditionList = array(
				'conditions' => array(
						'image_id' => $imageId,
				),
		);

		return $this->find('first', $conditionList);
	}
}