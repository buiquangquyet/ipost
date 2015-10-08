<?php
/**
* ルートコントローラ
*/
Router::connect('/', array('controller' => 'top', 'action' => 'index'));

/**
* 代理店関係画面のルーティング
*/

/**
* サポート関係画面のルーティング
*/
Router::connect('/support/reject',      array('controller' => 'support_reject', 'action' => 'index'));
Router::connect('/support/reject/list', array('controller' => 'support_reject', 'action' => 'list'));
Router::connect('/support/reject/add',  array('controller' => 'support_reject', 'action' => 'add'));
Router::connect('/support/reject/edit/:id', array('controller' => 'support_reject', 'action' => 'edit'), array('id' => '[0-9]+'));
Router::connect('/support/reject/delete/:id',  array('controller' => 'support_reject', 'action' => 'delete'), array('id' => '[0-9]+'));

Router::connect('/support/info',      array('controller' => 'support_info', 'action' => 'index'));
Router::connect('/support/info/list', array('controller' => 'support_info', 'action' => 'list'));
Router::connect('/support/info/add',  array('controller' => 'support_info', 'action' => 'add'));

Router::connect('/support/help',      array('controller' => 'support_help', 'action' => 'index'));
Router::connect('/support/help/list', array('controller' => 'support_help', 'action' => 'list'));
Router::connect('/support/help/add',  array('controller' => 'support_help', 'action' => 'add'));

/**
* 代理店サポート画面のルーティング
*/
Router::connect('/support/agent/info',      array('controller' => 'support_agent', 'action' => 'info_index'));
Router::connect('/support/agent/info/list', array('controller' => 'support_agent', 'action' => 'info_list'));
Router::connect('/support/agent/info/add',  array('controller' => 'support_agent', 'action' => 'info_add'));

Router::connect('/support/agent/help',      array('controller' => 'support_agent', 'action' => 'help_index'));
Router::connect('/support/agent/help/list', array('controller' => 'support_agent', 'action' => 'help_list'));
Router::connect('/support/agent/help/add',  array('controller' => 'support_agent', 'action' => 'help_add'));

Router::connect('/support/agent/faq',      array('controller' => 'support_agent', 'action' => 'faq_index'));
Router::connect('/support/agent/faq/list', array('controller' => 'support_agent', 'action' => 'faq_list'));
Router::connect('/support/agent/faq/add',  array('controller' => 'support_agent', 'action' => 'faq_add'));

/**
* 申請リスト画面のルーティング
*/
Router::connect('/inspect/list/:status', array('controller' => 'inspect', 'action' => 'list'), array('id' => '[0-9]+'));


/**
* Load all plugin routes. See the CakePlugin documentation on
* how to customize the loading of plugin routes.
*/
CakePlugin::routes();

/**
* Load the CakePHP default routes. Only remove this if you do not want to use
* the built-in default routes.
*/
require CAKE . 'Config' . DS . 'routes.php';
