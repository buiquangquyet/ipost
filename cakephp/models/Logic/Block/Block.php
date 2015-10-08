<?php

App::uses('BasicInfoLogic', 'Model');

/**
* ブロック情報のロジックを記述するモデルです。
*/

class Block extends BasicInfoLogic {

    protected $infoName = 'block_info';

    const BLOCK_NAME_IMAGE   = 'image';
    const BLOCK_NAME_TOP     = 'top'; // エンタ版での名称
    const BLOCK_NAME_TOPIC   = 'topic';
    const BLOCK_NAME_NEWS    = 'news';
    const BLOCK_NAME_MENU    = 'menu';
    const BLOCK_NAME_COUPON  = 'coupon';
    const BLOCK_NAME_MAP     = 'map';
    const BLOCK_NAME_GPS     = 'gps'; // エンタ版での名称
    const BLOCK_NAME_TEL     = 'tel';
    const BLOCK_NAME_SNS     = 'sns';
    const BLOCK_NAME_CMS     = 'cms';
    const BLOCK_NAME_WEBVIEW = 'webview';
    const BLOCK_NAME_WEB     = 'web'; // エンタ版での名称
    const BLOCK_NAME_MARGIN  = 'margin';

    /**
    * プレビューを表示する。
    */
    public function getPreviewData($id) {
        $data = $this->getData($id);

        // メニューの情報を置換する。
         App::uses('MenuItem', 'Model');
         $menu = new MenuItem();
         $data['menu'] = $menu->mergeMenuInfo($id, $data['menu']);

        // ニュースの情報を置換する。
        App::uses('News', 'Model');
        $news = new News();
        $data['news']['info'] = $news->getPreviewData($id);

        // クーポン情報を取得してマージ
        App::uses('Coupon', 'Model');
        $coupon = new Coupon();
        $data['coupon'] = $coupon->mergeCouponInfo($id, $data['coupon']);

        // 非表示になっているやつを削除。
        $returnList = array();
        foreach($data as $key => $value) {
            if ($value['del'] != 1) {
                $returnList[$key] = $value;
            }
        }

        return $returnList;
    }

    public function getData($id) {
        $basicInfo = parent::getData($id);
        $basicInfo = json_decode($basicInfo, true);
        return $basicInfo;
    }

    public function set($inputData, $two = null) {
        // 入力チェック用にパラメータを設定
        parent::set($inputData, $two);
    }

    public function deleteData($userId, $target) {

    }

    /**
     * 各ロジックごとにデータを整形する場合には、オーバーライドしてください。
     *
     * @param
     */
    protected function formatEachLogic($info, $data) {
        return json_encode($data);
    }

    /**
    * 登録スル。
    */
    public function regist($userId, $params) {

        // 保存する内容の種類を分離
        $key = key($params['Block']);
        // イメージの時
        if ($key == 'image') {
            $pos = key($params['Block']['image']['images']);

            // イメージの保存
            App::uses('BlockImage', 'Model');
            $blockImage = new BlockImage();
            $params['Block']['image']['images'][$pos]['pos'] = $pos;
            $blockImage->saveData($userId, $params['Block']['image']['images'][$pos]);

            // 値を設定
            $data = $this->getData($userId);
            $params['Block']['image']['images'][$pos]['image'] = $data['image']['images'][$pos]['image'];
            $params['Block']['image']['images'][$pos]['date'] = date('Y/m/d');//date('Y年m月d日');
            $data['image']['images'][$pos] = $params['Block']['image']['images'][$pos];

        } else {
            // その他の時
            // 情報取得
            $data = $this->getData($userId);
            // マージ
            $key = key($params['Block']);
            $data[$key] = array_merge($data[$key], $params['Block'][$key]);
        }

        $this->saveData($userId, $data);
    }

    /**
    * イメージの削除
    */
    public function deleteImage($userId, $target) {
        // 情報を取得する。
        $data = $this->getData($userId);

        // 初期情報を取得
        $blockInfo = Configure::read('block_info');
        $initialImage = $blockInfo['image']['images'][0];

        $data['image']['images'][$target] = $initialImage;

        // 保存
        $this->saveData($userId, $data);
    }

    /**
    * 表示・非表示の切り替え
    */
    public function enable($userId, $params) {

        // 情報を取得する。
        $data = $this->getData($userId);
        $key = key($params['Block']);
        $data[$key]['del'] = $params['Block'][$key]['del'];

        // 保存
        $this->saveData($userId, $data);
    }

    /**
    * 位置情報変更
    */
    public function movePos($userId, $target, $type) {

        // 情報を取得する。
        $data = $this->getData($userId);

        // キーの一覧を取得
        $keys = array_keys($data);

        // 位置情報。見つからなかったら何もしないで戻る
        $pos = array_search($target, $keys);

        if ($pos === FALSE) {
            return;
        }

        // 並び替え
        if ($type == 'forward') {
            // 対象を一つ前へ移動。いちばん先頭を移動しようとしたら、そのまま戻る。
            if ($pos-1 < 0) {
                return;
            }

            array_splice($keys, $pos-1, 0, $keys[$pos]);
            unset($keys[$pos + 1]);

        } else if($type == 'backword'){

            // 対象を1つ後ろへ移動
            if ($pos+1 >= count($keys)) {
                return;
            }

            array_splice($keys, $pos+2, 0, $keys[$pos]);
            unset($keys[$pos]);

        }

        // データの入れ替え
        $updateData = array();
        foreach($keys as $key) {
            $updateData[$key] = $data[$key];
        }

        // 保存
        $this->saveData($userId, $updateData);
    }

}