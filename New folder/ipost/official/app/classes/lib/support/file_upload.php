<?php
namespace Support;

use \Fuel\Core;
/**
 * File_Upload
 *
 * ファイルアップロード関連のサポートクラス
 * ※アプリ管理画面からのファイルアップロードに特化した仕様にしてます
 *
 * @author    K.ITAHANA
 */
class File_Upload
{
    const CONF_FILE_KEY = 'original_upload';

    const TMP_FILE_PREFIX = 'tmp_';

    /**
     * config/original_upload.php内のArrayキー値
     *
     * @var string
     */
    protected static $_type = null;

    /**
     * クライアントID
     * @var string
     */
    protected static $_client_id = null;

    /**
     * タイムスタンプ（※ファイル名で使用)
     * @var unix_timestamp
     */
    protected static $_timestamp = null;

    /**
     * アップロードファイルのMIME-TYPE
     * @var string
     */
    protected static $_mime_type = null;

    /**
     * アップロードファイルの拡張子
     * @var string
     */
    protected static $_extension = '';

    /**
	 * Initialize
	 */
	public static function _init()
	{
        // Initialization process when you load class here.
	}

    /**
     * コンストラクタ
     *
     * @param string $client_id
     * @param string $type  config/original_upload.php内のArrayキー値
     */
	function __construct($client_id, $type)
	{
	    if (is_null($client_id) or empty($client_id))
	    {
            throw new \Exception('client id is null.');
	    }
	    self::$_client_id = $client_id;
        if (is_null($type))
        {
            throw new \Exception('type is null.');
        }
        self::$_type = $type;

        self::$_timestamp = time();

        \Config::load(self::CONF_FILE_KEY, true);
	}

	/**
	 * 一時画像ファイル保存
	 */
	public function save_tmp_file()
	{
	    // 不要な一時ファイルを削除
	    static::remove_tmp_files();
        // アップ画像ファイルを一時ファイル名で保存
	    static::save_upload_file(static::save_dir(), static::tmp_file_name());
	    // 画像リサイズ
	    static::resize();
	}

	/**
	 * pemファイル保存
	 */
	public function save_pem_file()
	{
        // アップされたpemファイルを指定ファイル名で保存
        $file_name = static::file_name(static::tmp_file_name());
	    static::save_upload_file(static::save_dir(), $file_name, false);
	}

	/**
	 * アイコン画像一時保存
	 */
	public function save_icon_tmp_file()
	{
	    static::save_upload_file(static::save_dir(), static::tmp_file_name());
	    static::resize();
	}

	/**
	 * アイコン画像保存
	 */
	public function save_icon_file()
	{
	    $file_name = static::file_name(static::tmp_file_name());
	    static::save_upload_file(static::save_dir(), static::tmp_file_name());
	}

	/**
	 * 画像リサイズ
	 */
	private function resize()
	{
	    $size = static::conf_get('resize');
	    if (is_null($size))
	    {
	        return;
	    }
	    $file = static::save_dir().static::tmp_file_name();
	    \Image::load($file)
	        ->crop_resize($size['w'], $size['h'])
	        ->save($file, 0666);
	}

	/**
	 * 画像ファイル：削除
	 *
	 * @param string $file_name
	 */
	public function delete_file($file_name)
	{
	    if (is_null($file_name) or empty($file_name))
	    {
	        return;
	    }
	    $file = static::save_dir().$file_name;
	    if (file_exists($file))
	    {
	        \File::delete($file);
	    }
	}

	/**
	 * 画像ファイル保存
	 *
	 * 実際には一時保存ファイルをリネーム処理
	 *
	 * @param string $tmp_file_name
	 * @throws \RuntimeException
	 */
	public function save_file($tmp_file_name, $new_file_name=null)
	{
	    $save_dir = static::save_dir();
	    $tmp_file = $save_dir.$tmp_file_name;
	    if ( ! file_exists($tmp_file) or ! is_file($tmp_file))
	    {
            throw new \RuntimeException('rename target is invalid file format.');
	    }

	    if (is_null($new_file_name))
	    {
	        $new_file_name = static::file_name($tmp_file_name);
	    }
	    $new_file      = $save_dir.$new_file_name;
	    if ( ! rename($tmp_file, $new_file))
	    {
	        throw new \RuntimeException('file rename failed.');
	    }
	}

	/**
	 * 一時ファイル全削除
	 */
	public function remove_tmp_files()
	{
	    $tmp_prefix = 'tmp_';
	    foreach (glob(static::save_dir().$tmp_prefix.'*') as $file)
	    {
	        if ( ! is_file($file))
	        {
                continue;
	        }
	        unlink($file);
	    }
	}

	/**
	 * 一時ファイルリスト取得
	 *
	 * @return array
	 */
	public function get_tmp_files()
	{
	    $files = array();

	    $tmp_prefix = 'tmp_';
	    foreach (glob(static::save_dir().$tmp_prefix.'*') as $file)
	    {
	        if (is_file($file))
	        {
	            array_push($files, $file);
	        }
	    }

	    return $files;
	}

	/**
	 * アップロード画像の有無
	 *
	 * @return boolean
	 */
	public function upload_file_exists()
	{
	    if (isset($_FILES[static::conf_get('upload_key')]))
	    {
	        return $_FILES[static::conf_get('upload_key')]['error'] == UPLOAD_ERR_OK;
	    }
	    return false;
	}

    /**
     * アップ画像：ファイル保存
     *
     * @param string $save_dir
     * @param string $file_name
     * @param boolean $mime_check MIME_TYPE(image/*)チェック有無
     * @throws \RuntimeException
     * @throws RuntimeException
     */
	private function save_upload_file($save_dir, $file_name, $mime_check=true)
	{
	    $upload_key = static::conf_get('upload_key');
	    $max_size   = static::conf_get('max_size');

	    if (isset($_FILES[$upload_key]))
	    {
	        $error = $_FILES[$upload_key]['error'];

	        // 複数ファイルの同時アップロードチェック
	        if (is_array($error))
	        {
	            throw new \RuntimeException('Simultaneous upload of multiple files is not allowed.');
	        }

	        // エラーチェック
	        switch ($error) {
	            case UPLOAD_ERR_INI_SIZE:
	                throw new \RuntimeException('Size over error: max size => '.$max_size.'byte');
	            case UPLOAD_ERR_FORM_SIZE:
	                throw new \RuntimeException('Max size allowed by the form.');
	            case UPLOAD_ERR_PARTIAL:
	                throw new \RuntimeException('File is corrupted.');
	            case UPLOAD_ERR_NO_FILE:
	                throw new \RuntimeException('File has not been selected.');
	            case UPLOAD_ERR_NO_TMP_DIR:
	                throw new \RuntimeException('Tmp directory is not found.');
	            case UPLOAD_ERR_CANT_WRITE:
	                throw new \RuntimeException('Tmp data creation failed.');
	            case UPLOAD_ERR_EXTENSION:
	                throw new \RuntimeException('Extension is invalid.');
	        }

	        // アップ画像：ファイル名
	        $name     = $_FILES[$upload_key]['name'];
	        // アップ画像：一時ファイル名
	        $tmp_name = $_FILES[$upload_key]['tmp_name'];
	        // アップ画像：ファイルサイズ
	        $size     = $_FILES[$upload_key]['size'];
	        // アップ画像：拡張子
            self::$_extension = $this->get_ext();
	        // アップ画像：MIME-TYPE
	        self::$_mime_type = $this->get_mime_type();


	        // サイズ上限チェック
	        if ($size > $max_size)
	        {
	            throw new \RuntimeException('Size over error: max size => '.$max_size.'byte');
	        }

	        // 不正なファイルでないかチェック
	        if ( ! is_uploaded_file($tmp_name))
	        {
	            throw new \RuntimeException('uploaded file is invalid.');
	        }

	        // MIME-TYPEチェック
	        if ($mime_check)
	        {
    	        if (strpos(self::$_mime_type, 'image/') !== 0)
    	        {
    	            throw new \RuntimeException('uploaded file is invalid format.');
    	        }
	        }

	        // ディレクトリ正当性
	        $path = realpath($save_dir);
	        if ( ! $path)
	        {
	            \File::create_dir(dirname($save_dir), static::client_id());
	        }

	        // ファイル保存
	        if ( ! move_uploaded_file($tmp_name, $save_dir.$file_name))
	        {
                throw new \RuntimeException('uploaded file save failed.');
	        }

	        // ファイルパーミッション変更
	        if ( ! chmod($save_dir.$file_name, 0666))
	        {
	            throw new \RuntimeException('uploaded file permission change failed.');
	        }

	    }
        else
        {
            throw new RuntimeException('uploaded file is not found.');
        }
	}

	/**
	 * アップロードファイルのMIME-TYPE取得
	 * @throws \RuntimeException
	 * @return string
	 */
	private function get_mime_type()
	{
	    $tmp_name = $_FILES[static::conf_get('upload_key')]['tmp_name'];
	    $finfo = new \finfo(FILEINFO_MIME_TYPE);
	    if ( ! $finfo)
	    {
	        throw new \RuntimeException('MimeType is not found.');
	    }
	    return $finfo->file($tmp_name);
	}

	/**
	 * アップロードファイルの拡張子取得
	 * @return string
	 */
	private function get_ext()
	{
	    $name = $_FILES[static::conf_get('upload_key')]['name'];
	    return pathinfo($name, PATHINFO_EXTENSION);
	}

	/**
	 * アップ画像：保存先ディレクトリ
	 *
	 * @return string
	 */
    public function save_dir()
    {
        $c_id = static::client_id();
        $name = static::conf_get('save_dir');
        $name = str_replace('%%%client_id%%%', $c_id, $name);
        return $name;
    }

	/**
	 * アップ画像：一時保存ファイル名
	 *
	 * @return string
	 */
    public function tmp_file_name()
    {
        $time = self::$_timestamp;
        $c_id = static::client_id();
        $ext  = $this->get_ext();
        $name = static::conf_get('file_name');
        $name = str_replace('%%%time_stamp%%%', $time, $name);
        $name = str_replace('%%%client_id%%%',  $c_id, $name);
        $name = str_replace('%%%extension%%%',  $ext,  $name);
        $name = self::TMP_FILE_PREFIX.$name;
        return $name;
    }

    /**
     * アップ画像：保存ファイル名
     *
     * @return string
     */
    public function file_name($tmp_file_name)
    {
        return str_replace(self::TMP_FILE_PREFIX, '', $tmp_file_name);
    }

	/**
	 * 設定ファイルから指定キーの値を取得
	 *
	 * @return    string
	 */
    public function conf_get($key)
	{
	    $conf = \Config::get(self::CONF_FILE_KEY.'.'.self::$_type);
	    if ( ! array_key_exists($key, $conf))
	    {
	        return null;
	    }
	    return $conf[$key];
	}

	/**
	 * クライアントID取得
	 *
	 * @return string
	 */
	private function client_id()
	{
	    return self::$_client_id;
	}
}

/* end of file notification.php */
