<?php
namespace rustphp\builder\model;
/**
 * Class GenerateModel
 *
 * @package app\model\common
 */
class GenerateModel {
    const CAMEL_NAMED=1;//驼峰命名
    const SNAKE_NAMED=2;//蛇形命名
    private static $_nameRule; //命名规则
    private $namespace, $classId, $className, $classNote, $moduleId, $moduleName;
    /**
     * @var DataTableModel
     */
    private $tableModel;
    private $outputPath, $sourceRootPath, $composerName;
    private $requestPath, $apiRequestPath;
    /**
     * @var int $projectErrorNum
     */
    private $projectErrorNum;
    /**
     * @var string $type
     */
    private $type;
    /**
     * @var string $baseClass
     */
    private $baseClass;
    /**
     * @var string $version
     */
    private $version;

    /**
     * GenerateModel constructor.
     *
     * @param array $setting
     */
    public function __construct($setting) {
        $this->initSetting($setting);
    }

    /**
     * @return string
     */
    public function getBaseClass() : string {
        return $this->baseClass;
    }

    /**
     * @param string $baseClass
     */
    public function setBaseClass(string $baseClass) {
        $this->baseClass=$baseClass;
    }

    /**
     * @return mixed
     */
    public function getClassId() {
        return $this->classId;
    }

    /**
     * @param mixed $classId
     */
    public function setClassId($classId) {
        $this->classId=$classId;
    }

    /**
     * @return mixed
     */
    public function getClassName() {
        return $this->className;
    }

    /**
     * @param mixed $className
     */
    public function setClassName($className) {
        $this->className=$className;
    }

    /**
     * @return mixed
     */
    public function getClassNote() {
        return $this->classNote;
    }

    /**
     * @param mixed $classNote
     */
    public function setClassNote($classNote) {
        $this->classNote=$classNote;
    }

    /**
     * @return mixed
     */
    public function getComposerName() {
        return $this->composerName;
    }

    /**
     * @param mixed $composerName
     */
    public function setComposerName($composerName) {
        $this->composerName=$composerName;
    }

    /**
     * @return string
     */
    public function getFormName() {
        return $this->getClassId() . 'Form';
    }

    /**
     * @return mixed
     */
    public function getOutputPath() {
        return $this->outputPath;
    }

    /**
     * @param mixed $outputPath
     */
    public function setOutputPath($outputPath) {
        $this->outputPath=$outputPath;
    }

    /**
     * @return int
     */
    public function getProjectErrorNum() : int {
        return $this->projectErrorNum;
    }

    /**
     * @param int $projectErrorNum
     */
    public function setProjectErrorNum(int $projectErrorNum) {
        $this->projectErrorNum=$projectErrorNum;
    }

    /**
     * @return mixed
     */
    public function getApiRequestPath() {
        return $this->apiRequestPath;
    }

    /**
     * @param mixed $apiRequestPath
     */
    public function setApiRequestPath($apiRequestPath) {
        $this->apiRequestPath=$apiRequestPath;
    }

    public function getRequestPath() {
        return $this->requestPath;
    }

    public function setRequestPath($path) {
        $this->requestPath=$path;
    }

    /**
     * @return mixed
     */
    public function getSourceRootPath() {
        return $this->sourceRootPath;
    }

    /**
     * @param mixed $sourceRootPath
     */
    public function setSourceRootPath($sourceRootPath) {
        $this->sourceRootPath=$sourceRootPath;
    }

    /**
     * @return DataTableModel
     */
    public function getTableModel() {
        return $this->tableModel;
    }

    /**
     * @param string $name
     * @param string $comment
     * @param string $primaryKey
     * @param array $columns
     *
     * @return bool
     */
    public function setTableModel($name, $comment, $primaryKey, $columns) {
        $this->tableModel=new DataTableModel($name, $comment, $primaryKey, $columns);
        return true;
    }

    /**
     * @return string
     */
    public function getType() : string {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type) {
        $this->type=$type;
    }

    /**
     * @return mixed
     */
    public function getNamespace() {
        return $this->namespace;
    }

    /**
     * @param mixed $namespace
     */
    public function setNamespace($namespace) {
        $this->namespace=$namespace;
    }

    public function getModuleId() {
        return $this->moduleId;
    }

    public function setModuleId($moduleId) {
        $this->moduleId=$moduleId;
    }

    /**
     * @return mixed
     */
    public function getModuleName() {
        return $this->moduleName;
    }

    /**
     * @param mixed $moduleName
     */
    public function setModuleName($moduleName) {
        $this->moduleName=$moduleName;
    }

    /**
     * @return string
     */
    public function getVersion() : string {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version) {
        $this->version=$version;
    }

    /**
     * 生成名称
     *
     * @param string $name
     *
     * @return string
     */
    protected function generateName($name) {
        if (static::CAMEL_NAMED === static::$_nameRule) {
            return $this->getCamelName($name);
        }
        return $name;
    }

    /**
     * 驼峰命名
     *
     * @param string $name
     *
     * @return string
     */
    private function getCamelName($name) {
        $names=explode('_', $name);
        $result=lcfirst(array_shift($names));
        $names=array_map(function($value) {
            return ucfirst($value);
        }, $names);
        $result.=implode('', $names);
        return $result;
    }

    /**
     * 初始化设置
     *
     * @param array $setting
     */
    private function initSetting($setting) {
        //设置
        $namespace=$setting['namespace'] ?? null;
        $this->setNamespace($namespace);
        $this->setProjectErrorNum($setting['projectErrorNum'] ?? 0);
        //类型
        $this->setType($setting['type'] ?? '');
        //版本
        $this->setVersion($setting['version'] ?? '');
        //基础类
        $this->setBaseClass($setting['baseClass'] ?? '');
        $composerName=$setting['composerName'] ?? null;
        $this->setComposerName($composerName);
        $sourcePath=$setting['sourcePath'] ?? null;
        $this->setSourceRootPath($sourcePath);
        $outputPath=$setting['outputPath'] ?? null;
        $this->setOutputPath($outputPath);
        $moduleName=$setting['moduleName'] ?? null;
        $moduleId=$setting['moduleId'] ?? $moduleName;
        $this->setModuleName($moduleName);
        $this->setModuleId($moduleId);
        $className=$setting['className'] ?? null;
        $this->setClassName($className);
        $classId=$className ? $this->getCamelName($className) : null;
        $this->setClassId($classId);
        $this->setRequestPath('/' . $moduleName . '/' . $classId);
        $this->setApiRequestPath('/' . $classId);
        //table model
        $tableName=$setting['tableName'] ?? null;
        $tableInfo=$setting['tableInfo'] ?? null;
        $tableComment=$tableInfo['comment'] ?? null;
        $this->setClassNote($tableComment);
        $primaryKey=$tableInfo['primaryKey'] ?? null;
        $primary_keys=$primaryKey && is_array($primaryKey) ? array_keys($primaryKey) : ['id'];
        $primary_keys=count($primary_keys) >= 1 ? $primary_keys : [$primaryKey];
        $primary_key=array_shift($primary_keys);
        $columns=$tableInfo['columns'] ?? [];
        $this->setTableModel($tableName, $tableComment, $primary_key, $columns);
    }
}