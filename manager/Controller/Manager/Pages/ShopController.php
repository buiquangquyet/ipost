<?php
App::uses('AppManagerController', 'Controller');
/**
* クライアントアカウント画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class ShopController extends AppManagerController {
    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();

        $this->loadModel('Shop');

        // ブラックホールコールバック指定
        $this->Security->blackHoleCallback = 'blackhole';
     }

    /**
    * 編集
    * @access  public
    * @param number $id
    */
    public function edit($id = null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('クライアントIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->User->id = $id;
        $this->set('userInfo', $this->User->read());

        $shop = json_decode($this->Shop->getData($id), true);
        $shopInfo['Shop'] = $shop["profile"];


        if ($this->request->is('get')) {
            $this->request->data = $shopInfo;

        } else {
            // バリデーションチェック
            $this->Shop->set($this->request->data);
            if ( ! $this->Shop->validates()) {
                $this->Session->setFlash(__('お店情報の更新に失敗しました。'), 'default', array('class' => 'alert alert-danger'));
            } else {

                // 更新処理
                $result = $this->Shop->saveData($id, $this->request->data['Shop']);
                if ( ! $result) {
                    $this->Session->setFlash(__('お店情報の更新に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

                } else {
                    $this->Session->setFlash(__('お店情報を更新しました。'), 'default', array('class' => 'alert alert-success'));
                    $this->redirect(array('controller' => 'client', 'action' => 'info', $id));
                }
            }
        }
    }

    /**
    * ステータスの編集
    */
    public function status($id=null) {
        if (is_null($id)) {
            $this->Session->setFlash(__('クライアントIDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('controller' => 'client', 'action' => 'list'));
        }

        $this->User->id = $id;
        $this->set('userInfo', $this->User->read());

        // 年の選択ボックス
        $optYear = array();
        for ($i=date('Y')-5; $i <= date('Y')+5; $i++) $optYear[$i] = $i;
        $this->set('optYear', $optYear);

        // 月の選択ボックス
        $optMonth = array();
        for ($i=1; $i <= 12; $i++) $optMonth[$i] = sprintf("%02d", $i) . __('月');
        $this->set('optMonth', $optMonth);

        // 日の選択ボックス
        $optDay = array();
        for ($i=1; $i <= 31; $i++) $optDay[$i] = sprintf("%02d", $i) . __('日');
        $this->set('optDay', $optDay);
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

    /**
     * ブラックホールコールバック
     */
    public function blackhole($type) {
        switch ($type) {
            case 'csrf':
            $this->Session->setFlash(__('不正な送信が行われました。'), 'default', array('class' => 'alert alert-danger'));
                $this->redirect(array('controller' => 'client', 'action' => $this->action));
                break;
            default:
                $this->redirect(array('controller' => 'client', 'action' => 'list'));
                break;
        }
    }

}
