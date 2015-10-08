<?php
/**
 * Root Controller
 *
 * @package  app
 * @extends  Basecontroller
 */
class Controller_Character extends Basecontroller
{
    const VIEW_FILE_PREFIX      = 'official/character/';
    const VIEW_FILE_PREFIX_EN   = 'official_en/character/';
    const VIEW_FILE_PREFIX_HK   = 'official_hk/character/';
    const VIEW_FILE_PREFIX_HKJ  = 'official_hkj/character/';
    const VIEW_FILE_PREFIX_HKZH = 'official_hkzh/character/';

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
}
