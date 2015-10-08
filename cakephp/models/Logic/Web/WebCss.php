<?php

App::uses('MediaLogic', 'Model');

class WebCss extends MediaLogic {
	protected $infoName = 'web_info';
	protected $mediaName = 'web_css';

	/**
	 * 各ロジックごとにデータを整形する場合には、オーバーライドしてください。
	 * 
	 * @param 
	 */
	protected function formatEachLogic($info, $data)
	{
		$info = json_decode($info);
		$info->css = $data['Media']['id'];
		return json_encode($info);
	}

	protected function extractionMediaData($data) {
		$extData = array();
		$extData['name'] = '-';
		$extData['file'] = $data['css'];
		$extData['type'] = 'text/css';
		return $extData;
	}
}
