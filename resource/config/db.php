<?php
return [
    'default'     => 'landsker',
    'connections' => [
        'heart_water' => [
            'dsn'      => 'mysql:host=localhost;dbname=heart_water',
            'username' => 'heart_water',
            'password' => '111111',
            'prefix'   => '',
            'option'   => [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ],
        ],
        'beibei'      => [
            'dsn'      => 'mysql:host=localhost;dbname=beibei',
            'username' => 'beibei',
            'password' => 'beibei',
            'prefix'   => '',
            'option'   => [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ],
        ],
        'mushroom'=>[
            'dsn'      => 'mysql:host=localhost;dbname=zj_mogu',
            'username' => 'zj',
            'password' => '111111',
            'prefix'   => '',
            'option'   => [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ],
        ],
        'landsker'=>[
            'dsn'      => 'mysql:host=localhost;dbname=landsker',
            'username' => 'landsker',
            'password' => 'Ldsk2016@)!^',
            'prefix'   => '',
            'option'   => [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ],
        ],
        'zj_community'=>[
            'dsn'      => 'mysql:host=localhost;dbname=zj_community',
            'username' => 'zj_community',
            'password' => '111111',
            'prefix'   => '',
            'option'   => [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ],
        ],
        'zj_ads'=>[
            'dsn'      => 'mysql:host=localhost;dbname=zj_ad',
            'username' => 'zj_ad',
            'password' => 'Zj2017@)!&',
            'prefix'   => '',
            'option'   => [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ],
        ],
        'zj_sony'=>[
            'dsn'      => 'mysql:host=localhost;dbname=zj_sony',
            'username' => 'zj_sony',
            'password' => 'Sony2017@)!&',
            'prefix'   => '',
            'option'   => [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ],
        ],
    ],
];