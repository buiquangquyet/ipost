<?php

App::uses('MediaLogic', 'Model');

class WebHtml extends MediaLogic {
	protected $infoName = 'web_info';
	protected $mediaName = 'web_html';

	/**
	 * 各ロジックごとにデータを整形する場合には、オーバーライドしてください。
	 * 
	 * @param 
	 */
	protected function formatEachLogic($info, $data)
	{
		$info = json_decode($info);
		$info->html = $data['Media']['id'];
		return json_encode($info);
	}

	protected function extractionMediaData($data) {
		$extData = array();
		$extData['name'] = '-';
		$extData['file'] = $data['html'];
		$extData['type'] = 'text/html';
		return $extData;
	}
}
