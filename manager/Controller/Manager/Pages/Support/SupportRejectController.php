<?php
App::uses('AppManagerController', 'Controller');
/**
* サポート＞リジェクト項目画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class SupportRejectController extends AppManagerController {

    // ページングセットアップ
    public $paginate = array(
        'InspectRejectItem' => array(
            'limit' => 10,
            'order' => array(
                'InspectRejectItem.id' => 'asc'
            ),
        ),
    );

    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();

        $this->loadModel('InspectRejectItem');

        // listsメソッドを、listとして扱う
        if ($this->action == "list") {
            $this->action = "lists";
        }
    }

    /**
    * リジェクト項目管理
    * @access  public
    */
    public function lists() {
        $list = $this->paginate('InspectRejectItem', array('type =' =>  InspectRejectItem::REJECT_TYPE_NORMAL));
        $this->set('list', $list);

        $this->render('list');
    }

    /**
    * 追加
    * @access  public
    */
    public function add() {
        if ($this->request->is('post')) {
            // データベースに追加保存
            $this->InspectRejectItem->set($this->request->data);
            if ( ! $this->InspectRejectItem->save()) {
                $this->Session->setFlash(__('リジェクト項目の登録に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('リジェクト項目を登録しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'list'));
            }
        }
    }

    /**
    * 編集
    * @access  public
    */
    public function edit() {
        $id = $this->request->params['id'];
        if (is_null($id)) {
            $this->Session->setFlash(__('リジェクト項目IDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }

        $this->InspectRejectItem->id = $id;

        if ( ! $this->request->is('get')) {
            if ( ! $this->InspectRejectItem->save($this->request->data)) {
                $this->Session->setFlash(__('リジェクト項目の更新に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('リジェクト項目を更新しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'list'));
            }
        }

        $itemInfo = $this->InspectRejectItem->read();
        $this->request->data = $itemInfo;
        $this->set('itemInfo', $itemInfo);
    }

    /**
    * 削除
    * @access  public
    */
    public function delete() {
        $id = $this->request->params['id'];
        if (is_null($id)) {
            $this->Session->setFlash(__('リジェクト項目IDが指定されていません。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array('action' => 'list'));
        }
        $this->InspectRejectItem->id = $id;

        if ( ! $this->request->is('get')) {
            if ( ! $this->InspectRejectItem->delete($id)) {
                $this->Session->setFlash(__('リジェクト項目の削除に失敗しました。'), 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Session->setFlash(__('リジェクト項目を削除しました。'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'list'));
            }
        }

        $itemInfo = $this->InspectRejectItem->read();
        $this->request->data = $itemInfo;
        $this->set('itemInfo', $itemInfo);
    }

}
