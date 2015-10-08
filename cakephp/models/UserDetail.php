<?php
App::uses('AppModel', 'Model');
/**
* ユーザー情報詳細を管理するモデルです。
* @author    Yoshitaka Kitagawa
*/
class UserDetail extends AppModel {

    /**
    * バリデーションの指定
    */
    var $validate = array(
        'company_name' => array(
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => '会社名は255文字以内で入力してください',
            ),
        ),
        'pref' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => '都道府県を選択してください',
            ),
        ),
        'tel1' => array(
            'tel1' => array(
                'allowEmpty' => true,
                'rule' => array('custom', '/^[0-9]+$/'),
                'message' => '電話番号（市外局番）の形式が正しくありません',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 4),
                'message' => '電話番号（市外局番）は4文字以内で入力してください',
            ),
        ),
        'tel2' => array(
            'tel2' => array(
                'allowEmpty' => true,
                'rule' => array('custom', '/^[0-9]+$/'),
                'message' => '電話番号（上4桁）の形式が正しくありません',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 4),
                'message' => '電話番号（上4桁）は4文字以内で入力してください',
            ),
        ),
        'tel3' => array(
            'tel3' => array(
                'allowEmpty' => true,
                'rule' => array('custom', '/^[0-9]+$/'),
                'message' => '電話番号（下4桁）の形式が正しくありません',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 4),
                'message' => '電話番号（下4桁）は4文字以内で入力してください',
            ),
        ),
        'fax1' => array(
            'fax1' => array(
                'allowEmpty' => true,
                'rule' => array('custom', '/^[0-9]+$/'),
                'message' => 'FAX番号（市外局番）の形式が正しくありません',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 4),
                'message' => 'FAX番号（市外局番）は4文字以内で入力してください',
            ),
        ),
        'fax2' => array(
            'fax2' => array(
                'allowEmpty' => true,
                'rule' => array('custom', '/^[0-9]+$/'),
                'message' => 'FAX番号（上4桁）の形式が正しくありません',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 4),
                'message' => 'FAX番号（上4桁）は4文字以内で入力してください',
            ),
        ),
        'fax3' => array(
            'fax3' => array(
                'allowEmpty' => true,
                'rule' => array('custom', '/^[0-9]+$/'),
                'message' => 'FAX番号（下4桁）の形式が正しくありません',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 4),
                'message' => 'FAX番号（下4桁）は4文字以内で入力してください',
            ),
        ),
        'mobile_tel1' => array(
            'mobile_tel1' => array(
                'allowEmpty' => true,
                'rule' => array('custom', '/^[0-9]+$/'),
                'message' => '携帯番号（市外局番）の形式が正しくありません',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 4),
                'message' => '携帯番号（市外局番）は4文字以内で入力してください',
            ),
        ),
        'mobile_tel2' => array(
            'mobile_tel2' => array(
                'allowEmpty' => true,
                'rule' => array('custom', '/^[0-9]+$/'),
                'message' => '携帯番号（上4桁）の形式が正しくありません',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 4),
                'message' => '携帯番号（上4桁）は4文字以内で入力してください',
            ),
        ),
        'mobile_tel3' => array(
            'mobile_tel3' => array(
                'allowEmpty' => true,
                'rule' => array('custom', '/^[0-9]+$/'),
                'message' => '携帯番号（下4桁）の形式が正しくありません',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 4),
                'message' => '電話番号（下4桁）は4文字以内で入力してください',
            ),
        ),
        'zip_code1' => array(
            'zip_code1' => array(
                'allowEmpty' => true,
                'rule' => array('custom', '/^[0-9]+$/'),
                'message' => '郵便番号（上3桁）の形式が正しくありません',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 3),
                'message' => '郵便番号（上3桁）は3文字以内で入力してください',
            ),
        ),
        'zip_code2' => array(
            'zip_code2' => array(
                'allowEmpty' => true,
                'rule' => array('custom', '/^[0-9]+$/'),
                'message' => '郵便番号（下4桁）の形式が正しくありません',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 4),
                'message' => '郵便番号（下4桁）は4文字以内で入力してください',
            ),
        ),
    );

    /**
    * 情報の取得
    */
    public function getInfo($userId=null) {
        $conditionList = array(
            'conditions' => array(
                'user_id' => $userId,
            ),
        );
        $result = $this->find('first', $conditionList);

        if (count($result) < 1) {
            $setItem = array(
                'user_id' => $userId
            );
            $this->begin();
            $this->set($setItem);
            $this->save();
            $this->commit();
        }
        $result = $this->find('first', $conditionList);

        return $result;
    }

    /**
     * 存します.
     * @param string $data dtb_userに保存するデータ
     */
    public function saveData($user_id, $data) {
        $userDetail = $this->getInfo($user_id);

        $userDetail['UserDetail']['company_name'] = $data['UserDetail']['company_name'];

        $userDetail['UserDetail']['tel1'] = $data['UserDetail']['tel1'];
        $userDetail['UserDetail']['tel2'] = $data['UserDetail']['tel2'];
        $userDetail['UserDetail']['tel3'] = $data['UserDetail']['tel3'];

        $userDetail['UserDetail']['fax1'] = $data['UserDetail']['fax1'];
        $userDetail['UserDetail']['fax2'] = $data['UserDetail']['fax2'];
        $userDetail['UserDetail']['fax3'] = $data['UserDetail']['fax3'];

        $userDetail['UserDetail']['mobile_tel1'] = $data['UserDetail']['mobile_tel1'];
        $userDetail['UserDetail']['mobile_tel2'] = $data['UserDetail']['mobile_tel2'];
        $userDetail['UserDetail']['mobile_tel3'] = $data['UserDetail']['mobile_tel3'];

        $userDetail['UserDetail']['zip_code1'] = $data['UserDetail']['zip_code1'];
        $userDetail['UserDetail']['zip_code2'] = $data['UserDetail']['zip_code2'];

        $userDetail['UserDetail']['pref'] = $data['UserDetail']['pref'];
        $userDetail['UserDetail']['city'] = $data['UserDetail']['city'];
        $userDetail['UserDetail']['address_opt1'] = $data['UserDetail']['address_opt1'];
        $userDetail['UserDetail']['address_opt2'] = $data['UserDetail']['address_opt2'];


        $this->set($userDetail);
        $this->begin();

        if ( ! $this->validates()) {
            return false;

        } else {
            $this->save();
        }
        $this->commit();

        return true;
    }

}
