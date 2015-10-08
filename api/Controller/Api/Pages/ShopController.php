<?php
App::uses('AppApiController', 'Controller');
/**
* 店舗情報APIのコントローラです。
* @author    Yoshitaka Kitagawa
*/
class ShopController extends AppApiController {

	/**
	* 前処理
	*/
	public function beforeFilter() {
		parent::beforeFilter();
	}

	/**
	* 店舗情報
	*/
	public function profile($id=null) {
		$this->user_id = $id;
		$array = array(
			$this->getShop('ShopProfile' ,$this->user_id),
		);
// 		$this->loadModel('Image');
// 		$rs = $this->Image->findById($array[0]['image']);
// 		$image_id = isset($rs['Image']['image_id'])?$rs['Image']['image_id']:'';
// 		$array[0]['image'] = $image_id;

		echo json_encode((object)$array[0]);
	}

	/**
	 * 店舗情報
	 */
	public function setting($id=null) {
		$this->user_id = $id;
		$array = array(
			$this->getShop('ShopSetting', $this->user_id),
		);

// 		$this->loadModel('Image');
// 		$rs = $this->Image->findById($array[0]['image']);
// 		$image_id = isset($rs['Image']['image_id'])?$rs['Image']['image_id']:'';
// 		$array[0]['image'] = $image_id;

		echo json_encode((object)$array[0]);
	}

	private function getShop($type, $id) {
// 		$this->loadModel($type);
// 		return json_decode($this->$type->getData($id));

        $this->loadModel('BasicInfo');
        $this->loadModel('Shop');

        $basicInfo = $this->BasicInfo->getInfo($this->user_id, $this->Shop->getInfoName());
        $modified = '';
        $created  = '';
        if ( ! empty($this->_basicInfo)) {
            $modified = $basicInfo['BasicInfo']['modified'];
            $created  = $basicInfo['BasicInfo']['created'];
        }

        $shopInfo = json_decode($this->Shop->getData($id), true);
        $geocode = array('lat' => '', 'lng' => '');
        if (array_key_exists('address', $shopInfo['profile'])) {
            $geocode = $this->geocode($shopInfo['profile']['address']);
        }

        $shop = array(
            'image' => $shopInfo['image'],
        	'profile' => [
	            //'user_id' => $id,
	            'shop_name' => $shopInfo['profile']['shop_name'],
	            'email' => $shopInfo['profile']['email'],
	            'tel1' => $shopInfo['profile']['tel1'],
	            'tel2' => $shopInfo['profile']['tel2'],
	            'tel3' => $shopInfo['profile']['tel3'],
	            'fax1' => $shopInfo['profile']['fax1'],
	            'fax2' => $shopInfo['profile']['fax2'],
	            'fax3' => $shopInfo['profile']['fax3'],
	            'zip_code1' => $shopInfo['profile']['zip_code1'],
	            'zip_code2' => $shopInfo['profile']['zip_code2'],
	            'address' => $shopInfo['profile']['address'],
	            'url' => $shopInfo['profile']['url'],
	            'online_shop' => $shopInfo['profile']['online_shop'],
	            'open_hours' => $shopInfo['profile']['open_hours'],
	            'holiday' => $shopInfo['profile']['holiday'],
        		'pref' => $shopInfo['profile']['pref'],
        		'city' => $shopInfo['profile']['city'],
				'address_opt1' => $shopInfo['profile']['address_opt1'],
        		'address_opt2' => $shopInfo['profile']['address_opt2'],
	            'lat' => $geocode['lat'],
	            'lng' => $geocode['lng'],
	            //'remarks' => '',
	            //'updated_at' => $modified,
	            //'created_at' => $created,
	            //'file_name' => $shopInfo['image'],
	            //'sns' => array(),
        	]
        );
        return $shop;
	}

}


// <?php
// App::uses('AppApiController', 'Controller');
// /**
// * 店舗情報APIのコントローラです。
// * @author    Yoshitaka Kitagawa
// */
// class ShopController extends AppApiController {

//     /**
//     * 前処理
//     */
//     public function beforeFilter() {
//         parent::beforeFilter();
//     }

//     /**
//     * 店舗情報
//     */
//     public function profile($id=null) {
//         $shop = $this->getShop($id);
//         $this->response->body(json_encode($shop));
//         return;
//     }

//     private function getShop($id) {
//         $this->loadModel('BasicInfo');
//         $this->loadModel('Shop');

//         $basicInfo = $this->BasicInfo->getInfo($this->user_id, $this->Shop->getInfoName());
//         $modified = '';
//         $created  = '';
//         if ( ! empty($this->_basicInfo)) {
//             $modified = $basicInfo['BasicInfo']['modified'];
//             $created  = $basicInfo['BasicInfo']['created'];
//         }

//         $shopInfo = json_decode($this->Shop->getData($id), true);

//         $geocode = array('lat' => '', 'lng' => '');
//         if (array_key_exists('address', $shopInfo['profile'])) {
//             $geocode = $this->geocode($shopInfo['profile']['address']);
//         }

//         $shop = array(
//             'user_id' => $id,
//             'shop_name' => $shopInfo['profile']['shop_name'],
//             'email' => $shopInfo['profile']['email'],
//             'tel1' => $shopInfo['profile']['tel1'],
//             'tel2' => $shopInfo['profile']['tel2'],
//             'tel3' => $shopInfo['profile']['tel3'],
//             'fax1' => $shopInfo['profile']['fax1'],
//             'fax2' => $shopInfo['profile']['fax2'],
//             'fax3' => $shopInfo['profile']['fax3'],
//             'zip_code1' => $shopInfo['profile']['zip_code1'],
//             'zip_code2' => $shopInfo['profile']['zip_code2'],
//             'address' => $shopInfo['profile']['address'],
//             'url' => $shopInfo['profile']['url'],
//             'online_shop' => $shopInfo['profile']['online_shop'],
//             'open_hours' => $shopInfo['profile']['open_hours'],
//             'holiday' => $shopInfo['profile']['holiday'],
//             'lat' => $geocode['lat'],
//             'lng' => $geocode['lng'],
//             'remarks' => '',
//             'updated_at' => $modified,
//             'created_at' => $created,
//             'file_name' => $shopInfo['image'],
//             'image_url' => $this->getMediaUrl($shopInfo['image']),
//             'sns' => array(),
//         );
//         return $shop;
//     }

// }
