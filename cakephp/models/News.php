<?php
App::uses('AppModel', 'Model');
/**
* ニュースに関するモデルクラスです。
*/
class News extends AppModel {

    // PUSH通知：配信完了フラグ
    const NOTICE_STATUS_START = 1;
    const NOTICE_STATUS_PRE   = 2;
    const NOTICE_STATUS_COMP  = 3;
    const NOTICE_STATUS_ERROR = 9;

    const NEWS_VIEW_VISIBLE = 0;
    const NEWS_VIEW_ENABLE  = 1;

        /**
    * バリデーションの指定
    */
    var $validate = array(
        'title' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'タイトルを入力してください。',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => 'タイトルは255文字以内で入力してください。',
            ),
        ),
        'body' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => '本文を入力してください。',
            ),
        ),
    );


    public function getInfo($userId, $token) {
        $conditionList = array(
            'conditions' => array(
                'user_id' => $userId,
                'token' => $token,
                'lang'    => Configure::read('Config.language'),
            ),
        );

        return $this->find('first', $conditionList);
    }

    /**
    * 配信済みのリストを取得します。
    */
    public function getData($userId, $limit=null) {
        $conditionList = array(
            'conditions' => array(
                'user_id' => $userId,
                'status' => 1, // 配信済み
                //'lang'   => Configure::read('Config.language'), // Hss add for get data from default language
            ),
            'order' => array('send' => 'desc'),
            'limit' => $limit,
        );
        if (empty($limit)) {
            unset($conditionList['conditions']['limit']);
        }
        return $this->find('all', $conditionList);
    }

    /**
    *全データを取得スル。
    */
    public function getAllData($userId) {
        $conditions = array(
            'conditions' => array(
                'user_id' => $userId,
                'lang'    => Configure::read('Config.language'),
                ),
            'order' => array('modified' => 'desc'),
            );

        return $this->find('all', $conditions);
    }

    /**
    * プレビュー情報を設定する。
    */
    public function getPreviewData($userId) {
        $conditions = $this->getAllSearchCondition($userId);
        return $this->find('all', $conditions);
    }

    /**
    * 削除
    */
    public function deleteData($userId, $targetId) {
        $targetData = $this->getTargetData($userId, $targetId);

        if (empty($targetData)) {
            throw new Exception('対象の記事が見つかりません。');
        }

        $this->delete($targetData['News']['id']);
    }

    /**
    * ニュース情報の登録
    */
    public function saveData($userId, $data) {

        // ユーザID設定
        $data['user_id'] = $userId;

        // 配信時間初期値
        $data['noticed'] = '0000-00-00 00:00:00';

        // 日付データの変更
        if(!empty($data['notice_date']) && !empty($data['notice_hour']) && !empty($data['notice_minute']) && $data['notice_flg'] == 1) {

            // 設定
            $data['noticed'] = $data['notice_date'].' '.$data['notice_hour'].':'.$data['notice_minute'].':00';

            // 設定解除
            unset($data['notice_date']);
            unset($data['notice_hour']);
            unset($data['notice_minute']);
        }

        $data['lang'] =  Configure::read('Config.language');
        $data['send'] = $data['noticed']; // Hss add for add field send in dtb_news

        // IDが指定してあったら、そのIDの情報を取得して、マージ
        if (!empty($data['id'])) {
            $orgData = $this->getTargetData($userId, $data['id']);
            $data = array_merge($orgData['News'], $data);
        }

        // 保存
        $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' NEWS save => ' . print_r($data, true), LOG_DEBUG);
        return $this->save($data);
    }

    /**
    * 対象のニュース情報を取得する。
    */
    public function getTargetData($userId, $targetId) {

        // 条件設定
        $conditions = array(
            'conditions' => array(
                'user_id' => $userId,
                'id' => $targetId,
                'lang' => Configure::read('Config.language'),
                ),
            );

        return $this->find('first', $conditions);
    }

    /**
    * 対象のユーザのニュース情報の検索条件を取得する。
    */
    public function getAllSearchCondition($userId) {

        $conditions = array(
            'conditions' => array(
                'user_id' => $userId,
                'lang' => Configure::read('Config.language'),
                ),
            'limit' => 5,
            'order' => array('modified' => 'desc'),
            );

        return $conditions;
    }

    /**
    * プッシュ通知待機中のリストを取得します。
    * @param number $notice 状態指定
    */
    public function getPushNotificationList($notice=Push::NOTICE_STATUS_START, $noticed='0000-00-00 00:00:00') {

        $conditionList = array(
            'conditions' => array(
                'notice' => $notice,
                array('or' => array(
                    array('noticed' => $noticed),
                    array('noticed <' => $noticed),
                )),
            ),
        );
        return $this->find('all', $conditionList);
    }

}
