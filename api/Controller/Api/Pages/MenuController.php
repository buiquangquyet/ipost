<?php

App::uses('AppApiController', 'Controller');

/**
 * メニューAPIのコントローラです。
 * @author    Yoshitaka Kitagawa
 */
class MenuController extends AppApiController {

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
        $parent_id = $this->request->param('parent_id');
        $this->loadModel('MenuConfig');
        $data = array();
        $simpleConfig = $this->MenuConfig->getInfo($this->user_id);
        if ($simpleConfig['MenuConfig']['mode'] == 1) {
            $data['menu_top'] = $this->getItemsSimple($this->user_id);//$this->getItems($this->user_id);
            $data['list'] = $this->getCategory($this->user_id, $parent_id);
        } else {
            $data['menu_top'] = $this->getItemsSimple($this->user_id);
            $data['list'] = $this->getCategorySimple($this->user_id, $parent_id);
        }

        echo json_encode($data);
    }

    /**
     * カテゴリーの取得
     */
    private function getCategorySimple($user_id, $catId) {
        $this->loadModel('MenuCategory');
        $this->loadModel('MenuConfig');
        $simpleConfig = $this->MenuConfig->getInfo($user_id);
        if($catId == 0 && $simpleConfig['MenuConfig']['mode'] == 1) {
        	return $this->getItemsCategory($user_id, 0);
        }
        if($catId) {
        	return $this->getItemsCategory($user_id, $catId);
        } else {
        	$listCat = $this->MenuCategory->getCategory($user_id, $catId);
        }
        $catData = array();
        if (count($listCat) > 0) {
        	foreach($listCat as $lstCat) {
        		$catData[] = array(
            		'id' => $lstCat['MenuCategory']['id'],
	                'title' => $lstCat['MenuCategory']['title'],
	                'sub_title' => $lstCat['MenuCategory']['sub_title'],
	                'image_id' => $lstCat['MenuCategory']['image_id'],
	                'position' => $lstCat['MenuCategory']['position'],
	                'enable' => $lstCat['MenuCategory']['enable'],
	                'modified' => date("Y/m/d", strtotime($lstCat['MenuCategory']['modified'])),
	                'created' => date("Y/m/d", strtotime($lstCat['MenuCategory']['created'])),
	                'simple' => 2
	            );
	            /* $catData[] = array(
            		'id' => $lstCat['MenuCategory']['id'],
	                'title' => $lstCat['MenuCategory']['title'],
	                'sub_title' => $lstCat['MenuCategory']['sub_title'],
	                'file_name' => $lstCat['MenuCategory']['image_id'],
	                'position' => $lstCat['MenuCategory']['position'],
	                'enable' => $lstCat['MenuCategory']['enable'],
	                'modified' => date("Y/m/d", strtotime($lstCat['MenuCategory']['modified'])),
	                'created' => date("Y/m/d", strtotime($lstCat['MenuCategory']['created'])),
	                'simple' => 2
	            ); */
        	}
        }
        return $catData;
    }

    private function getCategory($user_id, $parent_id) {
        $this->loadModel('MenuItem');
        $lstCat = $this->MenuItem->getItems($user_id, $parent_id);
        $catData = array();
        if (count($lstCat) > 0) {
            foreach ($lstCat AS $item) {
            	if(!$item['MenuItem']['parent_id']) { // Hss add
	                $catData[] = array(
	                	'id' => $item['MenuItem']['id'],
	                    'parent_id' => $item['MenuItem']['parent_id'],
	                    'title' => $item['MenuItem']['title'],
	                    'sub_title' => $item['MenuItem']['sub_title'],
	                    'description' => $item['MenuItem']['description'],
	                    'url' => $item['MenuItem']['url'],
	                    'file_type' => $item['MenuItem']['file_type'],
	                    'image_id' => $item['MenuItem']['image_id'],
	                    'price' => $item['MenuItem']['price'],
	                    'tax' => $item['MenuItem']['tax'],
	                    'position' => $item['MenuItem']['position'],
	                    'enable' => $item['MenuItem']['enable'],
	                	'currency' => $this->getCurrency($item['MenuItem']['currency']),
	                    'modified' => date("Y/m/d", strtotime($item['MenuItem']['modified'])),
	                    'created' => date("Y/m/d", strtotime($item['MenuItem']['created'])),
	                	'simple' => 1
	                );
            	}
            }
        }
        return $catData;
    }

    private function getItemsCategory($user_id, $parent_id) { // Hss add
    	$this->loadModel('MenuItem');
    	$lstCat = $this->MenuItem->getItems($user_id, $parent_id);
    	$catData = array();
    	if (count($lstCat) > 0) {
    		foreach ($lstCat AS $item) {
    			if($item['MenuItem']['parent_id']) { // Hss add
    				$catData[] = array(
    						'id' => $item['MenuItem']['id'],
    						'parent_id' => $item['MenuItem']['parent_id'],
    						'title' => $item['MenuItem']['title'],
    						'sub_title' => $item['MenuItem']['sub_title'],
    						'description' => $item['MenuItem']['description'],
    						'url' => $item['MenuItem']['url'],
    						'file_type' => $item['MenuItem']['file_type'],
    						'image_id' => $item['MenuItem']['image_id'],
    						'price' => $item['MenuItem']['price'],
    						'tax' => $item['MenuItem']['tax'],
    						'position' => $item['MenuItem']['position'],
    						'enable' => $item['MenuItem']['enable'],
    						'currency' => $this->getCurrency($item['MenuItem']['currency']),
    						'modified' => date("Y/m/d", strtotime($item['MenuItem']['modified'])),
    						'created' => date("Y/m/d", strtotime($item['MenuItem']['created'])),
    						'simple' => 1
    				);
    			} elseif($item['MenuItem']['parent_id']== 0 && $parent_id == 0) {
    				$catData[] = array(
    						'id' => $item['MenuItem']['id'],
    						'parent_id' => $item['MenuItem']['parent_id'],
    						'title' => $item['MenuItem']['title'],
    						'sub_title' => $item['MenuItem']['sub_title'],
    						'description' => $item['MenuItem']['description'],
    						'url' => $item['MenuItem']['url'],
    						'file_type' => $item['MenuItem']['file_type'],
    						'image_id' => $item['MenuItem']['image_id'],
    						'price' => $item['MenuItem']['price'],
    						'tax' => $item['MenuItem']['tax'],
    						'position' => $item['MenuItem']['position'],
    						'enable' => $item['MenuItem']['enable'],
    						'currency' => $this->getCurrency($item['MenuItem']['currency']),
    						'modified' => date("Y/m/d", strtotime($item['MenuItem']['modified'])),
    						'created' => date("Y/m/d", strtotime($item['MenuItem']['created'])),
    						'simple' => 1
    				);
    			}
    		}
    	}
    	return $catData;
    }

    /**
     * アイテムの取得
     */
    private function getItemsSimple($user_id) {
        $this->loadModel('MenuTopItem');
        $lst = $this->MenuTopItem->getItems($user_id);
        $menuTop = array();
        if (count($lst) > 0) {
            $menuTop = array(
                'image_id' => $lst['MenuTopItem']['image_id'],
                'modified' => date("Y/m/d", strtotime($lst['MenuTopItem']['modified'])),
                'created' => date("Y/m/d", strtotime($lst['MenuTopItem']['created'])),
            );
        }
        return $menuTop;
    }

    private function getItems($user_id) {
        $this->loadModel('MenuCategory');
        $list = $this->MenuCategory->getItems($user_id);
        $menuTop = array();
        if (count($list) > 0) {
        	foreach ($list as $lst) {
	            $menuTop[] = array(
	                'title' => $lst['MenuCategory']['title'],
	                'sub_title' => $lst['MenuCategory']['sub_title'],
	                'image_id' => $lst['MenuCategory']['image_id'],
	                'position' => $lst['MenuCategory']['position'],
	                'enable' => $lst['MenuCategory']['enable'],
	                'modified' => date("Y/m/d", strtotime($lst['MenuCategory']['modified'])),
	                'created' => date("Y/m/d", strtotime($lst['MenuCategory']['created'])),
	            );
        	}
        }
        return $menuTop;
    }

    private function getCurrency($currency)
    {
    	switch ($currency) {
    		case 'JPY':
    			return '¥';
    			break;
    		case 'USD':
    			return '$';
    			break;
    		case 'VND':
				return 'VND';//'₫';
				break;
    		default:
    			return '$';
    	}
    }

}

// <?php
// App::uses('AppApiController', 'Controller');
// /**
// * メニューAPIのコントローラです。
// * @author    Yoshitaka Kitagawa
// */
// class MenuController extends AppApiController {

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
//         $this->loadModel('MenuConfig');
//         $confInfo = $this->MenuConfig->getInfo($this->user_id);
//         if (empty($confInfo)) {
//             return;
//         }
//         if ($confInfo['MenuConfig']['use_flg'] == MenuConfig::MENU_USE_OFF) {
//             return;
//         }

//         $parent_id = null;
//         if ( ! empty($this->request->params['parent_id'])) {
//             $parent_id = $this->request->params['parent_id'];
//         }

//         $menu = array('menu_top' => array(),'list' => array());
//         switch ($confInfo['MenuConfig']['mode']) {
//             case MenuConfig::MENU_MODE_EASY:
//                 // かんたんモード
//                 $menu['menu_top'] = $this->getTopImage($this->user_id);
//                 $menu['list'] = $this->getItem($this->user_id, null);
//                 break;

//             case MenuConfig::MENU_MODE_ADVANCE:
//                 // カスタマイズモード
//                 if (empty($parent_id)) {
//                     // カテゴリー一覧
//                     $menu['menu_top'] = $this->getTopImage($this->user_id);
//                     $menu['list'] = $this->getCategory($this->user_id);

//                 } else {
//                     // アイテム一覧
//                     $menu['menu_top'] = $this->getTopImage($this->user_id);
//                     $menu['list'] = $this->getItem($this->user_id, $parent_id);
//                 }
//                 break;
//         }

//         $this->response->body(json_encode($menu));
//         return;
//     }

//     /**
//     * メニュートップ画像
//     */
//     private function getTopImage($userId) {
//         $this->loadModel('MenuTopItem');
//         $topInfo = $this->MenuTopItem->getItems($userId);
//         $topInfo['MenuTopItem']['image_url'] = $this->getImageUrl($topInfo['MenuTopItem']['image_id']);
//         return $topInfo['MenuTopItem'];
//     }

//     /**
//     * カテゴリーの取得
//     */
//     private function getCategory($userId) {
//         $this->loadModel('MenuCategory');
//         $cate = array();
//         $cateInfo = $this->MenuCategory->getItems($userId);
//         foreach ($cateInfo as $key => $info) {
//             $info['MenuCategory']['image_url'] = $this->getImageUrl($info['MenuCategory']['image_id']);
//             $cate[] = $info['MenuCategory'];
//         }
//         return $cate;
//     }

//     /**
//     * アイテムの取得
//     */
//     private function getItem($userId, $parentId) {
//         $this->loadModel('MenuItem');
//         $item = array();
//         $itemInfo = $this->MenuItem->getItems($userId, $parentId);
//         foreach ($itemInfo as $key => $info) {
//             $info['MenuItem']['image_url'] = $this->getImageUrl($info['MenuItem']['image_id']);
//             $item[] = $info['MenuItem'];
//         }
//         return $item;
//     }

// }
