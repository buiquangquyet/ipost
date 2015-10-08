<?php
App::uses('AppRegistController', 'Controller');
App::uses( 'CakeEmail', 'Network/Email');
/**
* クライアントアカウント画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class ClientController extends AppRegistController
{
    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter()
    {
        parent::beforeFilter();

        // ブラックホールコールバック指定
        $this->Security->blackHoleCallback = 'blackhole';
    }

    /**
    * 登録
    * @access  public
    * @param number $id
    */
    public function regist($id=1)
    {
        $this->set('userId', $id);

        if ($this->request->is('post'))
        {
        }
    }

    /**
     * ブラックホールコールバック
     */
    public function blackhole($type)
    {
        switch ($type)
        {
            case 'csrf':
                $this->Session->setFlash(__('不正な送信が行われました'));
                $this->redirect(array('controller' => 'client', 'action' => $this->action));
                break;
            default:
                $this->redirect(array('controller' => 'client', 'action' => 'add'));
                break;
        }
    }

    /**
    * メール送信処理
    */
    private function sendEmail($data=null)
    {
        $email = new CakeEmail('localhost'); // インスタンス化
        $email->from( array('support3@hiropro.co.jp' => 'iPost Enterprise運営事務局')); // 送信元
        $email->to($data['User']['email']); // 送信先

        $email->subject('メールタイトル'); // メールタイトル

        $email->emailFormat('text'); // フォーマット
        $email->template('client_add', 'default'); // テンプレートファイル
        $email->viewVars(compact('data')); // テンプレートに渡す変数

        $email->send(); // メール送信
    }

}
