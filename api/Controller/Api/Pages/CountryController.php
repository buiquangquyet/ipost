<?php
App::uses('AppApiController', 'Controller');
/**
* API Country
* @author    HuuHv
*/
class CountryController extends AppApiController {

	/**
	* Call first
	*/
	public function beforeFilter() {
		parent::beforeFilter();
	}

	/**
	* List all country
	*/
	public function index() 
	{
		$result = $this->Country->find('all', ['conditions' => ['status' => 1]]);
		$country = [];
		foreach($result as $key => $value) {
			$country[$value['Country']['id']] = $value['Country']['name'];
		}
		echo json_encode($country);
	}

	/**
	 * List city by countries_id
	 */
	public function getAllCityByCountry($id) 
	{
		$this->loadModel('City');
		$result = $this->Country->find('all', array('joins' => array(
				array(
						'table' => 'cities',
						'alias' => 'City',
						'type' => 'inner',
						'foreignKey' => false,
						'conditions'=> array('City.countries_id = Country.id', 'City.countries_id' => $id, 'City.status' => 1),
				)
			), 'fields' => 'City.*'
		));
		$city = [];
		$i = 0;
		foreach($result as $key => $value) {
			$city[$i]['id'] = $value['City']['id'];
			$city[$i]['name'] = $value['City']['name'];
			$city[$i]['code'] = $value['City']['code'];
			$city[$i]['countries_id'] = $value['City']['countries_id'];
			$i++;
		}
		echo json_encode($city);
	}
	
	/**
	 * List all city
	 */
	public function getAllCity() 
	{
		$this->loadModel('City');
		$result = $this->City->find('all', ['conditions' => ['status' => 1]]);
		$city = [];
		$i = 0;
		foreach($result as $key => $value) {
			$city[$i]['id'] = $value['City']['id'];
			$city[$i]['name'] = $value['City']['name'];
			$city[$i]['code'] = $value['City']['code'];
			$city[$i]['countries_id'] = $value['City']['countries_id'];
			$i++;
		}
		echo json_encode($city);
	}
}
