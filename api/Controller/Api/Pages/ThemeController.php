<?php
App::uses('AppApiController', 'Controller');
/**
* テーマ情報APIのコントローラです。
* @author    Yoshitaka Kitagawa
*/
class ThemeController extends AppApiController {

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
		$array = array(
			'header' => $this->getHeader($this->user_id),
			'background' => $this->getBackground($this->user_id),  // return for new api
		);
		echo json_encode($array);
	}

	/**
	* ヘッダー情報の取得
	*/
	private function getHeader($id) {
		$this->loadModel('Header');
		$data = json_decode($this->Header->getData($id));
// 		return $data->header; // return for new api
		$colorCode = Configure::read('ColorCode');

		// テーマ設定してる？？
		if (!empty($data->header->color)) {
			$color = $data->header->color;
			$arrayColor = explode('_', $color);
			$prefix_color = $arrayColor[0];
			$subfix_color = $arrayColor[1];
			$color = $colorCode[$subfix_color];
			//$color = $colorCode[$subfix_color][$prefix_color];
		} else {
			$color = $this->defaultHeader();
		}

// 		$this->loadModel('Image');
// 		$rs = $this->Image->findById($data->header->image);
// 		$image_id = isset($rs['Image']['image_id'])?$rs['Image']['image_id']:'';
		$image_id = $data->header->image;

		return ['image' => $image_id, 'color' => $color];
	}

	/**
	* 背景情報の取得
	*/
	private function getBackground($id) {
		$this->loadModel('Background');
		$data = json_decode($this->Background->getData($id));
// 		return $data->background; // return for new api

		$colorCode = Configure::read('ColorCode');

		// テーマ設定してる？？
		if ( ! empty($data->background->color)) {
			$color = $data->background->color;
			$arrayColor = explode('_', $color);
			$prefix_color = $arrayColor[0];
			$subfix_color = $arrayColor[1];
			$color = $colorCode[$subfix_color];
			//$color = $colorCode[$subfix_color][$prefix_color];
		} else {
			$color = $this->defaultBackground();
		}
// 		return $color;
// 		$this->loadModel('Image');
// 		$rs = $this->Image->findById($data->background->image);
// 		$image_id = isset($rs['Image']['image_id'])?$rs['Image']['image_id']:'';
		$image_id = $data->background->image;

		return ['image' => $image_id, 'color' => $color];
	}

	/**
	* 設定値がなかった場合のデフォ値
	*/
	private function defaultHeader() {
		$colorCode = Configure::read('ColorCode');
		return $colorCode[DEFAULT_THEME_HEADER];
	}

	private function defaultBackground() {
		$colorCode = Configure::read('ColorCode');
		return $colorCode[DEFAULT_THEME_BACKGROUND];
	}

}

// <?php
// App::uses('AppApiController', 'Controller');
// /**
// * テーマ情報APIのコントローラです。
// * @author    Yoshitaka Kitagawa
// */
// class ThemeController extends AppApiController {

//     const COLOR_TYPE_SOLID = 1;
//     const COLOR_TYPE_GRADATION = 2;

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
//         $array = array(
//             'header' => $this->getHeader($this->user_id),
//             'footer' => array(),
//             'background' => $this->getBackground($this->user_id),
//         );
//         $this->response->body(json_encode($array));
//         return;
//     }

//     /**
//     * ヘッダー情報の取得
//     */
//     private function getHeader($id) {
//         $this->loadModel('Header');
//         $this->loadModel('HeaderImage');

//         $headerInfo = json_decode($this->Header->getData($id), true);
//         $colorCode = Configure::read('ColorCode');

//         // テーマ設定してる？？
//         if ( ! empty($headerInfo['header']['color'])) {
//             // 色情報の取得
//             $color = $colorCode[substr($headerInfo['header']['color'], 2)];
//             $typeInitial = substr($headerInfo['header']['color'], 0, 1);
//             $color['type'] = $typeInitial == 'c' ? self::COLOR_TYPE_SOLID : self::COLOR_TYPE_GRADATION;

//             // 画像情報の取得
//             $color['image_url'] = $this->getMediaUrl($headerInfo['header']['image']);
//         } else {
//             $color = $this->defaultHeader();
//         }
//         return $color;
//     }

//     /**
//     * 背景情報の取得
//     */
//     private function getBackground($id) {
//         $this->loadModel('Background');
//         $this->loadModel('BackgroundImage');

//         $backInfo = json_decode($this->Background->getData($id), true);
//         $colorCode = Configure::read('ColorCode');

//         // テーマ設定してる？？
//         if ( ! empty($backInfo['background']['color'])) {
//             // 色情報の取得
//             $color = $colorCode[substr($backInfo['background']['color'], 2)];
//             $typeInitial = substr($backInfo['background']['color'], 0, 1);
//             $color['type'] = $typeInitial == 'c' ? self::COLOR_TYPE_SOLID : self::COLOR_TYPE_GRADATION;

//             // 画像情報の取得
//             $color['image_url'] = $this->getMediaUrl($backInfo['background']['image']);
//         } else {
//             $color = $this->defaultBackground();
//         }
//         return $color;
//     }

//     /**
//     * 設定値がなかった場合のデフォ値
//     */
//     private function defaultHeader() {
//         $conf = Configure::read('ColorCode');
//         $color = $conf[DEFAULT_THEME_HEADER];
//         $color['image_url'] = '';
//         $color['type'] = '1';
//         return $color;
//     }

//     private function defaultBackground() {
//         $colorCode = Configure::read('ColorCode');
//         $color = $colorCode[DEFAULT_THEME_BACKGROUND];
//         $color['image_url'] = '';
//         $color['type'] = '1';
//         return $color;
//     }

// }
