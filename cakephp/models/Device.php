<?php
App::uses('AppModel', 'Model');
/**
* デバイストークンに関するモデルクラスです。
*/
class Device extends AppModel {

    // デバイスタイプ
    const DEVICE_IOS     = 1;
    const DEVICE_ANDROID = 2;

    // 送信フラグ
    const ALLOW_FLG_ON  = 1;
    const ALLOW_FLG_OFF = 0;

    /**
    * １件だけの情報を取得します。
    * @param number ユーザーID
    * @param string トークンID
    */
    public function getInfo($userId, $token) {
        $conditionList = array(
            'conditions' => array(
                'user_id' => $userId, // 'client_id' => $userId,// edit form user_id to client_id
                'token' => $token,
            ),
        );
        return $this->find('first', $conditionList);
    }

    /**
    * デバイス情報を取得します。
    * @param number $status 状態指定
    */
    public function getInfoToken($token) {
        $conditionList = array(
            'conditions' => array(
                'token'  => $token,
            ),
        );
        return $this->find('first', $conditionList);
    }

    /**
    * プッシュ通知待機中のリストを取得します。
    * @param number ユーザーID
    * @param number 端末選択（1:iOS / 2:Android）
    */
    public function getTokenList($userId, $device=null, $allow_flg=Device::ALLOW_FLG_ON) {
        $conditionList = array(
            'conditions' => array(
                'user_id' => $userId,
                'device'  => $device,
                'allow_flg' => $allow_flg,
            ),
        );
        if (empty($device)) {
            unset($conditionList['conditions']['device']);
        }
        return $this->find('all', $conditionList);
    }

    /**
    * 取得したトークンが既に登録済みかどうか確認します。
    * @param String $token
    * @return false: false / true array
    */
    public function isToken($token) {
        $conditionList = array(
            'conditions' => array(
                'token' => $token,
            ),
        );
        $result = $this->find('first', $conditionList);
        if (count($result) == 0) {
            return false;
        }
        return $result;
    }

}
