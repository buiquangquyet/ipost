<?php
App::uses('AppModel', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppImageModel extends AppModel {

	/**
	* リサイズ
	*/
	public function resize($fileName, $mimeType, $sizeType = 'normal') {

		// 画像のサイズを取得する。
		$imageSize = $this->sizes($fileName);

		// 画像の拡張性を設定スル。
		$mimeType = explode('/', $mimeType);
		App::uses('ImageResize', 'Vendor');

		// 切り抜きサイズを取得
		$resize = Configure::read('resize_info');
		$resize = $resize[$sizeType];

		//画像を幅100pxでリサイズして保存
		$newImgname = time() . rand(100000,999999) . '.png';
		$thumb = new ImageResize($fileName, $mimeType[1]);
		$thumb->name($newImgname);


		if ($resize['height'] > $resize['width']) {
			$thumb->height($resize['height']);
		} else {
			$thumb->width($resize['width']);
		}

		$thumb->save();

		// サイズの中心から抜き取り。

		$tmp_dir = ini_get('upload_tmp_dir');

		if( empty($tmp_dir)){
			$tmp_dir = '/tmp';
		}

		if ($resize['height'] != null) {
			$thumb = new ImageResize($tmp_dir . '/' . $newImgname, $mimeType[1]);
			$thumb->name($newImgname);
			$thumb->width($resize['width']);
			$thumb->height($resize['height']);
			$thumb->crop(0, 0);
			$thumb->save();
		}

		return $tmp_dir . '/' . $newImgname;
	}


	/**
	* 画像のサイズを取得します。
	*/
	private function sizes($filename = null) {
		list($width, $height) = getimagesize($filename);
		return array('width' => $width, 'height' => $height);
	}


}