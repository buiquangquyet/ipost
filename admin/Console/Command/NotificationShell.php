<?php
App::uses('PushController', 'Controller');
/**
* プッシュ通知送信処理
*/
class NotificationShell extends AppShell {

    /**
    * シェル実行の準備
    */
    public function startup() {
        parent::startup();
        // コントローラー設定
        $this->PushController = new PushController();
    }


    /**
    * プッシュ通知コントラーラの実行
    */
    public function main() {
        $this->out($this->PushController->push());
    }

}
