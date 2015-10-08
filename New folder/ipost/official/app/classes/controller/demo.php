<?php
/**
 * Root Controller
 *
 * @package  app
 * @extends  Basecontroller
 */
class Controller_Demo extends Basecontroller
{
    const VIEW_FILE_PREFIX      = 'official/demo/';
    const VIEW_FILE_PREFIX_EN   = 'official_en/demo/';
    const VIEW_FILE_PREFIX_HK   = 'official_hk/demo/';
    const VIEW_FILE_PREFIX_HKJ  = 'official_hkj/demo/';
    const VIEW_FILE_PREFIX_HKZH = 'official_hkzh/demo/';

    /**
     * @var カレントページ（※UI操作に使用)
     */
    protected static $_current_page = 'home';

    /**
     * TOP
     *
     * @access  public
     * @return  Response
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

    public function action_news()
    {
        if(Input::get('lang') == 'en')
        {
            return View::forge(self::VIEW_FILE_PREFIX_EN.'news.tpl');
        }
        elseif(Input::get('lang') == 'hk')
        {
            return View::forge(self::VIEW_FILE_PREFIX_HK.'news.tpl');
        }
        elseif(Input::get('lang') == 'hkj')
        {
            return View::forge(self::VIEW_FILE_PREFIX_HKJ.'news.tpl');
        }
        elseif(Input::get('lang') == 'hkzh')
        {
            return View::forge(self::VIEW_FILE_PREFIX_HKZH.'news.tpl');
        }
        else
        {
            return View::forge(self::VIEW_FILE_PREFIX.'news.tpl');
        }

  }

    public function action_coupon()
    {
        if(Input::get('lang') == 'en')
        {
            return View::forge(self::VIEW_FILE_PREFIX_EN.'coupon.tpl');
        }
        elseif(Input::get('lang') == 'hk')
        {
            return View::forge(self::VIEW_FILE_PREFIX_HK.'coupon.tpl');
        }
        elseif(Input::get('lang') == 'hkj')
        {
            return View::forge(self::VIEW_FILE_PREFIX_HKJ.'coupon.tpl');
        }
        elseif(Input::get('lang') == 'hkzh')
        {
            return View::forge(self::VIEW_FILE_PREFIX_HKZH.'coupon.tpl');
        }
        else
        {
            return View::forge(self::VIEW_FILE_PREFIX.'coupon.tpl');
        }

    }

    public function action_menu()
    {
        if(Input::get('lang') == 'en')
        {
            return View::forge(self::VIEW_FILE_PREFIX_EN.'menu.tpl');
        }
        elseif(Input::get('lang') == 'hk')
        {
            return View::forge(self::VIEW_FILE_PREFIX_HK.'menu.tpl');
        }
        elseif(Input::get('lang') == 'hkj')
        {
            return View::forge(self::VIEW_FILE_PREFIX_HKJ.'menu.tpl');
        }
        elseif(Input::get('lang') == 'hkzh')
        {
            return View::forge(self::VIEW_FILE_PREFIX_HKZH.'menu.tpl');
        }
        else
        {
            return View::forge(self::VIEW_FILE_PREFIX.'menu.tpl');
        }

    }

}
