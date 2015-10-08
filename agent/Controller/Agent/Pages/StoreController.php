<?php
App::uses('AppAgentController', 'Controller');
/**
* アプリ情報画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class StoreController extends AppAgentController {
    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Security->validatePost = false;
    }

    /**
    * 詳細表示
    * @access  public
    * @param number $id
    */
    public function info($id=null) {
        $this->loadModel('Store');

        $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' ' . print_r($this->Store->getData($id), true), LOG_DEBUG);

        $this->set('admin_domain', str_replace('agent.', 'admin.', FULL_BASE_URL));
        $this->set('storeInfo', $this->processingForDisplay($this->Store->getData($id)));
    }

    /**
     * 表示用に加工制御するメソッド.
     *
     * @param $displayData 画面に出力するデータ群 ( JSON-ENCデータ )
     * @return string 加工した画面に出力するデータ群 ( JSON-ENC データ )
     */
    protected function processingForDisplay($displayData) {
        // JSONデータをデコード処理
        $decodeData = json_decode($displayData);

        // 都道府県にIDが入っていたら表示用に加工
        if ( ! empty($decodeData->profile->pref)) {
            $prefList = Configure::read('PrefList');
            $decodeData->profile->pref_disp = $prefList[$decodeData->profile->pref];
        }

        return json_encode($decodeData);
    }

}
