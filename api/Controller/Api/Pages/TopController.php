<?php
App::uses('AppApiController', 'Controller');
/**
* トップAPIのコントローラです。
* @author    Yoshitaka Kitagawa
*/
class TopController extends AppApiController {

    private $_blockKey;  // キーリスト
    private $_blockInfo; // ブロック情報リスト
    private $_basicInfo; // ブロック情報リスト

    /**
    * 前処理
    */
    public function beforeFilter() {
        parent::beforeFilter();
        //Configure::write('Config.language', 'vi');
        $this->loadModel('Block');
        $this->loadModel('Shop');
        $this->loadModel('BasicInfo');
    }

    /**
    * トップAPI
    */
    public function index() {

        $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' get user_id => ' . $this->user_id, LOG_DEBUG);

        // ユーザーIDの指定がされていない。
        if (empty($this->user_id)) {
            $this->response->body(json_encode(array()));
            return;
        }

        $res = array(
            'block' => $this->getBlocks($this->user_id),
            'list' => $this->getBlockLists($this->user_id),
        );

        $res = $this->checkRes($res);

        $this->response->body(json_encode($res));
        return;
    }

    /**
    * ブロックの状態を取得します。
    */
    private function getBlocks() {
        // 更新日時と、登録日時を取得します。
        $this->_basicInfo = $this->BasicInfo->getInfo($this->user_id, $this->Block->getInfoName());
        $modified = '';
        $created  = '';
        if ( ! empty($this->_basicInfo)) {
            $modified = $this->_basicInfo['BasicInfo']['modified'];
            $created  = $this->_basicInfo['BasicInfo']['created'];
        }

        // ブロックリストの情報を取得します。
        $this->_blockInfo = $this->Block->getData($this->user_id);

        if ( ! array_key_exists(Block::BLOCK_NAME_MARGIN, $this->_blockInfo)) {
            $margin = 10;

        } else {
            // マージンを控えます。
            $margin = $this->_blockInfo[Block::BLOCK_NAME_MARGIN];
            $margin = $margin['margin'];
            // マージンは、ブロックリストには使わないのでここで削除しておきます。
            unset($this->_blockInfo[Block::BLOCK_NAME_MARGIN]);
        }

        // TODO: CMSブロックの無効化を行っています。
        if (array_key_exists(Block::BLOCK_NAME_CMS, $this->_blockInfo)) {
            unset($this->_blockInfo[Block::BLOCK_NAME_CMS]);
        }

        // ブロックリストの情報を整形します。
        $block = array();
        $this->_blockKey = array_keys($this->_blockInfo);
        $count = count($this->_blockKey);
        for ($i=0; $i<$count; $i++) {
            $b = $this->_blockInfo[$this->_blockKey[$i]];
            // キー「del」が「1」だったらスキップ
            if ( ! empty($b['del'])) {
                unset($this->_blockKey[$i]);
                continue;
            }
            $key_name = $this->_blockKey[$i];
            switch ($key_name) {
                case Block::BLOCK_NAME_IMAGE:
                    $key_name = Block::BLOCK_NAME_TOP;
                    break;
                case Block::BLOCK_NAME_MAP:
                    $key_name = Block::BLOCK_NAME_GPS;
                    break;
                case Block::BLOCK_NAME_WEBVIEW:
                    $key_name = Block::BLOCK_NAME_WEB;
                    break;
            }

            $block[] = array(
                        'user_id' => $this->user_id,
                        'block_key' => $key_name,
                        'block_name' => '',
                        'margin' => $margin,
                        'position' => ($i+1),
                        'del' => $b['del'],
                        'updated_at' => date('Y/m/d H:i', strtotime($modified)),
                        'created_at' => date('Y/m/d H:i', strtotime($created)),
                    );
        }

        // $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' ' . print_r($block, true), LOG_DEBUG);
        return $block;
    }

    /**
    * リスト情報を取得します。
    */
    private function getBlockLists() {
        $list = array();
        foreach ($this->_blockKey as $key_name) {
             switch ($key_name) {
                case Block::BLOCK_NAME_IMAGE:
                    $list[Block::BLOCK_NAME_TOP] = $this->getImage();
                    break;

                case Block::BLOCK_NAME_TOPIC:
                    $list[$key_name] = $this->getTopic();
                    break;

                case Block::BLOCK_NAME_NEWS:
                    $list[$key_name] = $this->getNews();
                    break;

                case Block::BLOCK_NAME_MENU:
                    $list[$key_name] = $this->getMenu();
                    break;

                case Block::BLOCK_NAME_COUPON:
                    $list[$key_name] = $this->getCoupon();
                    break;

                case Block::BLOCK_NAME_MAP:
                    $list[Block::BLOCK_NAME_GPS] = $this->getMap();
                    break;

                case Block::BLOCK_NAME_TEL:
                    $list[$key_name] = $this->getTel();
                    break;

                case Block::BLOCK_NAME_SNS:
                    $list[$key_name] = $this->getSns();
                    break;

                case Block::BLOCK_NAME_CMS:
                    $list[$key_name] = $this->getCms();
                    break;

                case Block::BLOCK_NAME_WEBVIEW:
                    $list[Block::BLOCK_NAME_WEB] = $this->getWebview();
                    break;
            }
        }
        return $list;
    }

    /**
    * イメージリストの取得
    */
    private function getImage() {
        $imageInfo = $this->_blockInfo[Block::BLOCK_NAME_IMAGE];
        foreach ($imageInfo['images'] as $key => $info) {
            $imageInfo['images'][$key]['image_url'] = '';

            if (empty($info['image'])) {
                unset($imageInfo['images'][$key]);

            } else {
                $imageInfo['images'][$key]['image_url'] = $this->getImageUrl($info['image']);
            }
        }
        return $imageInfo['images'];
    }

    /**
    * トピックメッセージの取得
    */
    private function getTopic() {
        $topicInfo = $this->_blockInfo[Block::BLOCK_NAME_TOPIC];
        $modified = '';
        $created  = '';
        if ( ! empty($this->_basicInfo)) {
            $modified = $this->_basicInfo['BasicInfo']['modified'];
            $created  = $this->_basicInfo['BasicInfo']['created'];
        }
        $topic = array(
            'user_id' => $this->user_id,
            'message' => $topicInfo['message'],
            'updated_at' => strtotime($modified),
            'created_at' => strtotime($created),
        );
        return $topic;
    }

    /**
    * ニュースブロックの取得
    */
    private function getNews() {
        $this->loadModel('News');
        $news = array();
        $newsInfo = $this->News->getData($this->user_id, 5);
        foreach ($newsInfo as $key => $info) {
            $news[] = array(
            	'id' => $info['News']['id'], // Hss add
                'user_id' => $this->user_id,
                'parent_id' => '0',
                'title' => $info['News']['title'],
                'body' => $info['News']['body'],
                'youtube' => $info['News']['youtube'],
                'file_type' => '1',
                'file_name' => $info['News']['image'],
                'image_url' => $this->getImageUrl($info['News']['image']),
                'tmp_file_name' => '',
                'notice' => $info['News']['noticed'],
                'notice_status' => $info['News']['status'],
                'notice_type' => '0',
                'iine_cnt' => '0',
                'comment_cnt' => '0',
                'notice_at' => $info['News']['noticed'],
                'send_at' => date('Y/m/d H:i', strtotime($info['News']['send'])),
                'updated_at' => date('Y/m/d H:i', strtotime($info['News']['modified'])),
                'created_at' => date('Y/m/d H:i', strtotime($info['News']['created'])),
                'new' => '0'
            );
            ;
        }
        return $news;
    }

    /**
    * メニューブロックの取得
    */
    private function getMenu() {
        $this->loadModel('MenuItem');
        $menu = array();
        $menuInfo = $this->_blockInfo[Block::BLOCK_NAME_MENU];
        $this->loadModel('MenuConfig');
        $menuMode = $this->MenuConfig->getInfo($this->user_id); // Hss add
        $menu_mode = $menuMode['MenuConfig']['mode'];
        foreach ($menuInfo['menus'] as $key => $info) {
            if (empty($info)) {
                continue;
            }
            $itemInfo = $this->MenuItem->getInfo($info);
			if($menu_mode == 1) {
				if($itemInfo['MenuItem']['parent_id']==0) { // Hss add
					$menu[] = array(
							'id' => $itemInfo['MenuItem']['id'], // Hss add
							'user_id' => $this->user_id,
							'parent_id' => $itemInfo['MenuItem']['parent_id'],
							'title' => $itemInfo['MenuItem']['title'],
							'sub_title' => $itemInfo['MenuItem']['sub_title'],
							'description' => $itemInfo['MenuItem']['description'],
							'url' => $itemInfo['MenuItem']['url'],
							'file_type' => $itemInfo['MenuItem']['file_type'],
							'image_id' => $itemInfo['MenuItem']['image_id'],
							'image_url' => $this->getImageUrl($itemInfo['MenuItem']['image_id']),
							'tmp_file_name' => '',
							'price' => $itemInfo['MenuItem']['price'],
							'tax' => $itemInfo['MenuItem']['tax'],
							'position' => $itemInfo['MenuItem']['position'],
							'enable' => $itemInfo['MenuItem']['enable'],
							'currency' => $this->getCurrency($itemInfo['MenuItem']['currency']),
							'updated_at' => date('Y/m/d', strtotime($itemInfo['MenuItem']['modified'])),
							'created_at' => date('Y/m/d', strtotime($itemInfo['MenuItem']['created'])),
					);
				}
			} else {
				if($itemInfo['MenuItem']['parent_id'] != 0) { // Hss add
					$menu[] = array(
							'id' => $itemInfo['MenuItem']['id'],
							'user_id' => $this->user_id,
							'parent_id' => $itemInfo['MenuItem']['parent_id'],
							'title' => $itemInfo['MenuItem']['title'],
							'sub_title' => $itemInfo['MenuItem']['sub_title'],
							'description' => $itemInfo['MenuItem']['description'],
							'url' => $itemInfo['MenuItem']['url'],
							'file_type' => $itemInfo['MenuItem']['file_type'],
							'image_id' => $itemInfo['MenuItem']['image_id'],
							'image_url' => $this->getImageUrl($itemInfo['MenuItem']['image_id']),
							'tmp_file_name' => '',
							'price' => $itemInfo['MenuItem']['price'],
							'tax' => $itemInfo['MenuItem']['tax'],
							'position' => $itemInfo['MenuItem']['position'],
							'enable' => $itemInfo['MenuItem']['enable'],
							'currency' => $this->getCurrency($itemInfo['MenuItem']['currency']),
							'updated_at' => date('Y/m/d', strtotime($itemInfo['MenuItem']['modified'])),
							'created_at' => date('Y/m/d', strtotime($itemInfo['MenuItem']['created'])),
					);
				}
			}
            /* $menu[] = array(
            	'id' => $itemInfo['MenuItem']['id'],
                'user_id' => $this->user_id,
                'parent_id' => $itemInfo['MenuItem']['parent_id'],
                'title' => $itemInfo['MenuItem']['title'],
                'sub_title' => $itemInfo['MenuItem']['sub_title'],
                'description' => $itemInfo['MenuItem']['description'],
                'url' => $itemInfo['MenuItem']['url'],
                'file_type' => $itemInfo['MenuItem']['file_type'],
                'image_id' => $itemInfo['MenuItem']['image_id'],
                'image_url' => $this->getImageUrl($itemInfo['MenuItem']['image_id']),
                'tmp_file_name' => '',
                'price' => $itemInfo['MenuItem']['price'],
                'tax' => $itemInfo['MenuItem']['tax'],
                'position' => $itemInfo['MenuItem']['position'],
                'enable' => $itemInfo['MenuItem']['enable'],
            	'currency' => $this->getCurrency($itemInfo['MenuItem']['currency']),
                'updated_at' => date('Y/m/d', strtotime($itemInfo['MenuItem']['modified'])),
                'created_at' => date('Y/m/d', strtotime($itemInfo['MenuItem']['created'])),
            ); */
        }
        return $menu;
    }

    /**
    * クーポンブロックの取得
    */
    private function getCoupon() {
        $coupon = array();
        $modified = '';
        $created  = '';
        if ( ! empty($this->_basicInfo)) {
            $modified = $this->_basicInfo['BasicInfo']['modified'];
            $created  = $this->_basicInfo['BasicInfo']['created'];
        }
        $this->loadModel('Coupon');
        $couponInfo = $this->Coupon->getData($this->user_id);
        foreach ($couponInfo as $key => $info) {
            if (empty($info['enable_flg'])) {
                continue;
            }

            $coupon[] = array(
                'user_id' => $this->user_id,
                'title' => $info['title'],
                'discount' => $info['discount'],
                'discount_type' => '0',
                'policy' => $info['policy'],
                'file_name' => $info['image'],
                'image_url' => $this->getImageUrl($info['image']),
                'tmp_file_name' => '',
                'use_count' => '0',
                'position' => ($key + 1),
                'coupon_type' => $info['coupon_type'],
                'display_days' => $info['display_days'],
                'enable_flg' => $info['enable_flg'],
                'term_flg' => $info['term_flg'],
                'start_datetime' => $info['start_datetime'],
                'end_datetime' => $info['end_datetime'],
                'updated_at' => $modified,
                'created_at' => $created,
                'new' => '0',
            );
        }
        return $coupon;
    }

    /**
    * マップブロックの取得
    */
    private function getMap() {
        $geocode = array('lat' => '', 'lng' => '');
        $shopInfo = json_decode($this->Shop->getData($this->user_id), true);
        if ( ! array_key_exists('address', $shopInfo['profile'])) {
            return $geocode;
        }
        $geocode = $this->geocode($shopInfo['profile']['address']);
        // $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' address => ' . $shopInfo['profile']['address'], LOG_DEBUG);
        // $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' geocode => ' . print_r($geocode, true), LOG_DEBUG);

        return $geocode;
    }

    /**
    * 電話ブロックの取得
    */
    private function getTel() {
        $tel = '';
        $shopInfo = json_decode($this->Shop->getData($this->user_id), true);
        if (array_key_exists('tel1', $shopInfo['profile']) &&
            array_key_exists('tel2', $shopInfo['profile']) &&
            array_key_exists('tel3', $shopInfo['profile'])) {
            $tel = $shopInfo['profile']['tel1'] . '-' . $shopInfo['profile']['tel2'] . '-' . $shopInfo['profile']['tel3'];
        }
        $tel = array(
            'tel' => $tel,
            'email' => $shopInfo['profile']['email'],
        );
        return $tel;
    }

    /**
    * SNSブロックの取得
    */
    private function getSns() {
        $snsInfo = $this->_blockInfo[Block::BLOCK_NAME_SNS];
        $sns = array();
        foreach ($snsInfo['snsinfo'] as $key => $info) {
            // SNSの値が入力されていなかった場合はスキップ
            if (empty($info)) {
                continue;
            }
            $sns[] = array(
                'user_id' => $this->user_id,
                'sns_id' => str_replace('sns_', '', $key),
                'value' => $info,
                // 'position' => '1',
                'updated_at' => date('Y/m/d H:i', strtotime($this->_basicInfo['BasicInfo']['modified'])),
                'created_at' => date('Y/m/d H:i', strtotime($this->_basicInfo['BasicInfo']['created'])),

            );
        }
        return $sns;
    }

    /**
    * HTMLブロックの情報を取得します。
    */
    private function getCms() {
        return $this->_blockInfo[Block::BLOCK_NAME_CMS];
    }

    /**
    * ウェブビューブロックの情報を取得します。
    */
    private function getWebview() {
        $modified = '';
        $created  = '';
        if ( ! empty($this->_basicInfo)) {
            $modified = $this->_basicInfo['BasicInfo']['modified'];
            $created  = $this->_basicInfo['BasicInfo']['created'];
        }
        $webInfo = $this->_blockInfo[Block::BLOCK_NAME_WEBVIEW];
        $web = array(
            'user_id' => $this->user_id,
            'url' => $webInfo['url'],
            'height' => '240',
            'scroll_enable' => '1',
            'updated_at' => strtotime($modified),
            'created_at' => strtotime($created),
        );
        return $web;
    }

    /**
    * リストに値がないブロックを削除しています。
    */
    private function checkRes($res) {
        $i = 0;
        foreach ($res['list'] as $key => $info) {
            if (empty($info)) {
                unset($res['list'][$key]);
                unset($res['block'][$i]);
            }

            // リストに値があるか確認
            switch ($key) {
                case Block::BLOCK_NAME_TOPIC:
                    // URLが指定されていなかった場合は、削除
                    if (empty($info['message'])) {
                        unset($res['list'][$key]);
                        unset($res['block'][$i]);
                    }
                    break;

                case Block::BLOCK_NAME_TEL:
                    // 電話番号と、メールアドレスが両方なかった場合は、削除
                    if (empty($info['tel']) && empty($info['email'])) {
                        unset($res['list'][$key]);
                        unset($res['block'][$i]);
                    }
                    break;

                case Block::BLOCK_NAME_GPS:
                    // 電話番号と、メールアドレスが両方なかった場合は、削除
                    if (empty($info['lat']) || empty($info['lng'])) {
                        unset($res['list'][$key]);
                        unset($res['block'][$i]);
                    }
                    break;

                case Block::BLOCK_NAME_WEB:
                    // URLが指定されていなかった場合は、削除
                    if (empty($info['url'])) {
                        unset($res['list'][$key]);
                        unset($res['block'][$i]);
                    }
                    break;

            }

            $i ++;
        }
        $block = array();
        foreach ($res['block'] as $key => $info) {
            $block[] = $info;
        }
        $res['block'] = $block;
        return $res;
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
