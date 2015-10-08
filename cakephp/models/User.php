<?php
App::uses('AppModel', 'Model');
/**
* ユーザー情報にアクセスするためのクラスです。
* @author    Yoshitaka Kitagawa
*/
class User extends AppModel {

    /**
    * アソシエーションの設定
    */
    public $hasMany = array(
        'BasicInfo' => array(
            'className' => 'BasicInfo',
        ),
        'UserRelation' => array(
            'className' => 'UserRelation',
        ),
        'UserDetail' => array(
            'className' => 'UserDetail',
        ),
        'UserLang' => array(
            'className' => 'UserLang',
        ),
    );

    var $validate = array(
        'user_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => '氏名を入力してください',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => '氏名は255文字以内で入力してください',
            ),
        ),
        'user_name_furi' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => '氏名（ふりがな）を入力してください',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => '氏名（ふりがな）は255文字以内で入力してください',
            ),
        ),
        'email' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'メールアドレスを入力してください',
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'このメールアドレスは既に登録されています',
            ),
            'email' => array(
                'rule' => 'email',
                'message' => 'メールアドレスの形式が正しくありません',
                'allowEmpty' => true,
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => 'メールアドレスは255文字以内で入力してください',
            ),
        ),
        'password' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'パスワードを入力してください',
            ),
            'password' => array(
                'rule' => array('custom', '/^[a-zA-Z0-9]+$/'),
                'message' => 'パスワードの形式が正しくありません',
            ),
            'minLength' => array(
                'rule' => array('minLength', 8),
                'message' => 'パスワードは8文字以上で入力してください',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => 'パスワードは255文字以内で入力してください',
            ),
        ),
    );

    public function set($inputData, $two = null) {
        if (is_array($inputData)) {
            if ( ! empty($inputData['User']['password'])) {
                $hash = AuthComponent::password($inputData['User']['password']);
                $inputData['User']['password'] = $hash;
            }
        }

        // 入力チェック用にパラメータを設定
        parent::set($inputData, $two);
    }

    /**
     * 管理者情報を取得します。
     *
     * @param string $userId 検索対象ユーザID
     * @param array $statusConditions ユーザID以外の検索条件
     * @return array 検索したユーザ情報
     * @throws Exception 検索したユーザが存在しない場合
     */
    public function getInfo($userId, $statusConditions = array(USER_STATUS_ENABLE)) {
        $conditionList = array(
            'conditions' => array(
                'id' => $userId,
                'status' => $statusConditions,
            ),
        );

        if (empty($statusConditions)) {
            unset($conditionList['conditions']['status']);
        }

        $userInfo = $this->find('all', $conditionList);
        if (empty($userInfo)) {
            throw new Exception("{$userId} ユーザが無効になっています");
        }

        return $userInfo;
    }

    /**
    * セレクトボックス用にユーザーリストを取得します
    * @param number $type どの種類のリストを取得するか指定します。
    */
    public function getOptionsArray($type=USER_TYPE_NONE) {
        $conditionList = array(
            'fields' => array('User.id', 'User.user_name'),
            'conditions' => array(
                'type' => $type,
            ),
        );

        $results = $this->find('all', $conditionList);
        $list = array();
        foreach ($results as $result) {
            $id = $result['User']['id'];
            $user_name = $result['User']['user_name'];
            // 会社名の取得
            if (count($result['UserDetail']) < 1) {
                $company_name = '';
            } else {
                $company_name = $result['UserDetail'][0]['company_name'];
            }
            $company_name = $company_name ? '[ ' . $company_name . ' ] ' : '';

            $list[$id] = $company_name . $user_name;
        }

        return $list;
    }

    /**
     * 最終ログイン日時を更新します。
     *
     * @throws Exception データベースの更新に失敗した場合
     */
    public function updateLastLogin() {

        // 登録者のIDを設定する
        $params['User']['id'] = AuthComponent::user('id');
        $params['User']['last_login'] = date('Y-m-d H:i:s');

        // トランザクションをONにして登録開始。
        $this->begin();

        if ( ! $this->save($params['User'], array('validate' => false))) {
            throw new Exception('最終ログイン日付更新失敗::' . print_r($params, true));
        }

        $this->commit();
    }

    /**
     * 基本情報にデータを保存します.
     * @param string $data dtb_userに保存するデータ
     */
    public function saveData($parent_id=null, $data) {
        if (is_null($parent_id)) {
            $parent_id = AuthComponent::user('id');
        }

        if (is_null($data)) {
            return false;
        }

        $this->set($data);

        $this->begin();
        $result = false;
        $this->loadModel('UserDetail');
        if ( ! $this->save()) {
            // ロールバック
            $this->rollback();
            $result = false;

        } else {
            // 保存したユーザーIDを取得します。
            $user_id = $this->getLastInsertID();

            if ($data['User']['type'] == USER_TYPE_KO) {
                // 子属性の場合リレーション作成
                $result = $this->UserRelation->saveData($parent_id, $user_id);
                // 詳細情報の作成
                $setItem = array(
                    'user_id' => $user_id,
                );
                if ( ! $this->UserDetail->save($setItem)) {
                    // ロールバック
                    $this->rollback();
                    $result = false;
                }

                // 対応言語の保存
                $this->loadModel('UserLang');
                if ( ! $this->UserLang->saveData($user_id, $data)) {
                    // ロールバック
                    $this->rollback();
                    $result = false;
                }

            } else {
                // 詳細情報の作成
                $setItem = array(
                    'user_id' => $user_id,
                    'company_name' => $data['UserDetail']['company_name'],
                );
                if ($this->UserDetail->save($setItem)) {
                    // ロールバック
                    $this->rollback();
                    $result = false;
                }
            }
        }
        $this->commit();

        return $result;
    }

}
