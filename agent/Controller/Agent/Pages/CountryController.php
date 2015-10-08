<?php
App::uses('AppAgentController', 'Controller');
/**
* Management Country
* @author    HuuHv
*/
class CountryController extends AppAgentController {

	public $paginate = array(
			'limit' => 30,
			'contain' => array('Country')
	);

    /**
    * Call frist
    * @access  public
    */
    public function beforeFilter()
    {
        parent::beforeFilter();

        if(isset($this->Security) && $this->request->isPost() && $this->action == 'importcity'){
        	$this->Security->validatePost = false;
        	$this->Security->enabled = false;
        	$this->Security->csrfCheck = false;
        }
    }

    /**
     * List Country
     * @return array
     */
    public function index()
    {
        $this->Paginator->settings = $this->paginate;
        // similar to findAll(), but fetches paged results
        $data = $this->Paginator->paginate('Country');
        $this->set('countries', $data);
    }

    public function view($id = null) {
    	if (!$id) {
    		throw new NotFoundException(__('無効な国'));
    	}

    	$countries = $this->Country->findById($id);
    	if (!$countries) {
    		throw new NotFoundException(__('無効な国'));
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

    /**
     * Create new countries
     * @access public
     */
    public function add()
    {
        if ($this->request->is('post')) {
        	$rs = $this->request->data;
        	$name = $rs['Country']['name'];
        	$count = $this->Country->find('count', ['conditions' => ['name' => $name]]);
        	if($count) {
        		$this->Session->setFlash(__('国が存在していました!'), 'default', array('class' => 'alert alert-danger'));
        		return;
        	}
            $this->Country->create();
            if ($this->Country->save($this->request->data)) {
                $this->Session->setFlash(__('国情報を登録しました。'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('国情報の登録が失敗されました。'), 'default', array('class' => 'alert alert-danger'));
        }
    }

    /**
    * Country update
    * @access  public
    */
    public function edit($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('無効な国'));
        }

        $countries = $this->Country->findById($id);
        if (!$countries) {
            throw new NotFoundException(__('無効な国'));
        }

        if ($this->request->is(array('countries', 'post'))) {
            $this->Country->id = $id;
            if ($this->Country->save($this->request->data)) {
                $this->Session->setFlash(__('国情報を更新しました。'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('国情報の更新が失敗されました。'), 'default', array('class' => 'alert alert-danger'));
        }

        if (!$this->request->data) {
            $this->request->data = $countries;
        }
        $this->set('countries' , $countries);
    }

    /**
     * Delete countries
     */
    public function delete($id)
    {
    	if ($this->request->is('get')) {
    		throw new MethodNotAllowedException();
    	}

    	if ($this->Country->delete($id)) {
    		$this->loadModel('City');
    		$this->City->deleteAll(["countries_id" => $id]);

    		$this->Session->setFlash(__('国情報を削除しました。'), 'default', array('class' => 'alert alert-success'));
    	} else {
    		$this->Session->setFlash(__('国情報の削除が失敗されました。'), 'default', array('class' => 'alert alert-danger'));
    	}

    	return $this->redirect($this->referer());
    	//return $this->redirect(array('action' => 'lists'));
    }

    /**
     * List City
     * @return array
     */
    public function listcity($id = null)
    {
    	if (!$id) {
    		throw new NotFoundException(__('このデータが存在していません'));
    	}

    	$this->loadModel('Country');
    	$countries = $this->Country->findById($id);
    	if (!$countries) {
    		throw new NotFoundException(__('このデータが存在していません'));
    	}
    	$this->set('countries', $countries);

    	$this->loadModel('City');
    	$cities = [];
    	$conditions = array(
    			'contain' => array('City'),
    			'joins' => array(
    					array(
    							'table' => 'countries',
    							'alias' => 'Country',
    							'type' => 'inner',
    							'foreignKey' => false,
    							'conditions'=> array('City.countries_id = Country.id', 'City.countries_id' => $id),
    					)),
    			'fields' => 'City.*',
    			'order' => 'City.name, City.code, City.created',
    			'limit' => 30
    	);
//     	$cities = $this->Country->find('all', $conditions);

    	$this->Paginator->settings = $conditions;
    	$cities = $this->Paginator->paginate('City');
    	$this->set('cities', $cities);
    }

    /**
     * Create new city of country
     * @access public
     */
    public function addcity($id)
    {
    	$this->loadModel('Country');
    	$country = $this->Country->find('all');
    	foreach($country as $key => $value) {
    		$countries[$value['Country']['id']] = $value['Country']['name'];
    	}
    	$this->set('countries', $countries);
    	$this->set('countries_id', $id);
    	$this->loadModel('City');
    	if ($this->request->is('post')) {
    		$rs = $this->request->data;
    		$count = $this->City->find('count', ['conditions' => ['code' => $rs['City']['code'], 'countries_id' => $id]]);
    		if($count) {
    			$this->Session->setFlash(__('市はすでに存在していた！', $countries[$rs['City']['countries_id']]), 'default', array('class' => 'alert alert-danger'));
    			return;
    		}
    		$this->City->create();
    		$this->request->data['City']['countries_id'] = $id;
    		if ($this->City->save($this->request->data)) {
    			$this->Session->setFlash(__('都市情報を登録しました。'), 'default', array('class' => 'alert alert-success'));
    			return $this->redirect(array('action' => 'listcity', $id));
    		}
    		$this->Session->setFlash(__('都市情報の登録が失敗されました。'), 'default', array('class' => 'alert alert-danger'));
    	}
    }

    /**
     * City update of country
     * @access  public
     */
    public function editcity($id, $cid)
    {
    	if (!$id) {
    		throw new NotFoundException(__('このデータが存在していません'));
    	}
    	if (!$cid) {
    		throw new NotFoundException(__('このデータが存在していません'));
    	}

    	$this->loadModel('City');
    	$cities = $this->City->findById($id);
    	if (!$cities) {
    		throw new NotFoundException(__('このデータが存在していません'));
    	}
    	if ($this->request->is(array('post'))) {
    		$this->City->id = $id;
    		$this->City->countries_id = $cid;

    		if ($this->City->save($this->request->data)) {
    			$this->Session->setFlash(__('都市情報を更新しました。'), 'default', array('class' => 'alert alert-success'));
    			return $this->redirect(array('action' => 'listcity', $cid));
    		}
    		$this->Session->setFlash(__('都市情報の更新が失敗されました。'), 'default', array('class' => 'alert alert-danger'));
    	}

    	if (!$this->request->data) {
    		$this->request->data = $cities;
    	}
    	$this->loadModel('Country');
    	$country = $this->Country->find('all');
    	foreach($country as $key => $value) {
    		$countries[$value['Country']['id']] = $value['Country']['name'];
    	}
    	$this->set('cid', $cid);
    	$this->set('countries', $countries);
    	$this->set('cities' , $cities);
    }

    /**
     * Import city via file excel(csv, xls, xlsx)
     * @access  public
     */
    public function importcity($id = null)
    {
    	if (!$id) {
    		throw new NotFoundException(__('無効な国'));
    	}

    	$countries = $this->Country->findById($id);
    	if (!$countries) {
    		throw new NotFoundException(__('無効な国'));
    	}
    	$countries = $this->Country->findById($id);

    	if ($this->request->data) {
    		$countries_id = $this->request->data['countries_id'];
    		//Check valid spreadsheet has been uploaded
    		if(isset($_FILES['file'])){
    			if($_FILES['file']['tmp_name']){
    				$this->PhpExcel->loadWorksheet($_FILES['file']['tmp_name']);
    				if(!$_FILES['file']['error'])
    				{
    					$inputFile = $_FILES['file']['tmp_name'];
    					//Read spreadsheeet workbook
    					try {
    						$inputFileType = PHPExcel_IOFactory::identify($inputFile);
    						$objReader = PHPExcel_IOFactory::createReader($inputFileType);
    						$objPHPExcel = $objReader->load($inputFile);
    					} catch(Exception $e) {
    						die($e->getMessage());
    					}

    					//Get worksheet dimensions
    					$sheet = $objPHPExcel->getSheet(0);
    					$highestRow = $sheet->getHighestRow();
    					$highestColumn = $sheet->getHighestColumn();

    					//Loop through each row of the worksheet in turn
    					for ($row = 1; $row <= $highestRow; $row++){
    						//  Read a row of data into an array
    						$rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
    					}
    				}
    				else{
    					$this->Session->setFlash(__('ファイルのインポートエラーです。'), 'default', array('class' => 'alert alert-danger'));
    				}
    			}

    			//Insert into city db
    			$this->loadModel('City');
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
    			$rs = [];
    			foreach ($rowData as $key => $value) {
    				$rs[(string)$value[0][1]]['City'] = [
	    				'name' => (string)$value[0][0],
	    				'code' => (string)$value[0][1],
	    				'status' => 1,
	    				'countries_id' => $countries_id
    				];
    			}
    			$city = [];
    			foreach($cities as $k => $v) {
    				$city[$v['City']['code']] = $v;
    			}

    			$result = array_diff_key($rs, $city);
    			if($result) {
    				if ($this->City->saveAll($result)) {
    					$this->Session->setFlash(__('ファイルをインポートしました。'), 'default', array('class' => 'alert alert-success'));
    					return $this->redirect(array('action' => 'listcity', $countries_id));
    				}
    			}
    			$this->Session->setFlash(__('ファイルインポートが失敗されました。'), 'default', array('class' => 'alert alert-danger'));
    		}
    	}

    	$this->set('countries' , $countries);
    }

    /**
     * Delete city of country
     */
    public function deletecity($id)
    {
    	$this->loadModel('City');
    	$country = $this->City->find('all');
    	foreach($country as $key => $value) {
    		$countries[$value['City']['id']] = $value['City']['name'];
    	}
    	if ($this->request->is('get')) {
    		throw new MethodNotAllowedException();
    	}

    	if ($this->City->delete($id)) {
    		$this->Session->setFlash(__('都市情報を削除しました。'), 'default', array('class' => 'alert alert-success'));
    		return $this->redirect($this->referer());
    	} else {
    		$this->Session->setFlash(__('都市情報の削除は失敗されました。'), 'default', array('class' => 'alert alert-danger'));
    	}

    	return $this->redirect($this->referer());
    	//return $this->redirect(array('action' => 'index'));
    }
}
