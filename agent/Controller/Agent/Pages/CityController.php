<?php
App::uses('AppAgentController', 'Controller');
/**
* Management City
* @author    HuuHv
*/
class CityController extends AppAgentController {
	
	public $paginate = array(
			'limit' => 50,
			'contain' => array('City'),
			'order' => array(
					'City.countries_id' => 'asc'
			),
	);
	
    /**
    * Call frist
    * @access  public
    */
    public function beforeFilter() 
    {
        parent::beforeFilter();
    }
    
    public function index()
    {
        $this->Paginator->settings = $this->paginate;
        // similar to findAll(), but fetches paged results
        $data = $this->Paginator->paginate('City');
        $this->set('cities', $data);
        $this->loadModel('Country');
        $country = $this->Country->find('all');
        foreach($country as $key => $value) {
        	$countries[$value['Country']['id']] = $value['Country']['name'];
        }
        $this->set('countries', $countries);
    }

  	/**
  	 * List City
  	 * @return array
  	 */
    public function lists($id = null) 
    {
    	if (!$id) {
    		throw new NotFoundException(__('無効な都市'));
    	}
    	
    	$this->loadModel('Country');
        $countries = $this->Country->findById($id);
    	if (!$countries) {
    		throw new NotFoundException(__('無効な都市'));
    	}

    	$cities = [];
    	$cities = $this->Country->find('all', array('joins' => array(
    			array(
    					'table' => 'cities',
    					'alias' => 'City',
    					'type' => 'inner',
    					'foreignKey' => false,
    					'conditions'=> array('City.countries_id = Country.id', 'City.countries_id' => $id),
    			)
    		), 'fields' => 'City.*'
    	));

    	$this->set('countries', $countries);
    	$this->set('cities', $cities);
    }
    
    public function view($id = null) {
    	if (!$id) {
    		throw new NotFoundException(__('無効な都市'));
    	}
    
    	$cities = $this->City->findById($id);
    	if (!$cities) {
    		throw new NotFoundException(__('無効な都市'));
    	}
    	$this->loadModel('Country');
    	$country = $this->Country->find('all');
    	foreach($country as $key => $value) {
    		$countries[$value['Country']['id']] = $value['Country']['name'];
    	}
    	$this->set('countries', $countries);
    	$this->set('cities', $cities);
    }

    /**
     * Create new cities 
     * @access public
     */
    public function add() 
    {
    	$this->loadModel('Country');
    	$country = $this->Country->find('all');
    	foreach($country as $key => $value) {
    		$countries[$value['Country']['id']] = $value['Country']['name'];
    	}
    	$this->set('countries', $countries);
    	
        if ($this->request->is('post')) {
        	$rs = $this->request->data;
        	$count = $this->City->find('count', ['conditions' => ['name' => $rs['City']['name'], 'countries_id' => $rs['City']['countries_id']]]);
        	if($count) {
        		$this->Session->setFlash(__('この都市％sは存在して！', $countries[$rs['City']['countries_id']]), 'default', array('class' => 'alert alert-danger'));
        		return;
        	}
            $this->City->create();
            if ($this->City->save($this->request->data)) {
                $this->Session->setFlash(__('あなたの都市が保存されています。'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('あなたの街を追加することができません。'), 'default', array('class' => 'alert alert-danger'));
        }
    }
    
    /**
    * City update
    * @access  public
    */
    public function edit($id = null) 
    {
        if (!$id) {
            throw new NotFoundException(__('無効な都市'));
        }

        $cities = $this->City->findById($id);
        if (!$cities) {
            throw new NotFoundException(__('無効な都市'));
        }

        if ($this->request->is(array('cities', 'post'))) {
            $this->City->id = $id;
            if ($this->City->save($this->request->data)) {
                $this->Session->setFlash(__('あなたの街が更新されました。'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('あなたの街を更新できません。'), 'default', array('class' => 'alert alert-danger'));
        }

        if (!$this->request->data) {
            $this->request->data = $cities;
        }
        $this->loadModel('Country');
        $country = $this->Country->find('all');
        foreach($country as $key => $value) {
        	$countries[$value['Country']['id']] = $value['Country']['name'];
        }
        $this->set('countries', $countries);
        $this->set('cities' , $cities);
    }
    
    /**
     * Delete cities
     */
    public function delete($id)
    {
    	$country = $this->City->find('all');
    	foreach($country as $key => $value) {
    		$countries[$value['City']['id']] = $value['City']['name'];
    	}
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->City->delete($id)) {
            $this->Session->setFlash(__('名前の都市：％sは削除されました。', h($countries[$id])), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('名前の都市：％sは削除できませんでした。', h($countries[$id])), 'default', array('class' => 'alert alert-danger'));
        }

        return $this->redirect(array('action' => 'index'));
    }
    
}
