<?php
App::uses('AppManagerController', 'Controller');
/**
* アプリ情報画面のコントローラです。
* @author    Yoshitaka Kitagawa
*/
class AppliController extends AppManagerController {

    /**
    * 前処理
    * @access  public
    */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
    * 詳細表示
    * @access  public
    * @param number $id
    */
    public function info($id=null, $lang=null) {
        $this->loadModel('Store');

        $this->set('admin_id', $id);
        $this->set('admin_domain', str_replace('mgr.', 'admin.', FULL_BASE_URL));
        $this->set('storeInfo', $this->processingForDisplay($this->Store->getData($id)));

        $current_status = $lang;
        $this->set('current_status', $current_status);

        $lang_setting = array('' => '選択してください。');
        $flag_name = Configure::read('LanguagesList');

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
