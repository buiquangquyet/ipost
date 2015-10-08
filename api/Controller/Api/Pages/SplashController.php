<?php
App::uses('AppApiController', 'Controller');
/**
* スプラッシュ画像APIのコントローラです。
* @author    Yoshitaka Kitagawa
*/
class SplashController extends AppApiController {

    /**
    * 前処理
    */
    public function beforeFilter() {
        parent::beforeFilter();
        //Configure::write('Config.language', 'vi');
    }

	/**
	* トップAPI
	*/
	public function index() {
		$data = $this->getSplash($this->user_id);
		echo json_encode($data);
		/* $token = isset($this->request->data['token'])?$this->request->data['token']:'';
		if(is_null($token) || empty($token)) {
			echo json_encode([]);
		} else {
			$this->loadModel('Device');
			$rs = $this->Device->find('first', ['conditions' => ['token' => $token, 'user_id' => $this->user_id]]);
			$device_lang = $rs['Device']['lang'];
			$lang = (isset($device_lang) && $device_lang)?$device_lang:Configure::read('Config.language');
			$data = $this->getSplash($this->user_id, $lang);
			$image = $data->splash->image;
			$this->loadModel('Image');
			$image_id = $this->Image->getImageId($image);
			$data->splash->image = $image_id;
			//$data->splash->image_id = $image_id;
			echo json_encode($data);
		} */
	}

	/**
	*
	*/
	// HSS add
	private function getSplash($id) {
		$this->loadModel('Splash');
		//return json_decode($this->Splash->getDataApi($id, $lang));
		return json_decode($this->Splash->getData($id));
	}

	/* private function getSplash($id, $lang) {
		$this->loadModel('Splash');
		//return json_decode($this->Splash->getDataApi($id, $lang));
		return json_decode($this->Splash->getData($id));
	} */

    // HIRO add
//     private function getSplash($id) {
//         $this->loadModel('Splash');
//         $this->loadModel('BasicInfo');

//         $basicInfo = $this->BasicInfo->getInfo($this->user_id, $this->Splash->getInfoName());
//         $modified = '';
//         $created  = '';
//         if ( ! empty($this->_basicInfo)) {
//             $modified = $basicInfo['BasicInfo']['modified'];
//             $created  = $basicInfo['BasicInfo']['created'];
//         }

//         $splashInfo = json_decode($this->Splash->getData($id), true);
//         $key = 'image';
//         $file_name = '';
//         $image_url = '';

//         if ( ! empty($splashInfo['splash']['image'])) {
//             $key = 'image';
//             $file_name = $splashInfo['splash']['image'];
//             $image_url = $this->getMediaUrl($file_name);
//         }
//         if ( ! empty($splashInfo['splash']['movie'])) {
//             $key = 'movie';
//             $file_name = $splashInfo['splash']['movie'];
//             $image_url = $this->getMediaUrl($file_name);
//         }

//         $splash = array(
//             'user_id' => $id,
//             'file_name' => $file_name,
//             'image_url' => $image_url,
//             'tmp_file_name' => '',
//             'file_type' => $key,
//             'updated_at' => $modified,
//             'created_at' => $created,
//         );
//         return array($splash);
//     }

}
