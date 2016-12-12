<?php
/**
 * Created by PhpStorm.
 * User: rustysun
 * Date: 16/9/5
 * Time: 下午4:52
 */
namespace rustphp\builder\service;

use rustphp\builder\model\GeneratePlanModel;
use rustphp\builder\util\Config;
use rustphp\builder\util\Constant;
use rustphp\builder\util\DB;
use rustphp\builder\util\Registry;

/**
 * Class GeneratePlanService
 *
 * @package rustphp\builder\service
 */
class GeneratePlanService {
    /**
     * @var Config
     */
    protected $config;
    protected $data_source;
    protected $templates;
    protected $model;

    /**
     * GeneratePlanService constructor.
     *
     * @param \rustphp\builder\util\Config $config
     */
    public function __construct($config) {
        $this->config = $config;
    }

    public function doPlan() {
        //获取plan配置
        $plan_config = $this->config;
        $plan_name = $plan_config->get('plan');
        $frameworkTemplate = str_replace('.', '/', $plan_config->get('framework')) . '/' . $plan_name;
        //获取plan模板
        $template_path = vsprintf('%s/resource/plan/%s/template/', [ROOT_PATH, $frameworkTemplate]);
        //获取数据源名称
        $data_source_name = $plan_config->get('dataSource');
        //生成
        //输出
        $output_path = ROOT_PATH . '/' . $plan_config->get('outputPath');
        $registry = Registry::getInstance();
        $db_config = $registry->get(Constant::DB_CONFIG_KEY);
        $connections = $db_config->get('connections');
        $dataSource = $this->bindDataSource($data_source_name, $connections);
        $generate_plan_model = new GeneratePlanModel($dataSource, $plan_config->get('generator'), $template_path);
        $generate_plan_model->build()->output($output_path);
        return $this;
    }

    /**
     * 绑定数据源
     *
     * @param string                       $data_source
     * @param \rustphp\builder\util\Config $db_config *
     *
     * @return array
     */
    protected function bindDataSource($data_source, $db_config) {
        $all_tables = [];
        if ($data_source) {
            $conn_config = $db_config->get($data_source);
            $all_tables = $this->getTablesByConnectionName($conn_config);
        }
        if (!$all_tables) {
            return [];
        }
        $result = [];
        foreach ($all_tables as $table => $tableInfo) {
            $columns = $this->getColumns($tableInfo);
            $result[$table] = [
                'comment'    => $tableInfo->Comment,
                'primaryKey' => $columns['primaryKey'],
                'columns'    => $columns['allFields'],
            ];
        }
        return $result;
    }

    /**
     * @param $tableInfo
     *
     * @return array
     */
    protected function getColumns($tableInfo) {
        $result = [];
        if (!$tableInfo) {
            return $result;
        }
        $columns = isset($tableInfo->Columns) ? $tableInfo->Columns : NULL;
        if (!$columns || !is_array($columns)) {
            return $result;
        }
        $primary_key = [];
        foreach ($columns as $column) {
            $is_primary = $column->Key == 'PRI' ? TRUE : FALSE;
            if ($is_primary) {
                $primary_key[$column->Field] = $column->Field;
            }
            $result[strtolower($column->Field)] = [
                'name'    => $column->Field,
                'comment' => $column->Comment,
            ];
        }
        return ['primaryKey' => $primary_key, 'allFields' => $result];
    }

    /**
     * get all tables and files by connection name
     *
     * @param \rustphp\builder\util\Config $conn_config
     *
     * @return array
     */
    protected function getTablesByConnectionName($conn_config) {
        $db = DB::getInstance($conn_config);
        $st = $db->execute('SHOW TABLE STATUS');
        $result = [];
        while ($row = $st->fetchObject()) {
            $st_columns = $db->execute('SHOW FULL COLUMNS FROM `' . $row->Name . '`');
            $columns = [];
            if ($st_columns) {
                while ($column = $st_columns->fetchObject()) {
                    $columns[$column->Field] = $column;
                }
            }
            $row->Columns = $columns;
            $result[strtolower($row->Name)] = $row;
        }
        return $result;
    }
}