<?php
App::uses('AppAgentController', 'Controller');
/**
* 会社情報画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class AgentController extends AppAgentController {

    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();

        // ブラックホールコールバック指定
        $this->Security->blackHoleCallback = 'blackhole';
    }

    /**
    * 詳細表示
    * @access  public
    */
    public function info() {
        $this->User->id = AuthComponent::user('id');
        $this->set('userInfo', $this->User->read());

        $this->loadModel('UserDetail');
        $userDetail = $this->UserDetail->getInfo(AuthComponent::user('id'));
        $prefList = Configure::read('PrefList');
        //$userDetail['UserDetail']['pref_disp'] = $userDetail['UserDetail']['pref'] ? $prefList[$userDetail['UserDetail']['pref']] : __('未設定');

        $this->set('userDetail', $userDetail);
    }

    /**
    * 編集
    * 実際の処理はAjaxControllerを使用して編集しています。
    * @access  public
    */
    public function edit() {
        $this->User->id = AuthComponent::user('id');
        $this->set('userInfo', $this->User->read());

        $this->loadModel('UserDetail');
        if ($this->request->is('get')) {
            // 更新情報がなかった場合は、DBの値を設定します
            $this->request->data = $this->UserDetail->getInfo(AuthComponent::user('id'));

        } else {
            $result = $this->UserDetail->saveData(AuthComponent::user('id'), $this->request->data);
            if ( ! $result) {
                $this->Session->setFlash(__('代理店情報の更新に失敗しました。'), 'flash_alert', array());

            } else {
                $this->Session->setFlash(__('代理店情報を更新しました。'), 'default', array('class' => 'alert alert-success'));
            }
        }
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
        if (! empty($decodeData->profile->pref)) {
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
                $this->Session->setFlash(__('不正な送信が行われました'), 'flash_alert', array());
                $this->redirect(array('controller' => 'agent', 'action' => $this->action));
                break;
            default:
                $this->redirect(array('controller' => 'agent', 'action' => 'add'));
                break;
        }
    }

}
