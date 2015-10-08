<?php
App::uses('BasicInfoLogic', 'Model');
/**
* 公開情報にアクセスするためのクラスです。
* @author    Yoshitaka Kitagawa
*/
class ShopStatus extends BasicInfoLogic
{
	protected $infoName = 'shop_status_info';

	/**
	 * 各ロジックごとにデータを整形する場合には、オーバーライドしてください。
	 * @param
	 */
	protected function formatEachLogic($info, $data)
	{
		$info = json_decode($info);
		$info->profile = $data;
		return json_encode($info);
	}

}
