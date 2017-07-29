<?php

namespace Tg\Document\Collection;

class FieldColumnMap
{
    private $fieldColumnMap = [];

    private $columnFieldMap = [];

    public function __construct(array $fieldColumnMap)
    {
        $this->fieldColumnMap = $fieldColumnMap;
        $this->columnFieldMap = array_flip($fieldColumnMap);

        if (count($this->fieldColumnMap) !== count($this->columnFieldMap)) {
            throw new \InvalidArgumentException();
        }
    }

    public function getColumn(string $field)
    {
        return $this->columnFieldMap[$field];
    }

    public function getColumns(array $fields)
    {
        return array_map(function(string $field) {
            return $this->getColumn($field);
        }, $fields);
    }

    public function getField(string $column)
    {
        return $this->fieldColumnMap[$column];
    }
}