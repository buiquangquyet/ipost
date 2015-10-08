<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
    //-------------------------------------
    // Redis
    //-------------------------------------
    'redis' => array(
        'default' => array(
            'hostname' => '172.16.70.1',
            'port'     => '6379',
        ),
    ),

    //-------------------------------------
    // MAIN
    //-------------------------------------
	'default' => array(
        'type'         => 'pdo',
        'identifier'   => '`',
        'table_prefix' => '',
        'charset'      => 'utf8',
        'enable_cache' => true,
        'profiling'    => false,
        'connection'   => array(
            'dsn'        => 'mysql:host=172.16.50.1;dbname=ipost_main_production',
            'username'   => 'HIRO_ipost',
            'password'   => 'yqzZz4GzSDQAjYwV',
        ),
	),

    //-------------------------------------
    // SHOP: s0001
    //-------------------------------------
    's0001' => array(
        'type'         => 'pdo',
        'identifier'   => '`',
        'table_prefix' => '',
        'charset'      => 'utf8',
        'enable_cache' => true,
        'profiling'    => false,
        'connection'   => array(
            'dsn'        => 'mysql:host=172.16.50.101;dbname=ipost_s0001_production',
            'username'   => 'HIRO_ipost',
            'password'   => 'yqzZz4GzSDQAjYwV',
        ),
    ),

//     //-------------------------------------
//     // SHOP: s0002
//     //-------------------------------------
//     's0002' => array(
//         'type'         => 'pdo',
//         'identifier'   => '`',
//         'table_prefix' => '',
//         'charset'      => 'utf8',
//         'enable_cache' => true,
//         'profiling'    => false,
//         'connection'   => array(
//             'dsn'        => 'mysql:host=localhost;dbname=ipost_s0002_production',
//             'username'   => 'HIRO_ipost',
//             'password'   => 'yqzZz4GzSDQAjYwV',
//         ),
//     ),

    //-------------------------------------
    // Payment: p0001
    //-------------------------------------
    'p0001' => array(
        'type'         => 'pdo',
        'identifier'   => '`',
        'table_prefix' => '',
        'charset'      => 'utf8',
        'enable_cache' => true,
        'profiling'    => false,
        'connection'   => array(
            'dsn'        => 'mysql:host=172.16.50.201;dbname=ipost_p0001_production',
            'username'   => 'HIRO_ipost',
            'password'   => 'yqzZz4GzSDQAjYwV',
        ),
    ),

//     //-------------------------------------
//     // Payment: p0002
//     //-------------------------------------
//     'p0002' => array(
//         'type'         => 'pdo',
//         'identifier'   => '`',
//         'table_prefix' => '',
//         'charset'      => 'utf8',
//         'enable_cache' => true,
//         'profiling'    => false,
//         'connection'   => array(
//             'dsn'        => 'mysql:host=localhost;dbname=ipost_p0002_production',
//             'username'   => 'HIRO_ipost',
//             'password'   => 'yqzZz4GzSDQAjYwV',
//         ),
//     ),

);
