<?php
App::uses('AppApiController', 'Controller');
/**
* トークン登録APIのコントローラです。
* @author    Yoshitaka Kitagawa
*/
class TokenController extends AppApiController {

    /**
    * 前処理
    */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
    * トップAPI
    */
    public function index() {
    	$this->loadModel('Device');

    	// 言語対応している？？
    	$this->loadModel('LangMap');
    	$this->loadModel('UserLang');

    	$request = $this->request->data;
    	if($request) {
    		$lang_after = $this->LangMap->isBefore(Configure::read('Config.language'));
    		$langInfo = $this->UserLang->isLang($request['user_id'], $lang_after);
    		$rows = $this->LangMap->find('all');
    		$lang_before = [];
    		$lang_after = [];
    		foreach($rows as $key => $value) {
    			$lang_before[$value['LangMap']['id']] = $value['LangMap']['lang_before'];
    			$lang_after[$value['LangMap']['lang_before']] = $value['LangMap']['lang_after'];
    		}
    		$lang = $this->request->data('lang');
    		$lang_before = array_diff($lang_before, ['zh', 'hk']);
    		if(in_array($lang, $lang_before)) {
    			$lang_set = $lang_after[$lang];
    			/* $this->Cookie->write('lang', $lang_set);
    			Configure::write('Config.language', $lang_set);
    			$this->lang = $lang_set; */
    		} else {
    			$lang_set = '';
    		}
    		$arr_select_lang_set = $this->UserLang->getList($request['user_id']);
    		$arr_lang = Configure::read('LanguagesList');
    		$select_lang_set = [];
    		foreach ($arr_select_lang_set as $key => $value) {
    			$select_lang_set[$value['UserLang']['lang']] = $arr_lang[$value['UserLang']['lang']];
    		}
    		$request['allow_flg'] = 1;
    		$data = ['Device' => $request];
    		$device_lang = $lang_set?$lang_set:'ja';
    		$rs = $this->Device->find('first', ['conditions' => ['token' => $request['token'], 'user_id' => $request['user_id']]]);
    		$result = [];
    		if(count($rs)) {
    			// set default language
    			$this->Device->id = $rs['Device']['id'];
    			$this->Device->saveField("lang", $device_lang);
    		} else {
    			if($this->Device->save($data)) {
    				// set default language
    				$rs = $this->Device->find('first', ['conditions' => ['token' => $request['token'], 'user_id' => $request['user_id']]]);
    				$this->Device->id = $rs['Device']['id'];
    				$this->Device->saveField("lang", $device_lang);
    			} else {
    				echo json_encode([]);
    			}
    		}
    		// call for service
    		$rs = $this->Device->find('first', ['conditions' => ['token' => $request['token'], 'user_id' => $request['user_id']]]);
    		/* $rs['Device']['lang_set'] = $lang_set;
    		$rs['Device']['select_lang_set'] = Configure::read('LanguagesList');
    		$result = $rs['Device']; */
    		$result['id'] = $rs['Device']['id'];
    		$result['lang_set'] = $lang_set;
    		$result['select_lang_set'] = [$select_lang_set];
    		$result['created'] = date('Y/m/d', strtotime($rs['Device']['created']));
    		//$result['updated'] = $rs['Device']['modified'];
    		echo json_encode($result);
    	} else echo json_encode([]);
    }

    public function lang() {
    	$this->loadModel('UserLang');

    	$request = $this->request->data;
	    $select_lang_set = [];
    	if($request) {
	    	$arr_select_lang_set = $this->UserLang->getList($request['user_id']);
	    	$arr_lang = Configure::read('LanguagesList');
	    	$_select_lang_set = [];
	    	foreach ($arr_select_lang_set as $key => $value) {
	    		$select_lang_set[$key]['code'] = $value['UserLang']['lang'];
	    		$select_lang_set[$key]['name'] = $arr_lang[$value['UserLang']['lang']];
	    	}
    	}
    	echo json_encode($select_lang_set);
    }

}
