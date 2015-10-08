<?php
/**
* プッシュ通知共通コンポーネント
*/
class NotificationComponent extends Component {

    // コントローラ
    public $_controller;

    public function startup(Controller $controller) {
        $this->_controller = $controller;
    }

    /**
    * 送信を失敗したトークンの送信フラグをオフにする
    * @param array $invalid_tokens
    */
    protected function allow_disible($invalid_tokens) {
        $this->loadModel('Device');

        foreach ((array)$invalid_tokens as $token) {
            $deviceInfo = $this->Device->getInfoToken($token);
            if (empty($deviceInfo)) {
                continue;
            }

            try {
                $deviceInfo['Device']['allow_flg'] = Device::ALLOW_FLG_OFF;
                $this->Device->save($deviceInfo);

            } catch (Exception $e) {
                $this->log(__LINE__ . '::' . __METHOD__ . '::' . $e->getMessage(), 'error');
                continue;
            }
        }
    }

    /**
    * コンポーネント用ロードモデル
    * @access private
    */
    protected function loadModel($modelName) {
        if (! empty($this->{$modelName})) {
        // すでに存在すればそのままreturn
            return;
        } elseif (! empty($this->controller->{$modelName})) {
        // 呼び出し元のコントローラでusesしてあれば$this->{モデル名}に参照渡し
            $this->{$modelName} = $this->controller->{$modelName};
        } else {
        // コントローラでusesしていなければコンポーネントでモデルを読み込む
            App::uses($modelName, 'Model');
            $this->{$modelName} = new $modelName;
        }
    }
}