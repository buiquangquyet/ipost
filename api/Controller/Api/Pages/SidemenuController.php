<?php
App::uses('AppApiController', 'Controller');
/**
* サイドメニューAPIのコントローラです。
* @author    Yoshitaka Kitagawa
*/
class SidemenuController extends AppApiController {

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
		$side = $this->getSide($this->user_id);
		echo json_encode($side);
		/* $token = isset($this->request->data['token'])?$this->request->data['token']:'';
		if(is_null($token) || empty($token)) {
			echo json_encode([]);
		} else {
			$this->loadModel('Device');
			$rs = $this->Device->find('first', ['conditions' => ['token' => $token, 'user_id' => $this->user_id]]);
			$device_lang = $rs['Device']['lang'];
			$lang = (isset($device_lang) && $device_lang)?$device_lang:Configure::read('Config.language');
			$side = $this->getSide($this->user_id, $lang);
			echo json_encode($side);
		} */
	}

    /**
    * サイドメニューの情報を取得します。
    */
    private function getSide($id/* , $lang */) {
        $side = array();
        $this->loadModel('Sidemenu');
        //$sideInfo = $this->Sidemenu->getDataApi($id, $lang);
        $sideInfo = $this->Sidemenu->getData($id);
        if (empty($sideInfo)) {
            $side = Configure::read('side_info');
        } else {
            $position = 1;
            foreach ($sideInfo as $key => $info) {
                $side[$key] = [
                    //'user_id' => $id,
                    'name' => $info['name'],
                    'key' => $key,
                    //'value' => '',
                    'file_name' => $info['icon'],
                    //'tmp_file_name' => '',
                    'enable' => (string)$info['enable'],
                    'position' => (string)$position,
                    //'updated_at' => '',
                    //'created_at' => '',
                ];
                $position ++;
            }
        }
        return $side;
    }

}

// <?php
// App::uses('AppApiController', 'Controller');
// /**
// * サイドメニューAPIのコントローラです。
// * @author    Yoshitaka Kitagawa
// */
// class SidemenuController extends AppApiController {

//     /**
//     * 前処理
//     */
//     public function beforeFilter() {
//         parent::beforeFilter();
//     }

//     /**
//     * トップAPI
//     */
//     public function index() {
//         $side = $this->getSide($this->user_id);
//         $this->response->body(json_encode($side));
//         return;
//     }

//     /**
//     * サイドメニューの情報を取得します。
//     */
//     private function getSide($id) {
//         $side = array();
//         $this->loadModel('Sidemenu');
//         $sideInfo = $this->Sidemenu->getData($id);
//         if (empty($sideInfo)) {
//             $side = Configure::read('side_info');

//         } else {
//             $position = 1;
//             foreach ($sideInfo as $key => $info) {
//                 $side[] = array(
//                     'user_id' => $id,
//                     'name' => $info['name'],
//                     'key' => $key,
//                     'value' => '',
//                     'file_name' => '',
//                     'tmp_file_name' => '',
//                     'enable' => $info['enable'],
//                     'position' => $position,
//                     'updated_at' => '',
//                     'created_at' => '',
//                 );
//                 $position ++;
//             }
//         }
//         return $side;
//     }

// }
