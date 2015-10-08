<?php
App::uses('NotificationComponent', 'Controller/Component');
/**
* https://gist.github.com/kechol/3974710
*/
App::import('Vendor', 'ApnsPHP/Autoload');
/**
* iOS用プッシュ通知コンポーネント
*/
class ApnsComponent extends NotificationComponent {

    // 設定
    public $env = ApnsPHP_Abstract::ENVIRONMENT_SANDBOX;
    public $identifier = 'CakeApns';
    public $expiry = 30;

    // TODO: サーバーにより要設定
    public $app_cert_path     = 'pem/user/';
    public $entrust_cert_path = 'pem/root/entrust_root_certification_authority.pem';

    /**
    * 送信処理
    */
    public function push($tokens, $text, $pem, $options = array()) {
        // pemファイルの有無
        if ( ! file_exists(ROOT.DS.APP_DIR.DS.$this->app_cert_path . $pem)) {
            $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' non pem file. => ' . $pem, LOG_ERR);
            return false;
        }

        $push = new ApnsPHP_Push($this->env, ROOT.DS.APP_DIR.DS.$this->app_cert_path . $pem);
        $push->setRootCertificationAuthority(ROOT.DS.APP_DIR.DS.$this->entrust_cert_path);

        $push->connect();

        // 失敗したトークンの一時保存用
        $invalid_tokens = array();

        try {
            foreach ((array)$tokens as $key => $token) {
                try {
                    $message = new ApnsPHP_Message($token['Device']['token']);
                    $message->setText($text);
                    $message->setSound();

                    $message->setCustomIdentifier(isset($options['identifier']) ? $options['identifier'] : $this->identifier);
                    $message->setExpiry(isset($options['identifier']) ? $options['expiry'] : $this->expiry);

                    $push->add($message);

                    $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' Send Token [' . $token['Device']['token'] . ']', LOG_DEBUG);
                } catch (Exception $e) {
                    $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' iOS Notification Error [' . $token['Device']['token'] . ']', LOG_ERR);
                    array_push($invalid_tokens, $token['Device']['token']);
                }
                $push->send();
            }
        } catch (Exception $e) {
            $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' iOS Notification Error: ' . $e->getMessage(), LOG_ERR);
            array_push($invalid_tokens, $token['Device']['token']);
        }

        // 送信失敗していたら対象のトークンを一旦保持
        $aErrorQueue = $push->getErrors();
        $push->disconnect();

        if (! empty($aErrorQueue)) {
            foreach ($aErrorQueue as $info) {
                if (isset($info['ERRORS'])) {
                    foreach ($info['ERRORS'] as $error) {
                        if (isset($error['statusMessage']) && $error['statusMessage']=='Invalid token') {
                        $this->log(__LINE__ . '::' . __METHOD__ . '::' . $error['statusMessage'] . ' [' . $token['Device']['token'] . ']', LOG_ERR);
                            array_push($invalid_tokens, $token['Device']['token']);
                        }
                    }
                }
            }
        }


        // 失敗したトークンへは配信しないようにフラグを変更
        if (! empty($invalid_tokens)) {
            $this->allow_disible($invalid_tokens);
        }

        if (empty($aErrorQueue)) {
            return true;

        } else {
            $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' iOS Notification Error: ' . $aErrorQueue, LOG_ERR);
            return false;
        }
    }

    public function feedback() {
        $feedback = new ApnsPHP_Feedback($env, $this->app_cert_path);
        $feedback->connect();
        $error = $feedback->receive();
        $feedback->disconnect();
        return $error;
    }
}
