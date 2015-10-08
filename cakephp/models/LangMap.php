<?php
App::uses('AppModel', 'Model');
/**
* 言語マップ管理モデル
* @author    HuuHv
*/
class LangMap extends AppModel {

    // バリデーション指定
    var $validate = array(
        'lang_after' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => '対応言語を選択してください',
            ),
        ),
        'lang_before' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => '言語を入力してください',
            ),
        ),
    );

    /**
    * 登録されている言語マップのリストを取得します。
    * @return array
    */
    public function getList() {
        $conditions = array(
            'order' => array('lang_after' => 'asc'),
        );
        return $this->find('all', $conditions);
    }

    /**
    * idを元に登録されている言語マップ情報を取得します。
    */
    public function getInfo($id) {
        $conditions = array(
            'conditions' => array(
                'id' => $id
            ),
        );
        return $this->find('first', $conditions);
    }

    public function isBefore($lang) {
        $conditions = array(
            'conditions' => array(
                'lang_before' => $lang
            ),
        );
        $langInfo = $this->find('first', $conditions);
        if (empty($langInfo)) {
            return '';
        }
        return $langInfo['LangMap']['lang_after'];
    }

}
