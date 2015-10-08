<?php
App::uses('AppAgentController', 'Controller');
/**
* 各種情報登録用AJAXコントローラ.
*/
class AjaxController extends AppAgentController {
    public $uses = array('Ajax');

    /**
     * 事前処理.
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->autoRender = false;
        $this->Security->csrfCheck = false;
        $this->Security->validatePost = false;
    }

    /**
     * 登録処理.
     */
    public function regist($id=null) {
        $this->log(__LINE__ . '::' . __METHOD__ . '::' . $id, 'debug');
        if (is_null($id)) {
            $id = AuthComponent::user('id');
        }

        try {


            $result = $this->Ajax->dispatchSaveData($id, $this->request->data);

            echo json_encode(array(
                "code" => "1",
                "result" => $result,
            ));

        } catch(ValidateException $e) {
            echo json_encode(array(
                "code" => "2",
                "message" => json_decode($e->getMessage())
            ));
        }
    }
}
