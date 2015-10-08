<?php
App::uses('AppModel', 'Model');
/**
* ユーザー同士のリレーションを管理するモデルです。
* @author    Yoshitaka Kitagawa
*/
class UserRelation extends AppModel {

    var $primaryKey = 'user_id';

    public $belongsTo = array(
        'User' => array(
            'className'    => 'User',
            'foreignKey'   => 'user_id'
        ),
    );

    public $hasMany = array(
        'UserLang' => array(
            'className' => 'UserLang',
            'foreignKey' => 'user_id'
        ),
    );

    /**
    * 親IDを元にユーザーIDのリストを返します。
    * @param number $parentId 親IDの指定
    */
    public function getUserList($parentId) {
        $conditionList = array(
            'conditions' => array(
                'parent_id' => $parentId,
            ),
        );
        return $this->find('all', $conditionList);
    }

    /**
    * 指定したリレーション情報を取得します。
    * @param number ユーザーID
    * @param number 代理店ID
    */
    public function getInfo($userId, $parentId) {
        $conditionList = array(
            'conditions' => array(
                'user_id' => $userId,
                'parent_id' => $parentId,
            ),
        );
        return $this->find('first', $conditionList);
    }

    /**
     * ユーザー同士のリレーションデータを保存します.
     * @param string $data dtb_userに保存するデータ
     */
    public function saveData($parent_id, $user_id) {
        $userRelation = $this->getInfo($user_id, $parent_id);
        if (array_key_exists('UserRelation', $userRelation)) {
            throw new Exception('既に登録されています');
        }

        $userRelation = array(
            'user_id' => $user_id,
            'parent_id' => $parent_id,
        );

        $this->begin();
        if ( ! $this->save($userRelation)) {
            throw new Exception('クライアント登録処理に失敗しました');
        }
        $this->commit();

        return true;
    }
}
