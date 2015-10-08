<?php
App::uses('AppModel', 'Model');
/**
* User Language
* @author    HuuHv
*/
class UserLang extends AppModel {
    public $useTable = 'user_lang';

    var $validate = array(
        'lang' => array(
            'rule' => array('multiple', array('min' => 1)),
            'required' => true,
            'message' => 'xxxを入力してください',
        ),
    );

    /**
    * 登録されている言語のリストを取得します。
    * @param number $userId
    */
    public function getList($userId) {
        $conditions = array(
            'conditions' => array(
                'user_id' => $userId
            ),
        );
        return $this->find('all', $conditions);
    }

    /**
    * @param arrat $userId
    */
    public function getListFormat($data) {
        if (count($data) < 4) {
            $cnt = 4 - count($data);
            for ($i=0; $i < $cnt; $i++) {
                $data[] = array('UserLang' => array('lang' => array()));
            }
        }
        $list = array();
        for ($i=0; $i<4; $i++) {
            switch ($data[$i]['UserLang']['lang']) {
                case 'ja':
                    $list[0]['UserLang']['lang'] = 'ja';
                    break;
                case 'en':
                    $list[1]['UserLang']['lang'] = 'en';
                    break;
                case 'zh':
                    $list[2]['UserLang']['lang'] = 'zh';
                    break;
                case 'vi':
                    $list[3]['UserLang']['lang'] = 'vi';
                    break;
                default:
                    $list[]['UserLang']['lang'] = '';
                    break;
            }
        }
        return $list;
    }

    /**
    * 登録済みかどうか確認します。
    * @param number $userId
    * @param string $lang
    * @param string || array
    */
    public function isLang($userId, $lang) {
        $conditions = array(
            'conditions' => array(
                'user_id' => $userId,
                'lang' => $lang
            ),
        );
        $langInfo = $this->find('first', $conditions);
        if (empty($langInfo)) {
            return '';
        }
        return $langInfo['UserLang']['lang'];
    }

    /**
    * 対応言語の保存
    * @param number $userId
    * @param array $data
    */
    public function saveData($userId, $data) {
        $langInfo = $this->getList($userId);
        // 登録されているのを一旦削除
        if ( ! empty($langInfo)) {
            $param = array('user_id' => $userId);
            $this->deleteAll($param);
        }

        $langCnt = 0;
        foreach ((array)$data as $key => $lang) {
            $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' select lang => ' . $lang['UserLang']['lang'], LOG_DEBUG);

            if ( ! array_key_exists('UserLang', $lang)) {
                continue;
            }
            if (empty($lang['UserLang']['lang'])) {
                continue;
            }
            $this->create();
            $setItem = array(
                'user_id' => $userId,
                'lang' => $lang['UserLang']['lang'],
            );
            if ( ! $this->save($setItem)) {
                return false;
            }
            $langCnt ++;
        }

        if ($langCnt == 0) {
            return false;
        }
        return true;
    }

}
