<?php
App::uses('AppController', 'Controller');
/**
* 登録フォーム基板コントローラ
*/
class AppRegistController extends AppController
{
    public $components = array(
        'Security',
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->layout = 'regist/default';
    }

    /**
     * @param $displayData
     * @return mixed
     */
    protected function processingForDisplay($displayData)
    {
        return $displayData;
    }

}
