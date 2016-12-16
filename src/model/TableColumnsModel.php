<?php
namespace rustphp\builder\model;
/**
 * Class TableColumnsModel
 *
 * @package app\model\common
 */
class TableColumnsModel {
    private $columns;
    private $properties;
    private $elements;

    public function __construct($columns) {
        $this->setColumns($columns);
        $this->init($columns);
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

    public function getElements() {
        return $this->elements;
    }

    public function getProperties() {
        return $this->properties;
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

    /**
     * @param array $columns
     */
    private function init($columns) {
        $properties = [];
        $elements = [];
        $fields = array_column($columns, 'name', 'comment');
        if ($fields) {
            foreach ($fields as $comment => $name) {
                $fieldInfo = explode('_', $name);
                $property = array_shift($fieldInfo);
                if (is_array($fieldInfo)) {
                    foreach ($fieldInfo as $word) {
                        $property .= ucfirst($word);
                    }
                }
                $properties[] = lcfirst($property);
                $elements[] = [
                    'name'     => $property,
                    'property' => $property,
                    'label'    => $comment,
                ];
            }
            $this->properties = $properties;
        }
        $this->properties = $properties;
        $this->elements = $elements;
    }
}