<?php
/**
 * Created by PhpStorm.
 * User: rustysun
 * Date: 16/9/2
 * Time: 上午7:42
 */
namespace rustphp\builder;
use rustphp\builder\service\GeneratePlanService;
use rustphp\builder\util\Constant;
use rustphp\builder\util\Registry;

class App {
    /**
     * 运行
     */
    public function run() {
        $registry = Registry::getInstance();
        $config = $registry->get(Constant::PLAN_CONFIG_KEY);
        $generate_plan = new GeneratePlanService($config);
        $generate_plan->doPlan();
        echo "\n", 'run now', "\n";
    }
}