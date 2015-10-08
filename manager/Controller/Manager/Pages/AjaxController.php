<?php
App::uses('AppManagerController', 'Controller');
/**
* 各種情報登録用AJAXコントローラ.
*/
class AjaxController extends AppManagerController {
    public $uses = array('Ajax');

    /**
     * 事前処理.
     */
    public function beforeFilter() {
        $this->autoRender = false;
        $this->Security->csrfCheck = false;
        $this->Security->validatePost = false;
        parent::beforeFilter();
    }

    /**
     * 登録処理.
     */
    public function regist($id=null) {
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
