<?php
App::uses('AppAgentController', 'Controller');
/**
* アプリ情報画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class AppliController extends AppAgentController {

    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Security->validatePost = false;
    }

    /**
    * 詳細表示
    * @access  public
    * @param number $id
    */
    public function info($id=null, $lang=null) {
        $this->loadModel('Store');

        // todo: 必ず直す必要をなくすように変更しました。
        $this->set('admin_domain', str_replace('agent.', 'admin.', FULL_BASE_URL));

        $this->set('admin_id', $id);
        $this->set('storeInfo', $this->processingForDisplay($this->Store->getData($id)));

        $current_status = $lang;
        $this->set('current_status', $current_status);

        $lang_setting = array('' => '選択してください。');
        $flag_name = Configure::read('flag_name');

        $this->loadModel('UserLang');
        $langInfo = $this->UserLang->getList($id);
        foreach ($langInfo as $key => $lang) {
            $lang_setting[$lang['UserLang']['lang']] = $flag_name[$lang['UserLang']['lang']];
        }
        $this->set('lang_setting', $lang_setting);
    }

    /**
     * 表示用に加工制御するメソッド.
     *
     * @param $displayData 画面に出力するデータ群 ( JSON-ENCデータ )
     * @return string 加工した画面に出力するデータ群 ( JSON-ENC データ )
     */
    protected function processingForDisplay($displayData) {
        // JSONデータをデコード処理
        $decodeData = json_decode($displayData);

        // 都道府県にIDが入っていたら表示用に加工
        if ( ! empty($decodeData->profile->pref))
        {
            $prefList = Configure::read('PrefList');
            $decodeData->profile->pref_disp = $prefList[$decodeData->profile->pref];
        }

        return json_encode($decodeData);
    }

}
