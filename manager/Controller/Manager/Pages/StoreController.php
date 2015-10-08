<?php
App::uses('AppManagerController', 'Controller');
/**
* アプリ情報画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class StoreController extends AppManagerController {
    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();

        $this->loadModel('User');
        $this->loadModel('Store');
    }

    /**
    * 詳細表示
    * @access  public
    * @param number $id
    */
    public function info($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('クライアントIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->set('storeInfo', $this->processingForDisplay($this->Store->getData($id)));
    }

    /**
    * ストアURL編集
    * @access  public
    * @param number $id
    */
    public function url($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('クライアントIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->set('storeInfo', $this->processingForDisplay($this->Store->getData($id)));

        // クライアント基本情報
        $this->User->id = $id;
        $userInfo = $this->User->read();
        $this->set('userInfo', $userInfo);
    }

    /**
    * pemファイルアップロード
    * @access  public
    * @param number $id
    */
    public function pem($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('クライアントIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        // クライアント基本情報
        $this->User->id = $id;
        $userInfo = $this->User->read();
        $this->set('userInfo', $userInfo);
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
