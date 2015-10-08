<?php
App::uses('AppController', 'Controller');
/**
* プッシュ通知送信処理
*/
class PushController extends AppController {

    /**
    * 前処理
    * @access public
    */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
    * プッシュ通知送信処理
    * @access public
    */
    public function push() {
        // 毎分プッシュ通知
        $this->push_notice();
    }

    /**
    * 毎分プッシュ通知処理
    * @access private
    */
    private function push_notice() {
        $this->loadModel('News');
        $this->loadModel('Device');

        // 今日の日付
        $now = date('Y-m-d H:i:s');

        // プッシュ通知
        $pushs = $this->News->getPushNotificationList(News::NOTICE_STATUS_START, $now);
        foreach ($pushs as $key => $push) {
            $push['News']['notice'] = News::NOTICE_STATUS_PRE;
            $push['News']['status'] = News::NEWS_VIEW_ENABLE;
            $push['News']['send'] = date('Y-m-d H:i:s');
            if ( ! $this->News->save($push)) {
                $this->log(__LINE__ . '::' . __METHOD__ . '::' . __(' プッシュ通知待機ステータス更新エラー'), LOG_ERR);
            }

            // トークンリストの取得（iOS）
            $tokens = $this->Device->getTokenList($push['News']['user_id'], Device::DEVICE_IOS);

            // iOSのプッシュ通知
            $this->Apns = $this->Components->load('Apns');
            $this->Apns->startup($this);
            $this->Apns->push($tokens, $push['News']['title'], $push['News']['user_id'] . '.pem');

            // トークンリストの取得（Android）
            $tokens = $this->Device->getTokenList($push['News']['user_id'], Device::DEVICE_ANDROID);

            // Androidのプッシュ通知
            $this->Gcm = $this->Components->load('Gcm');
            $this->Gcm->startup($this);
            $this->Gcm->push($tokens, $push['News']['title']);

            $push['News']['notice'] = News::NOTICE_STATUS_COMP;
            if ( ! $this->News->save($push)) {
                $this->log(__LINE__ . '::' . __METHOD__ . '::' . __(' プッシュ通知待機ステータス更新エラー'), LOG_ERR);
            }
        }
    }

}
