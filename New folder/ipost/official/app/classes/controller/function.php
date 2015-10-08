<?php
/**
 * Root Controller
 *
 * @package  app
 * @extends  Basecontroller
 */
class Controller_Function extends Basecontroller
{
    const VIEW_FILE_PREFIX      = 'official/function/';
    const VIEW_FILE_PREFIX_EN   = 'official_en/function/';
    const VIEW_FILE_PREFIX_HK   = 'official_hk/function/';
    const VIEW_FILE_PREFIX_HKJ  = 'official_hkj/function/';
    const VIEW_FILE_PREFIX_HKZH = 'official_hkzh/function/';

    /**
     * @var カレントページ（※UI操作に使用)
     */
    protected static $_current_page = 'function';

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

}
