<?php
App::uses('AppApiController', 'Controller');
/**
* トークン登録APIのコントローラです。
* @author    Yoshitaka Kitagawa
*/
class DeviceController extends AppApiController {

    /**
    * 前処理
    */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
    * トークンの登録
    */
    public function add() {
        if ($this->request->is('post')) {

            $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' ' . print_r($this->request->data, true), LOG_DEBUG);

            if (empty($this->request->data['token'])) {
                $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' トークンが送信されていません。', LOG_DEBUG);
                $this->response->body(json_encode(array('status' => '0', 'value' => urlencode("トークンが送信されていません。"))));
                return;
            }

            if ($this->Device->isToken($this->request->data['token'])) {
                $this->log(__LINE__ . '::' . __METHOD__ . '::' . $this->request->data['token'] . ' 登録済みです。', LOG_DEBUG);

            } else {
                $user_id = $this->request->data('user_id');
                if (array_key_exists('client_id', $this->request->data)) {
                    $user_id = $this->request->data('client_id');
                }
                $setItem['user_id'] = $user_id;
                $setItem['token'] = $this->request->data['token'];
                $setItem['device'] = $this->request->data('device');
                $this->Device->set($setItem);

                // データベースに追加保存
                if ($this->Device->save()) {
                    // 成功
                    $this->log(__LINE__ . '::' . __METHOD__ . '::' . $this->request->data['token'] . ' トークンを保存しました。', LOG_DEBUG);
                } else {
                    // 失敗
                    $this->log(__LINE__ . '::' . __METHOD__ . '::' . $this->request->data['token'] . ' トークンの保存に失敗しました。', LOG_DEBUG);
                }
            }
        }
    }

}
