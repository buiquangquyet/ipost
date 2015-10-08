<?php
App::uses('AppAgentController', 'Controller');
/**
* クライアントアカウント画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class ShopController extends AppAgentController {
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
        $this->User->id = $id;
        $this->set('userInfo', $this->User->read());

        $this->loadModel('Shop');
        $this->set('shopInfo', $this->processingForDisplay($this->Shop->getData($id)));
    }

    /**
    * 編集
    * @access  public
    * @param number $id
    */
    public function edit($id = null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('クライアント情報の取得に失敗しました。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect('list');
        }

        $this->User->id = $id;
        $this->set('userInfo', $this->User->read());

        $this->loadModel('Shop');
        $this->set('shopInfo', $this->processingForDisplay($this->Shop->getData($id)));
    }

    public function edit_success($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('クライアント情報の取得に失敗しました。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect('list');
        }

        $this->Session->setFlash(__('お店情報を行進しました。'), 'default', array('class' => 'alert alert-success'));
        $this->redirect(array('controller' => 'client', 'action' => 'info', $id));
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
        if ( ! empty($decodeData->profile->pref))
        {
            $prefList = Configure::read('PrefList');
            $decodeData->profile->pref_disp = $prefList[$decodeData->profile->pref];
        }

        return json_encode($decodeData);
    }

}
