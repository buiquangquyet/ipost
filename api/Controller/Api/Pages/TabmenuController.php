<?php
App::uses ( 'AppApiController', 'Controller' );
/**
 * フッターメニューAPIのコントローラです。
 *
 * @author Yoshitaka Kitagawa
 *
 */
class TabmenuController extends AppApiController {

	/**
	 * 前処理
	 */
	public function beforeFilter() {
		parent::beforeFilter ();
// 		Configure::write('Config.language', 'vi');
	}

	/**
	 * トップAPI
	 */
	public function index() {
		$tab = $this->getTabmenu ( $this->user_id );
		echo json_encode($tab);
	}

	/**
	 * タブメニューの情報を取得します。
	 */
	private function getTabmenu($id) {
		$this->loadModel ( 'Footer' );
		$this->loadModel ( 'BasicInfo' );
		$this->loadModel ( 'Shop' );
		$basicInfo = $this->BasicInfo->getInfo ( $this->user_id, $this->Footer->getInfoName () );
		$modified = '';
		$created = '';
		if (! empty ( $basicInfo )) {
			$modified = $basicInfo ['BasicInfo'] ['modified'];
			$created = $basicInfo ['BasicInfo'] ['created'];
		}

		$geocode = array (
				'lat' => '',
				'lng' => ''
		);
		$shopInfo = json_decode ( $this->Shop->getData ( $this->user_id ), true );
		if (array_key_exists ( 'address', $shopInfo ['profile'] )) {
			$geocode = $this->geocode ( $shopInfo ['profile'] ['address'] );
		}
		$conf = Configure::read ( 'DescriptionWithIconList' );
		$tab = [];
		$tabInfo = json_decode ( $this->Footer->getData ( $id ), true );
		foreach ( $tabInfo as $key => $info ) {
			if (empty ( $info ['type'] )) {
				continue;
			}
			$tab [] = array (
					//'user_id' => $id,
					//'name' => '',
					//'key' => $info ['type'],
					'type' => $info ['type'],
					//'value' => '',
					//'file_name' => $conf [$info ['icon']] ['icon'],
					'icon' => $conf [$info ['icon']] ['icon'],
					//'tmp_file_name' => '',
					'position' => (string)($key+1),
					//'updated_at' => $modified,
					//'created_at' => $created,
					//'lat' => $geocode ['lat'],
					//'lng' => $geocode ['lng']
			);
		}
		return $tab;
	}
}