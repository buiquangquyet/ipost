<?php
App::uses('AppApiController', 'Controller');
/**
* ニュースAPIのコントローラです。
* @author    Yoshitaka Kitagawa
*/
class NewsController extends AppApiController {

	/**
	* 前処理
	*/
	public function beforeFilter() {
		parent::beforeFilter();
		//Configure::write('Config.language', 'vi');
	}

	/**
	* ニュースAPI
	*/
	public function index() {
		$token = $this->request->data['token'];
		$news = $this->getNews($this->user_id, $token);
		echo json_encode($news);
	}

    /**
    * いいね！加算・減算の処理をします。
    */
    public function iine_add() {
        if ($this->request->is('post')) {
            $this->loadModel('Device');
            $this->loadModel('NewsLike');

            $token = $this->request->data['token'];
            $newsId = $this->request->data['news_id'];

            // DEBUG
            // $token = $_GET['token'];
            // $newsId = $_GET['news_id'];
			$userId = $this->request->data['user_id'];
            $deviceInfo = $this->Device->getInfo($userId, $token);

            if (empty($deviceInfo)) {
                return;
            }
            $likeInfo = $this->NewsLike->getInfo($newsId, $deviceInfo['Device']['id']);
            if (empty($likeInfo)) {
                $setItem = array(
                    'news_id' => $newsId,
                    'device_id' => $deviceInfo['Device']['id'],
                    );
                $this->NewsLike->save($setItem);

            } else {
                $this->NewsLike->delete($likeInfo['NewsLike']['id']);
            }
            $this->response->body('OK');
        }
        return;
    }

	/**
	* 配信されたニュースを取得します。
	*/
	private function getNews($id, $token) {
            $this->loadModel('Newsinfo');
            $list = $this->News->getData($id);
            //print_r($list);
            $return = array();
            foreach ($list AS $item){
                $new = 0;
                $iine_flg = 0;
                //Date of when game started
                $starts_on = date("Y/m/d", strtotime($item['News']['created']));
                //Next week's date from start date
                $next_week = strtotime(date("Y/m/d", strtotime($starts_on)) . "+1 week");
                $next_week = date('Y/m/d', $next_week);
                $current = date("Y/m/d");
                if((strtotime($next_week) - strtotime($current)) >= 0){
                    $new = 1;
                }

                $return[] = array(
                	'id' => $item['News']['id'],
                    'user_id' => $item['News']['user_id'],
                    'title' => $item['News']['title'],
                    'body' => $item['News']['body'],
                    'youtube' => $item['News']['youtube'],
                    'image' => $item['News']['image'],
                    'notice' => $item['News']['notice'],
                    'status' => $item['News']['status'],
                	'noticed' => $item['News']['noticed'],
                    'send' => date("Y/m/d", strtotime($item['News']['send'])),
                    'modified' => date("Y/m/d", strtotime($item['News']['modified'])),
                    'created' => date("Y/m/d", strtotime($item['News']['created'])),
                	'new' => $new,
                	'iine_flg' => $this->is_iine($id, $token, $item['News']['id']),
                	'iine_cnt' => $this->iine_cnt($item['News']['id'])
                );
                /* $return[] = array(
                    'user_id' => $item['News']['user_id'],
                    'title' => $item['News']['title'],
                    'body' => $item['News']['body'],
                    'youtube' => $item['News']['youtube'],
                    'file_name' => $item['News']['image'],
                    'notice' => $item['News']['notice'],
                    'notice_status' => $item['News']['status'],
                    'notice_at' => $item['News']['noticed'],
                    'send_at' => date("Y/m/d", strtotime($item['News']['send'])),
                    'updated_at' => date("Y/m/d", strtotime($item['News']['modified'])),
                    'created_at' => date("Y/m/d", strtotime($item['News']['created'])),
                    'new' => $new,
                    'iine_flg' => $iine_flg
                ); */
            }
            return $return;
	}

	private function is_iine($user_id, $token, $news_id)
	{
		if($token) {
			$this->loadModel('Device');
			// TokenID取得
			$device_model = $this->Device->getInfo($user_id, $token);
			$device_id = $device_model['Device']['id'];
			if (is_null($device_model))
			{
				return 0;
			}

			$this->loadModel('NewsLike');
			$iine_model = $this->NewsLike->getInfo($news_id, $device_id);
			if (!isset($iine_model['NewsLike']))
			{
				return 0;
			}
			return 1;
		}
		return 0;
	}

	private function iine_cnt($news_id)
	{
		$this->loadModel('NewsLike');
		$iine_model = $this->NewsLike->likeCount($news_id);
		if ($iine_model)
		{
			return $iine_model;
		}
		return 0;
	}
}

// <?php
// App::uses('AppApiController', 'Controller');
// /**
// * ニュースAPIのコントローラです。
// * @author    Yoshitaka Kitagawa
// */
// class NewsController extends AppApiController {

//     /**
//     * 前処理
//     */
//     public function beforeFilter() {
//         parent::beforeFilter();
//     }

//     /**
//     * ニュースAPI
//     */
//     public function index() {
//         // デバイス情報の取得
//         $token = null;
//         $deviceId = null;
//         if ($this->request->is('post')) {
//             $this->loadModel('Device');
//             $token = $this->request->data['token'];

//             // DEBUG
//             // $token = $_GET['token'];
//             // $newsId = $_GET['news_id'];

//             $deviceInfo = $this->Device->getInfo($this->user_id, $token);
//             $deviceId = $deviceInfo['Device']['id'];
//         }
//         $this->loadModel('NewsLike');

//         // ニュース情報の取得
//         $news = array();
//         $newsInfo = $this->getNews($this->user_id);
//         foreach ($newsInfo as $key => $info) {
//             // ニュースの形式を整えています。
//             $info['News']['new'] = $this->isWeek($info['News']['send']) ? 1 : 0;
//             $info['News']['iine_flg'] = $this->NewsLike->isLike($info['News']['id'], $deviceId) ? 1 : 0;
//             $info['News']['send_at'] = date('Y/m/d H時i分', strtotime($info['News']['send']));
//             $info['News']['updated_at'] = date('Y/m/d H時i分', strtotime($info['News']['modified']));
//             $info['News']['created_at'] = date('Y/m/d H時i分', strtotime($info['News']['created']));

//             $info['News']['image_url'] = $this->getImageUrl($info['News']['image']);

//             unset($info['News']['send']);
//             unset($info['News']['modified']);
//             unset($info['News']['created']);
//             $news[] = $info['News'];
//         }
//         $this->response->body(json_encode($news));
//         return;
//     }

//     /**
//     * いいね！加算・減算の処理をします。
//     */
//     public function iine_add() {
//         if ($this->request->is('post')) {
//             $this->loadModel('Device');
//             $this->loadModel('NewsLike');

//             $token = $this->request->data['token'];
//             $newsId = $this->request->data['news_id'];

//             // DEBUG
//             // $token = $_GET['token'];
//             // $newsId = $_GET['news_id'];

//             $deviceInfo = $this->Device->getInfo($this->user_id, $token);
//             if (empty($deviceInfo)) {
//                 return;
//             }
//             $likeInfo = $this->NewsLike->getInfo($newsId, $deviceInfo['Device']['id']);
//             if (empty($likeInfo)) {
//                 $setItem = array(
//                     'news_id' => $newsId,
//                     'device_id' => $deviceInfo['Device']['id'],
//                     );
//                 $this->NewsLike->save($setItem);
//             } else {
//                 $this->NewsLike->delete($likeInfo['NewsLike']['id']);
//             }
//             $this->response->body('OK');
//         }
//         return;
//     }

//     /**
//     * 配信されたニュースを取得します。
//     */
//     private function getNews($id) {
//         return $this->News->getData($id);
//     }

//     /**
//     * ニュースが1週間以内か判断します。
//     * @param datetime $datetime
//     */
//     private function isWeek($datetime) {
//         $str_datetime = strtotime($datetime);
//         $getday = strtotime('-1 week');
//         if ($str_datetime > $getday) {
//             return true;
//         }
//         return false;
//     }

// }
