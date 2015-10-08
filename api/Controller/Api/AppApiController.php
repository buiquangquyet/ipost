<?php
App::uses('AppController', 'Controller');
/**
* API基底クラスです。
*/
class AppApiController extends AppController {

	protected $lang = '';

    public $components = array(
        'Session',
//         'Security',
        'Cookie'
    );

    // ユーザーID
    protected $user_id = null;

    /**
    * 前処理
    */
    public function beforeFilter() {
        parent::beforeFilter();
		error_reporting(0);
        $this->autoRender = false; // CTPファイルは使用しません。
        $this->response->type('json'); // Content-TypeをJSONに指定します。

        // パラメータをユーザーIDをとして取得します。
        if ( ! empty($this->request->params['id'])) {
            $this->user_id = $this->request->params['id'];
        }

        $this->setupLangSetting();
    }

    /**
    * 言語設定
    */
    private function setupLangSetting() {
        // 言語設定。設定がされていたら、Cookieに設定してリダイレクト
        if ( ! empty($this->request->query['lang'])) {
            $this->Cookie->write('lang', $this->request->query['lang']);
            // return;
        }

        // クッキーに情報が入っていたら、情報を切り替え
        $langValue = $this->Cookie->read('lang');
        if ( ! empty($langValue)) {
            $this->lang = $langValue;
        }

        $languages = Configure::read('multilanguages');
        $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' this->lang => ' . $this->lang, LOG_DEBUG);

        if (empty($this->lang)) {
            Configure::write('Config.language', $languages[Configure::read('Config.language')]);
        } else {
            Configure::write('Config.language', $this->lang);
        }
        Configure::load('ipost.php');
    }

    /**
    * 画像を一時領域に保存します。
    */
    public function registTmpImage($fileName, $fullPath) {
        // 画像のサイズを変更する。

        // 一時保存エリアに移動しておく
        // まずはファイルの拡張子を取得する。
        // ファイル名を生成して、tmpのディレクトリへ移動する。
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $tmpFileName = Security::hash(time() . rand(), 'sha1', true) . '.' . $ext;
        $this->log(__LINE__ . '::' . __METHOD__ . '::' . '画像の一時ファイル移動先-->' . WWW_ROOT . MEDIA_TMP_DIR . '/' . $tmpFileName, LOG_DEBUG);
        if (!move_uploaded_file($fullPath, WWW_ROOT . MEDIA_TMP_DIR . '/' . $tmpFileName)) {
            throw new Exception('ファイルの移動に失敗しました。');
        }

        return $tmpFileName;
    }

    /**
    * 画像をユーザのディレクトリに移動します。
    */
    public function moveImage() {
        $this->log(__LINE__ . '::' . __METHOD__ . '::' . '画像を登録開始-->' . print_r($this->request->data, true), LOG_DEBUG);

        // 引数チェック　空っぽだったら例外
        if (empty($this->request->data['tmpFileName'])) {
            throw new Exception(json_encode('画像が指定されていません'));
        }

        // 引数に指定してあるファイル名が存在するか確認します。存在しなければ例外
        $this->log(__LINE__ . '::' . __METHOD__ . '::' . '画像をチェック-->' . WWW_ROOT . MEDIA_TMP_DIR . '/' . $this->request->data['tmpFileName'], LOG_DEBUG);
        $fileExists = file_exists(WWW_ROOT . MEDIA_TMP_DIR . '/' . $this->request->data['tmpFileName']);
        if (!$fileExists) {
            throw new Exception(json_encode('画像の一時ファイルが見つかりません。'));
        }

        // ファイルをユーザのディレクトリに移動する
        // もし、ユーザのディレクトリが存在しなければ作成してから移動する。
        $this->log(__LINE__ . '::' . __METHOD__ . '::' . 'ディレクトリチェック-->' . WWW_ROOT . MEDIA_UPLAOD_DIR_BASE . '/' . AuthComponent::user('id'), LOG_DEBUG);
        $dirExists = file_exists(WWW_ROOT . MEDIA_UPLAOD_DIR_BASE . '/' . AuthComponent::user('id'));
        if (!$dirExists) {
            // ユーザのディレクトリが無いので作成。作成失敗したら例外
            $mkDirResult = mkdir(WWW_ROOT . MEDIA_UPLAOD_DIR_BASE . '/' . AuthComponent::user('id'));
            if (!$mkDirResult) {
                throw new Exception(json_encode('ユーザディレクトリの作成に失敗しました'));
            }
        }

        //　画像の拡張子を取得する
        $ext = pathinfo(WWW_ROOT . MEDIA_TMP_DIR . '/' . $this->request->data['tmpFileName'], PATHINFO_EXTENSION);

        // 移動
        $userFileName = Security::hash(time() . rand(), 'sha1', true) . '.' . $ext;
        $this->log(__LINE__ . '::' . __METHOD__ . '::' . '移動先ファイル-->' . WWW_ROOT . MEDIA_UPLAOD_DIR_BASE . '/' . AuthComponent::user('id') . '/' . $userFileName, LOG_DEBUG);
        $moveResult = rename(WWW_ROOT . MEDIA_TMP_DIR . '/' . $this->request->data['tmpFileName'], WWW_ROOT . MEDIA_UPLAOD_DIR_BASE . '/' . AuthComponent::user('id') . '/' . $userFileName);
        if(!$moveResult) {
            throw new Exception(json_encode('ファイルの移動に失敗しました。'));
        }

        return $userFileName;
    }

    /**
    * APIのJSONの仕様を調整
    * @param $displayData
    * @return mixed
    */
    protected function processingForDisplay($displayData)
    {
        return $displayData;
    }

    // TODO: 住所によって戻り値が何パターン化確認しているので、要調整が必要になる時があるかもしれないです。
    /**
     * 住所から緯度・経度を取得 (by Google Map API V3)
     * @param string address
     * @return array lat:緯度/lng:経度
     */
    public function geocode($address) {
        $rs = array('lat' => '', 'lng' => '');

        if (empty($address)) {
            return $rs;
        }

        try {
            $address = urlencode($address);
            $geo_search_url = 'http://maps.googleapis.com/maps/api/geocode/json?sensor=true&address=' . $address;

            $geo_data = file_get_contents($geo_search_url);
            $data = json_decode($geo_data, true);

            if (isset($data['status']) and $data['status'] == 'OK') {
                $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' geo result count:'.count($data['results']), LOG_DEBUG);

                if (count($data['results']) > 0) {
                    $geo_location = $data['results'][0]['geometry']['location'];

                } else {
                    $geo_location = $data['results']['geometry']['location'];
                }

                $rs['lat'] = $geo_location['lat'];
                $rs['lng'] = $geo_location['lng'];
            }

        } catch (\Exception $e) {
            $this->log(__LINE__ . '::' . __METHOD__ . '::' . ' geocode getting failed. => ' . $e->getMessage(), LOG_ERR);
        }
        return $rs;
    }

    /**
    * /media/:id のURLを取得します。
    * @param number $id
    */
    public function getMediaUrl($id) {
        if (empty($id)) {
            return '';
        }
        $url = str_replace('api.', 'admin.', FULL_BASE_URL);
        return $url . DS . 'media' . DS . $id;
    }

    /**
    * /media/image/:image_id のURLを取得します。
    * @param number $imageId
    */
    public function getImageUrl($imageId) {
        if (empty($imageId)) {
            return '';
        }
        $url = FULL_BASE_URL;//str_replace('api.', 'admin.', FULL_BASE_URL);
        return $url . DS . 'media' . DS . 'image' . DS . $imageId;
    }

}