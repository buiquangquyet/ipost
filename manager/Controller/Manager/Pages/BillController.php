<?php
App::uses('AppManagerController', 'Controller');
/**
* 発行ID一覧画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class BillController extends AppManagerController {

    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();

        $this->Security->csrfCheck = false;
        $this->Security->validatePost = false;
    }

    /**
    * トップ画面表示
    * @access  public
    */
    public function download() {
        $this->loadModel('User');
        $this->set('parentList', $this->User->getOptionsArray(USER_TYPE_OYA));

        // 年の選択ボックス
        $optYear = array();
        for ($i=2010; $i <= date('Y'); $i++) $optYear[$i] = $i;
        $this->set('optYear', $optYear);

        // 月の選択ボックス
        $optMonth = array();
        for ($i=1; $i <= 12; $i++) $optMonth[$i] = sprintf("%02d", $i).'月';
        $this->set('optMonth', $optMonth);

        // ダウンロード処理
        if ($this->request->is('post')) {
            $year = $this->request->data['Bill']['year'];
            $month = $this->request->data['Bill']['month'];
            $from = $year.'-'.$month.'-01';

            $agent_title   = __('代理店ID') . ',' . __('代理店名') . ',' . __('メールアドレス') . ',' . __('作成日') . "\r\n";
            $client_title  = __('クライアントID') . ',' . __('クライアント名') . ',' . __('メールアドレス') . ',' . __('作成日') . "\r\n";

            $parentList = $this->User->getInfo($this->request->data['Bill']['parent_id']);
            $parentInfo = $parentList[0];
            $csv_text = $agent_title;
            $csv_text .= $parentInfo['User']['id'] . ',';
            $csv_text .= $parentInfo['User']['user_name'] . ',';
            $csv_text .= $parentInfo['User']['email'] . ',';
            $csv_text .= $parentInfo['User']['created'] . "\r\n";


            $sql = 'SELECT * FROM `dtb_user_relations` AS `relation` LEFT JOIN `dtb_users` AS `user` ON `relation`.`user_id`=`user`.`id`
                    WHERE `relation`.`parent_id`='.$this->request->data['Bill']['parent_id'];

            switch ($this->request->data['Bill']['type']) {
                case 0: // 以前
                    $sql .= ' AND `user`.`created` <= CONCAT(last_day(\'' . $from . '\'),\' 23:59:59\')';
                    $mode_text = __('以前');
                    break;
                case 1: // 以降
                    $sql .= ' AND `user`.`created` >= \'' . $from . ' 00:00:00\'';
                    $mode_text = __('以降');
                    break;
                case 2: // のみ
                    $sql .= ' AND `user`.`created` BETWEEN CONCAT(\'' . $from . '\',\' 00:00:00\') AND CONCAT(last_day(\'' . $from . '\'),\' 23:59:59\')';
                    $mode_text = __('のみ');
                    break;
            }

            $results = $this->User->query($sql);
            $csv_text .= $client_title;
            foreach ((array)$results as $key => $result) {
                $csv_text .= $result['user']['id'] . ',';
                $csv_text .= $result['user']['user_name'] . ',';
                $csv_text .= $result['user']['email'] . ',';
                $csv_text .= $result['user']['created'] . "\r\n";
            }
            $csv_text .= "\r\n";

            // CSVファイル送信処理
            $fileName = '【' . $parentInfo['UserDetail'][0]['company_name'] . '】' . $parentInfo['User']['user_name'] . '_' . $year . '_' . $month . $mode_text . ".csv";
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . $fileName);
            echo mb_convert_encoding($csv_text, 'SJIS-win', 'UTF-8');
            exit();
        }
    }

}
