<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
    //-------------------------------------
    // Redis
    //-------------------------------------
    'redis' => array(
        'default' => array(
            'hostname' => '127.0.0.1',
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
            'dsn'        => 'mysql:host=localhost;dbname=ipost_main_development',
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
            'dsn'        => 'mysql:host=localhost;dbname=ipost_s0001_development',
            'username'   => 'HIRO_ipost',
            'password'   => 'yqzZz4GzSDQAjYwV',
        ),
    ),

    //-------------------------------------
    // SHOP: s0002
    //-------------------------------------
    's0002' => array(
        'type'         => 'pdo',
        'identifier'   => '`',
        'table_prefix' => '',
        'charset'      => 'utf8',
        'enable_cache' => true,
        'profiling'    => false,
        'connection'   => array(
            'dsn'        => 'mysql:host=localhost;dbname=ipost_s0002_development',
            'username'   => 'HIRO_ipost',
            'password'   => 'yqzZz4GzSDQAjYwV',
        ),
    ),


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
            'dsn'        => 'mysql:host=localhost;dbname=ipost_p0001_development',
            'username'   => 'HIRO_ipost',
            'password'   => 'yqzZz4GzSDQAjYwV',
        ),
    ),

    //-------------------------------------
    // Payment: p0002
    //-------------------------------------
    'p0002' => array(
        'type'         => 'pdo',
        'identifier'   => '`',
        'table_prefix' => '',
        'charset'      => 'utf8',
        'enable_cache' => true,
        'profiling'    => false,
        'connection'   => array(
            'dsn'        => 'mysql:host=localhost;dbname=ipost_p0002_development',
            'username'   => 'HIRO_ipost',
            'password'   => 'yqzZz4GzSDQAjYwV',
        ),
    ),
);
