<?php
return [
    'plan'       => 'http-default',
    'framework'  => 'youzan.zanphp',
    'dataSource' => 'mushroom',
    //输出 路径
    'outputPath' => 'output/',
    //生成器
    'generator'  => [
        'base'      => [
            //命名空间
            'namespace'  => 'mushroom\\manage\\',
            //源代码 路径
            'sourcePath' => 'src/',
        ],
        'project'   => [
            //系统模块
            'System' => [
                'manager'       => 'Manager',
                'manager_group' => 'ManagerGroup',
            ],
        ],
        'templates' => [
            //生成composer
            'composer.json'      => [
                'path' => '/composer.json',
            ],
            //生成基础控制器
            'BaseController.php' => [
                'path' => 'Controller/Base/BaseController.php',
            ],
            //生成Controller
            'Controller.php'     => [
                'path'                => 'Controller/%s/%s.php',
                'generate_by_project' => TRUE,
                'use_module'          => 1,
                'suffix'              => 'Controller',
            ],
            //生成Service
            'Service.php'        => [
                'path'                => '%s/Service/%s.php',
                'generate_by_project' => TRUE,
                'use_module'          => 1,
                'suffix'              => 'Service',
            ],
            //生成Dao
            'Dao.php'        => [
                'path'                => '%s/Dao/%s.php',
                'generate_by_project' => TRUE,
                'use_module'          => 1,
                'suffix'              => 'Dao',
            ],
            /*
            'view'           => [
                'files'          => ['add', 'edit', 'list'],
                'is_directory'   => TRUE,
                'use_table_name' => TRUE,
            ],
        */
            'sqlMap.php'         => [
                //生成sqlMap
                'generate_by_project' => TRUE,
                'path'                => 'resource/sql/%s.php',
                'use_table_name'      => TRUE,
            ],
        ],
    ],
];