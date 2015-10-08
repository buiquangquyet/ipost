<?php
/**
 * Root Controller
 *
 * @package  app
 * @extends  Basecontroller
 */
class Controller_Contact extends Basecontroller
{
    const VIEW_FILE_PREFIX      = 'official/contact/';
    const VIEW_FILE_PREFIX_EN   = 'official_en/contact/';
    const VIEW_FILE_PREFIX_HK   = 'official_hk/contact/';
    const VIEW_FILE_PREFIX_HKJ  = 'official_hkj/contact/';
    const VIEW_FILE_PREFIX_HKZH = 'official_hkzh/contact/';

    /**
     * @var カレントページ（※UI操作に使用)
     */
    protected static $_current_page = 'contact';

    /**
     * お問い合わせ：入力画面表示
     *
     * @access  public
     * @return  View
     */
    public function action_index()
    {
        if(Input::get('lang') == 'en')
        {
            return View::forge(self::VIEW_FILE_PREFIX_EN.'index.tpl');
        }
        elseif(Input::get('lang') == 'hk')
        {
            return View::forge(self::VIEW_FILE_PREFIX_HK.'index.tpl');
        }
        elseif(Input::get('lang') == 'hkj')
        {
            return View::forge(self::VIEW_FILE_PREFIX_HKJ.'index.tpl');
        }
        elseif(Input::get('lang') == 'hkzh')
        {
            return View::forge(self::VIEW_FILE_PREFIX_HKZH.'index.tpl');
        }
        else
        {
            return View::forge(self::VIEW_FILE_PREFIX.'index.tpl');
        }

    }

    /**
     * お問い合わせ：確認画面表示
     *
     * @access  public
     * @return  View
     */
    public function action_confirm()
    {
        if(Input::get('lang') == 'en')
        {
            // ---- 英語ページ用処理 ------------------------------------

            $view = View::forge(self::VIEW_FILE_PREFIX_EN.'confirm.tpl');

            if (Input::method() == 'POST')
            {
                $shop_name     = Input::post('shopname');
                if (empty($shop_name))
                {
                    $shop_name = '-- 未入力 --';
                }

                $input_contents = array(
                    'shop_name' => $shop_name,
                    'user_name' => Input::post('username'),
                    'mail'      => Input::post('mail'),
                    'question'  => Input::post('question')
                );
            }

        }
        elseif((Input::get('lang') == 'hk') or (Input::get('lang') == 'hkj') or (Input::get('lang') == 'hkzh'))
        {
            // ---- 香港i-Postの英語ページ、日本語ページ、広東語ページ用処理 ----------

            if (Input::get('lang') == 'hk')
            {
                // 英語語ページ用処理
                $view = View::forge(self::VIEW_FILE_PREFIX_HK.'confirm.tpl');
            }
            elseif(Input::get('lang') == 'hkj')
            {
                // 日本語ページ用処理
                $view = View::forge(self::VIEW_FILE_PREFIX_HKJ.'confirm.tpl');
            }
            else
            {
                // 広東語ページ用処理
                $view = View::forge(self::VIEW_FILE_PREFIX_HKZH.'confirm.tpl');
            }

            if (Input::method() == 'POST')
            {
                $shop_name     = Input::post('shopname');
                if (empty($shop_name))
                {
                    $shop_name = '-- 未入力 --';
                }

                $input_contents = array(
                    'shop_name' => $shop_name,
                    'user_name' => Input::post('username'),
                    'mail'      => Input::post('mail'),
                    'address'   => Input::post('address'),
                    'question'  => Input::post('question')
                );
            }

        }
        else
        {
            // ---- 日本語ページ用処理 ------------------------------------

            $view = View::forge(self::VIEW_FILE_PREFIX.'confirm.tpl');

            if (Input::method() == 'POST')
            {
                $shop_name     = Input::post('shopname');
                if (empty($shop_name))
                {
                    $shop_name = '-- 未入力 --';
                }

                $input_contents = array(
                    'pref'      => Input::post('add'),
                    'shop_name' => $shop_name,
                    'user_name' => Input::post('username'),
                    'mail'      => Input::post('mail'),
                    'question'  => Input::post('question')
                );
            }

        }

        $view->set('input_contents', $input_contents);

        return $view;

    }

    /**
     * お問い合わせ：お問い合わせ処理＆処理後画面表示
     *
     * @access  public
     * @return  View
     */
    public function action_exe()
    {

        if(Input::get('lang') == 'en')
        {
            // ---- 英語ページ用処理 ------------------------------------

            $view = View::forge(self::VIEW_FILE_PREFIX_EN.'exe.tpl');

            if (Input::method() == 'POST')
            {
                $input_contents = array(
                    'shop_name' => Input::post('shopname'),
                    'user_name' => Input::post('username'),
                    'mail'      => Input::post('mail'    ),
                    'question'  => Input::post('question')
                );
            }

            // メール送信 (TO:ヒロ企画)
            $email = \Email::forge();
            $email->from($input_contents['mail']);
            $email->to('support@hiropro.co.jp');
            $email->subject('i-Post 公式サイト(英語版)からのお問い合わせ');
            $email->body($this->get_mail_body_in_english($input_contents));

        }
        elseif((Input::get('lang') == 'hk') or (Input::get('lang') == 'hkj') or (Input::get('lang') == 'hkzh'))
        {
            // ---- 香港i-Postの英語ページ、日本語ページ、広東語ページ用処理 ----------

            if (Input::get('lang') == 'hk')
            {
                // 英語語ページ用処理
                $view = View::forge(self::VIEW_FILE_PREFIX_HK.'exe.tpl');
            }
            elseif(Input::get('lang') == 'hkj')
            {
                // 日本語ページ用処理
                $view = View::forge(self::VIEW_FILE_PREFIX_HKJ.'exe.tpl');
            }
            else
            {
                // 広東語ページ用処理
                $view = View::forge(self::VIEW_FILE_PREFIX_HKZH.'exe.tpl');
            }

            if (Input::method() == 'POST')
            {
                $input_contents = array(
                    'shop_name' => Input::post('shopname'),
                    'user_name' => Input::post('username'),
                    'mail'      => Input::post('mail'    ),
                    'address'   => Input::post('address'),
                    'question'  => Input::post('question')
                );
            }

            // メール送信 (TO:ヒロ企画)
            $email = \Email::forge();
            $email->from($input_contents['mail']);
            $email->to('support@ipost-hk.com');
            $email->subject('i-Post HK 公式サイトからのお問い合わせ');
            $email->body($this->get_mail_body_in_cantonese($input_contents));

        }
        else
        {
            // ---- 日本語ページ用処理 ------------------------------------

            $view = View::forge(self::VIEW_FILE_PREFIX.'exe.tpl');

            if (Input::method() == 'POST')
            {
                $input_contents = array(
                    'pref'      => Input::post('pref'),
                    'shop_name' => Input::post('shopname'),
                    'user_name' => Input::post('username'),
                    'mail'      => Input::post('mail'    ),
                    'question'  => Input::post('question')
                );
            }

            // メール送信 (TO:ヒロ企画)
            $email = \Email::forge();
            $email->from($input_contents['mail']);
            $email->to('support@hiropro.co.jp');
            $email->subject('i-Post 公式サイト(日本語版)からのお問い合わせ');
            $email->body($this->get_mail_body_in_japanese($input_contents));

        }

        try
        {
            $email->send();
        }
        catch (EmailValidationFailedException $e)
        {
            Log::error($e->getMessage());
        }
        catch (EmailSendingFailedException $e)
        {
            Log::error($e->getMessage());
        }

        return $view;

    }


    /**
     * メール本文内容 (日本語版)
     */
    private function get_mail_body_in_japanese($input_contents)
    {
        $body = <<< EOF
i-Post 公式サイト(日本語版)からのお問い合わせです。

-------------------------
【お問い合わせ者 情報】
氏名　　　　：%%%USERNAME%%%
都道府県　　：%%%PREF%%%
会社名・店名：%%%SHOPNAME%%%
-------------------------
【お問い合わせ内容】
%%%QUESTION%%%
-------------------------
EOF;

        $body = str_replace('%%%USERNAME%%%', $input_contents['user_name'], $body);
        $body = str_replace('%%%SHOPNAME%%%', $input_contents['shop_name'], $body);
        $body = str_replace('%%%PREF%%%',     $input_contents['pref'],      $body);
        $body = str_replace('%%%QUESTION%%%', $input_contents['question'],  $body);

        return $body;

    }

    /**
     * メール本文内容 (英語版)
     */
    private function get_mail_body_in_english($input_contents)
    {
        $body = <<< EOF
i-Post 公式サイト(英語版)からのお問い合わせです。

-------------------------
【お問い合わせ者 情報】
氏名　　　　：%%%USERNAME%%%
会社名・店名：%%%SHOPNAME%%%
-------------------------
【お問い合わせ内容】
%%%QUESTION%%%
-------------------------
EOF;

        $body = str_replace('%%%USERNAME%%%', $input_contents['user_name'], $body);
        $body = str_replace('%%%SHOPNAME%%%', $input_contents['shop_name'], $body);
        $body = str_replace('%%%QUESTION%%%', $input_contents['question'],  $body);

        return $body;

    }

    /**
     * メール本文内容 (広東語版)
     */
    private function get_mail_body_in_cantonese($input_contents)
    {
        $body = <<< EOF
i-Post HK 公式サイトからのお問い合わせです。

-------------------------
【お問い合わせ者 情報】
氏名　　　　：%%%USERNAME%%%
会社名・店名：%%%SHOPNAME%%%
住所　　　　：%%%ADDRESS%%%
-------------------------
【お問い合わせ内容】
%%%QUESTION%%%
-------------------------
EOF;

        $body = str_replace('%%%USERNAME%%%', $input_contents['user_name'], $body);
        $body = str_replace('%%%SHOPNAME%%%', $input_contents['shop_name'], $body);
        $body = str_replace('%%%ADDRESS%%%',  $input_contents['address'],   $body);
        $body = str_replace('%%%QUESTION%%%', $input_contents['question'],  $body);

        return $body;

    }

}
