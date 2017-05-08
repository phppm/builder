#!/usr/bin/env php
<?php
defined('ROOT_PATH') or define('ROOT_PATH', __DIR__);
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else {
    require_once __DIR__ . '/vendor/autoload.php';
}
use rustphp\builder\util\Config;
use rustphp\builder\util\Constant;
use rustphp\builder\util\Registry;

$longOpts=[
    'plan:',
];
$options=getopt('', $longOpts);
//获取 构建方案名称 参数
$plan=$options['plan']??null;
if (!$plan) {
    //TODO:
}
try {
    $plan_config=new Config('plan.' . $plan);
} catch (\rustphp\builder\exception\ConfigException $e) {
    $plan_config=new Config('plan.' . $plan . '.default');
}
$registry=Registry::getInstance();
$registry->set(Constant::PLAN_CONFIG_KEY, $plan_config);
//获取 数据源 配置
$db_config=new Config('config.db');
$registry=Registry::getInstance();
$registry->set(Constant::DB_CONFIG_KEY, $db_config);
$builder=new \rustphp\builder\App();
$builder->run();