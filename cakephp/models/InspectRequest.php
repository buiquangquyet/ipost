<?php
App::uses('AppModel', 'Model');
/**
* 申請状況に関するモデルクラスです。
*/
class InspectRequest extends AppModel {

    public function getInfo($userId, $status=null) {
        $conditionList = array(
            'conditions' => array(
                'user_id' => $userId,
                'status' => $status,
            ),
        );
        if (empty($status)) {
            unset($conditionList['conditions']['status']);
        }
        return $this->find('all', $conditionList);
    }

    /**
    * 申請アプリのリストを取得します。
    * @param number $status 申請状態を指定します。
    * @param number $agentId 担当代理店の指定ができます
    */
    public function getList($status=0, $agentId=null) {
        if ( ! is_null($agentId)) {
            // 代理店の指定があった場合
            $this->loadModel('UserRelation');
            $userIds = $this->UserRelation->getUserList($agentId);
            $idList = array();
            foreach ($userIds as $key => $value) {
                array_push($idList, $value['UserRelation']['user_id']);
            }

            $conditionList = array(
                'conditions' => array(
                    'user_id' => $idList,
                    array('OR' => array(
                        array('agent_result' => null),
                        array('agent_result' => 0),
                        array('agent_result' => 1),
                    )),
                    array('OR' => array(
                        array('master_result' => null),
                        array('master_result' => 0),
                        array('master_result' => 1),
                    )),
                ),
                'order' => array(
                    'status' => 'asc',
                    'created' => 'desc',
                ),
            );

        } else {
            // 代理店の指定がなかった場合は、申請全部取得
            $conditionList = array(
                'conditions' => array(
                    'status' => $status,
                    'agent_result' => 1,
                ),
            );
        }
        return $this->find('all', $conditionList);
    }
}
