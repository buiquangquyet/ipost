<?php
App::uses('AppManagerController', 'Controller');
/**
* 統計表示画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class StatisticsController extends AppManagerController {
    // ページングセットアップ
    public $paginate = array(
        'Device' => array(
            'limit' => 20,
            'order' => array(
                'Device.id' => 'asc'
            ),
        ),
    );

    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
    * アプリ公開数
    * @access  public
    */
    public function app() {
    }

    /**
    * アプリダウンロード数
    * @access  public
    */
    public function download() {
    }

    /**
    * 都道府県ごとのユーザ数
    * @access  public
    */
    public function pref() {
        $list = array();
        $prefList = Configure::read('PrefList');
        for ($i=1; $i < 47; $i++) {
            $list[$i-1]['pref_name'] = $prefList[$i];
        }
        $this->set('list', $list);
    }

}
