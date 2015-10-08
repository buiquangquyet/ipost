<?php
/**
 * Root Controller
 *
 * @package  app
 * @extends  Basecontroller
 */
class Controller_Support_Help extends Basecontroller
{
    const VIEW_FILE_PREFIX      = 'official/support/help/';
    const VIEW_FILE_PREFIX_EN   = 'official_en/support/help/';
    const VIEW_FILE_PREFIX_HK   = 'official_hk/support/help/';
    const VIEW_FILE_PREFIX_HKJ  = 'official_hkj/support/help/';
    const VIEW_FILE_PREFIX_HKZH = 'official_hkzh/support/help/';

    /**
     * @var カレントページ（※UI操作に使用)
     */
    protected static $_current_page = 'help';

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
            $view = View::forge(self::VIEW_FILE_PREFIX_EN.'index.tpl');
        }
        elseif(Input::get('lang') == 'hk')
        {
            $view = View::forge(self::VIEW_FILE_PREFIX_HK.'index.tpl');
        }
        elseif(Input::get('lang') == 'hkj')
        {
            $view = View::forge(self::VIEW_FILE_PREFIX_HKJ.'index.tpl');
        }
        elseif(Input::get('lang') == 'hkzh')
        {
            $view = View::forge(self::VIEW_FILE_PREFIX_HKZH.'index.tpl');
        }
        else
        {
            $view = View::forge(self::VIEW_FILE_PREFIX.'index.tpl');

        }

        // 現在、tplに直書きの為、コメントアウト
/*        
        $list = Model_Support_Help::get_help(2, null);
        $ipost_list = Model_Support_Help::get_help_ipost();
        $sub_menu   = Model_Master_Support_Help_Genre::find_all();

        $view->set('sub_menu',     $sub_menu);
        $view->set('list',         $list);
        $view->set('ipost_list',   $ipost_list);
*/

        return $view;
    }

}
