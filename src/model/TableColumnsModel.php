<?php
namespace rustphp\builder\model;
/**
 * Class TableColumnsModel
 *
 * @package app\model\common
 */
class TableColumnsModel {
    private $columns;

    public function __construct($columns) {
        $this->setColumns($columns);
    }

    /**
     * @return mixed
     */
    public function getColumns() {
        return $this->columns;
    }

    /**
     * @param mixed $columns
     */
    public function setColumns($columns) {
        $this->columns = $columns;
    }

    /**
     * @return null|string
     */
    public function toString() {
        $str = NULL;
        $fields = array_column($this->getColumns(), 'name');
        if (!$fields) {
            return $str;
        }
        $str = implode(',', $fields);
        return $str;
    }
}