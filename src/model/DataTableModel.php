<?php

namespace rustphp\builder\model;

use rustphp\builder\util\Inflector;

/**
 * Class DataTableModel
 *
 * @package app\model\common
 */
class DataTableModel {
    private $name;
    private $comment;
    /**
     * @var TableColumnsModel
     */
    private $columnsModel;
    private $primaryKey;

    /**
     * DataTableModel constructor.
     *
     * @param string $name
     * @param string $comment
     * @param string $primaryKey
     * @param array  $columns
     */
    public function __construct($name, $comment, $primaryKey, $columns) {
        $this->setName($name);
        $this->setComment($comment);
        $this->setPrimaryKey($primaryKey);
        $this->setColumnsModel($columns);
    }

    public function getPrimaryId(): string {
        $str = preg_replace_callback('/([-_]+([a-z]{1}))/i', function($matches) {
            return ucfirst($matches[2]);
        }, $this->getPrimaryKey());
        return $str;
    }

    public function getPrimaryIds(): string {
        $id = $this->getPrimaryId();
        $ids = Inflector::pluralize($id);
        return $ids;
    }

    /**
     * @return mixed
     */
    public function getPrimaryKey() {
        return $this->primaryKey;
    }

    /**
     * @param mixed $primaryKey
     */
    public function setPrimaryKey($primaryKey) {
        $this->primaryKey = $primaryKey;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getComment() {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment) {
        $this->comment = $comment;
    }

    /**
     * @return TableColumnsModel
     */
    public function getColumnsModel() {
        return $this->columnsModel;
    }

    /**
     * @param array $columns
     */
    public function setColumnsModel($columns) {
        $this->columnsModel = new TableColumnsModel($columns);
    }
}