<?php
App::uses('AppManagerController', 'Controller');
/**
* 言語マップ画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class LanguageController extends AppManagerController {
    // ページングセットアップ
    public $paginate = array(
    );

    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();

        $this->loadModel('LangMap');

        // listsメソッドを、listとして扱う
        if ($this->action == "list") {
            $this->action = "lists";
        }

        // ブラックホールコールバック指定
        $this->Security->blackHoleCallback = 'blackhole';
    }

    /**
    * トップ画面表示
    * @access  public
    */
    public function index() {
    }

    /**
    * リスト表示
    * @access  public
    */
    public function lists() {
        $list = $this->paginate('LangMap');
        $this->set('list', $list);

        $this->render('list');
    }

    /**
    * 登録画面表示
    * @access  public
    */
    public function add() {
        if ($this->request->is('post')) {
            if ( ! $this->LangMap->save($this->request->data)) {
                $this->Session->setFlash(__('言語マップの登録に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('言語マップを登録しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect('list');
            }
        }
    }

    /**
    * 編集画面表示
    * @access  public
    */
    public function edit($id) {
        if (empty($id)) {
            $this->Session->setFlash(__('言語マップの情報が取得出来ません。'), 'default', array('class' => 'alert alert-danger'));
                $this->redirect('list');
        }

        if ( ! $this->request->is('post')) {
            $this->request->data = $this->LangMap->getInfo($id);

        } else {
            if ( ! $this->LangMap->save($this->request->data)) {
                $this->Session->setFlash(__('言語マップの登録に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('言語マップを登録しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect('list');
            }
        }
    }

    public function del($id) {
        if (empty($id)) {
            $this->response->body(json_encode(array('status' => '0')));
            return;
        }

        $this->autoRender = false;
        $this->response->type('json');
        if ( ! $this->LangMap->delete($id)) {
            $this->response->body(json_encode(array('status' => '0')));
        } else {
            $this->response->body(json_encode(array('status' => 'success')));
        }
        return;
    }

    /**
     * ブラックホールコールバック
     */
    public function blackhole($type) {
        switch ($type) {
            case 'csrf':
            $this->Session->setFlash(__('不正な送信が行われました。'), 'default', array('class' => 'alert alert-danger'));
                $this->redirect(array('action' => 'list'));
                break;
            default:
                $this->redirect(array('action' => 'list'));
                break;
        }
    }

}
