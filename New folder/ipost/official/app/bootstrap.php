<?php

// Load in the Autoloader
require COREPATH.'classes'.DIRECTORY_SEPARATOR.'autoloader.php';
class_alias('Fuel\\Core\\Autoloader', 'Autoloader');

// Bootstrap the framework DO NOT edit this
require COREPATH.'bootstrap.php';


Autoloader::add_classes(array(
    // Add classes you want to override here
    // Example: 'View' => APPPATH.'classes/view.php',
    'Basecontroller'               => APPPATH.'classes/lib/basecontroller.php',
    'Basecontroller_Rest'          => APPPATH.'classes/lib/basecontroller_rest.php',
    'ExValidation'                 => APPPATH.'classes/lib/exvalidation.php',
    'Fuel\\Core\\Exfieldset'       => APPPATH.'classes/lib/extends/fieldset.php',
    'Model_Crud_Shard'             => APPPATH.'classes/lib/extends/model_crud_shard.php',
    'Model_Crud_Shard_Payment'     => APPPATH.'classes/lib/extends/model_crud_shard_payment.php',
    'Model_Crud_Master'            => APPPATH.'classes/lib/extends/model_crud_master.php',
    'Model_Readonly'               => APPPATH.'classes/lib/extends/model_readonly.php',
    'Agent'                        => APPPATH.'classes/lib/extends/agent.php',
    'Jpayment'                     => APPPATH.'classes/lib/jpayment.php',
    'Support\\File_Upload'         => APPPATH.'classes/lib/support/file_upload.php',

    // Saleitem
    'Abstract_Saleitem'            => APPPATH.'classes/lib/saleitem/abstract_saleitem.php',
    'Saleitem1'                    => APPPATH.'classes/lib/saleitem/saleitem1.php',
    'Saleitem2'                    => APPPATH.'classes/lib/saleitem/saleitem2.php',
    'Saleitem3'                    => APPPATH.'classes/lib/saleitem/saleitem3.php',
    'Saleitem4'                    => APPPATH.'classes/lib/saleitem/saleitem4.php',

    // Supported Classes
    'Shop'                         => APPPATH.'classes/lib/support/shop.php',
    'Notification'                 => APPPATH.'classes/lib/support/notification.php',
    'Inspect'                      => APPPATH.'classes/lib/support/inspect.php',
    'Support\\Payment'             => APPPATH.'classes/lib/support/payment.php',
    'Support\\Shard'               => APPPATH.'classes/lib/support/shard.php',
    'Saleitem'                     => APPPATH.'classes/lib/support/saleitem.php',
    'RegistFees'                   => APPPATH.'classes/lib/support/agent/regist_fees.php',
    'Seminar'                   => APPPATH.'classes/lib/support/seminar.php',

    // Supported Classes: API
    'Support\\Api\\Base'           => APPPATH.'classes/lib/support/api/base.php',
    'Support\\Api\\Top'            => APPPATH.'classes/lib/support/api/top.php',
    'Support\\Api\\Menu'           => APPPATH.'classes/lib/support/api/menu.php',
    'Support\\Api\\Menu_Item'      => APPPATH.'classes/lib/support/api/menu_item.php',
    'Support\\Api\\Coupon'         => APPPATH.'classes/lib/support/api/coupon.php',
    'Support\\Api\\News'           => APPPATH.'classes/lib/support/api/news.php',
    'Support\\Api\\Setting'        => APPPATH.'classes/lib/support/api/setting.php',
    'Support\\Api\\Global_Info'    => APPPATH.'classes/lib/support/api/global_info.php',

    // Supported Classes: Inspect
    'Support\\Inspect\\Base'       => APPPATH.'classes/lib/support/inspect/base.php',
    'Support\\Inspect\\Top'        => APPPATH.'classes/lib/support/inspect/top.php',
    'Support\\Inspect\\Coupon'     => APPPATH.'classes/lib/support/inspect/coupon.php',
    'Support\\Inspect\\Menu'       => APPPATH.'classes/lib/support/inspect/menu.php',
));

// Register the autoloader
Autoloader::register();

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGING
 * Fuel::PRODUCTION
 */
Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::PRODUCTION);

// Initialize the framework with the config file.
Fuel::init('config.php');
