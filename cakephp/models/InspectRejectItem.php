<?php
App::uses('AppModel', 'Model');
/**
* 簡易審査・アップルの審査結果リジェクト選択項目に関するモデルクラスです。
*/
class InspectRejectItem extends AppModel {

    /**
    * 簡易審査用リジェクト項目
    */
    const REJECT_TYPE_NORMAL = 0;

    /**
    * アップル用リジェクト項目
    */
    const REJECT_TYPE_APPLE = 1;

    /**
    * リジェクト項目を取得します
    * @param number 簡易審査用か、アップル用かを選択します。
    */
    public function getList($type=0) {
        $conditionList = array(
            'conditions' => array(
                'type' => $type,
            ),
        );

        return $this->find('all', $conditionList);
    }
}
