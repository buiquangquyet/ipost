<?php
App::uses('AppModel', 'Model');
/**
* ニュースのいいね！に関するモデルクラスです。
*/
class NewsLike extends AppModel {

    /**
    * @param number newsId
    * @param number deviceId
    */
    public function getInfo($newsId, $deviceId) {
        $conditionList = array(
            'conditions' => array(
                'news_id'   => $newsId,
                'device_id' => $deviceId,
            ),
        );
        return $this->find('first', $conditionList);
    }

    /**
    * いいね！しているデバイスか判断しています。
    * @param number $newsId
    * @param number deviceId
    */
    public function isLike($newsId, $deviceId) {
        $conditionList = array(
            'conditions' => array(
                'news_id'   => $newsId,
                'device_id' => $deviceId,
            ),
        );
        if (empty($this->find('first', $conditionList))) {
            return false;
        }
        return true;
    }

    /**
    * いいねの数を返します。
    * @param number $newsId
    */
    public function likeCount($newsId) {
        $conditionList = array(
            'conditions' => array(
                'news_id'   => $newsId,
            ),
        );
        return count($this->find('all', $conditionList));
    }

}
