<?php
namespace rustphp\builder\model;
/**
 * Class GenerateModel
 *
 * @package app\model\common
 */
class GenerateModel {
    const CAMEL_NAMED = 1;//驼峰命名
    const SNAKE_NAMED = 2;//蛇形命名
    private static $_nameRule; //命名规则
    private        $namespace, $classId, $className, $classNote, $moduleName;
    /**
     * @var DataTableModel
     */
    private $tableModel;
    private $outputPath, $sourceRootPath, $composerName;
    private $requestPath;

    /**
     * GenerateModel constructor.
     *
     * @param array $setting
     */
    public function __construct($setting) {
        $this->initSetting($setting);
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
        $this->classId = $classId;
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
        $this->className = $className;
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
        $this->classNote = $classNote;
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
        $this->composerName = $composerName;
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
        $this->outputPath = $outputPath;
    }

    public function getRequestPath() {
        return $this->requestPath;
    }

    public function setRequestPath($path) {
        $this->requestPath = $path;
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
        $this->sourceRootPath = $sourceRootPath;
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
     * @param array  $columns
     *
     * @return bool
     */
    public function setTableModel($name, $comment, $primaryKey, $columns) {
        $this->tableModel = new DataTableModel($name, $comment, $primaryKey, $columns);
        return TRUE;
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
        $this->namespace = $namespace;
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
        $this->moduleName = $moduleName;
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
        $names = explode('_', $name);
        $result = lcfirst(array_shift($names));
        $names = array_map(function($value) {
            return ucfirst($value);
        }, $names);
        $result .= implode('', $names);
        return $result;
    }

    /**
     * 初始化设置
     *
     * @param array $setting
     */
    private function initSetting($setting) {
        //设置
        $namespace = $setting['namespace']??NULL;
        $this->setNamespace($namespace);
        $composerName = $setting['composerName']??NULL;
        $this->setComposerName($composerName);
        $sourcePath = $setting['sourcePath']??NULL;
        $this->setSourceRootPath($sourcePath);
        $outputPath = $setting['outputPath']??NULL;
        $this->setOutputPath($outputPath);
        $moduleName = $setting['moduleName']??NULL;
        $this->setModuleName($moduleName);
        $className = $setting['className']??NULL;
        $this->setClassName($className);
        $classId = $className ? $this->getCamelName($className) : NULL;
        $this->setClassId($classId);
        $this->setRequestPath('/' . $moduleName . '/' . $classId);
        //table model
        $tableName = $setting['tableName']??NULL;
        $tableInfo = $setting['tableInfo']??NULL;
        $tableComment = $tableInfo['comment']??NULL;
        $this->setClassNote($tableComment);
        $primaryKey = $tableInfo['primaryKey']??NULL;
        $primary_keys = $primaryKey && is_array($primaryKey) ? array_keys($primaryKey) : ['id'];
        $primary_keys = count($primary_keys) >= 1 ? $primary_keys : [$primaryKey];
        $primary_key = array_shift($primary_keys);
        $columns = $tableInfo['columns']??[];
        $this->setTableModel($tableName, $tableComment, $primary_key, $columns);
    }
}