<?php
App::uses('NotificationComponent', 'Controller/Component');
/**
* Android用プッシュ通知コンポーネント
*/
class GcmComponent extends NotificationComponent {

    /**
    * 送信処理
    */
    public function push($tokens, $message) {
        try {
            $send_url          = 'https://android.googleapis.com/gcm/send';
            $api_key           = 'AIzaSyArE7RwvyTFRQBrh3YVX4nbwZCMpDGd9f0';

            $registration_ids = array();
            foreach($tokens as $token) {
                array_push($registration_ids, $token['Device']['token']);
            }

            $header = array(
                'Content-Type: application/json',
                'Authorization: key='.$api_key,
            );

            $post_list = array(
                'registration_ids' => $registration_ids,
                'collapse_key'     => 'update',
                'data'             => array('message' => $message),
            );
            $post = json_encode($post_list);

            $ch = curl_init($send_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FAILONERROR, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $res = curl_exec($ch);
            // $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' Android Notification [' . print_r($res) . ']', 'debug');

        } catch (Exception $e) {
            $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' Android Notification Error [' . $token['Device']['token'] . ']', 'error');
        }
    }

}
