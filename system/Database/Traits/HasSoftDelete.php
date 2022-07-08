<?php

namespace System\Database\Traits;

trait HasSoftDelete
{
    protected function deleteMethod($id = null)
    {
        $object = $this;
        if ($id) {
            $this->resetQuery();
            $object = $this->findMethod($id);
        }
        if ($object) {
            $object->resetQuery();
            $object->setSql("UPDATE " . $object->getTableName() . " SET " . $this->getAttributeName($this->deletedAt) . " = NOW() ");
            $object->setWhere("AND", $this->getAttributeName($object->primaryKey) . " = ?");
            $object->addValue($object->primaryKey, $object->{$object->primaryKey});
            return $object->executeQuery();
        }
    }

    protected function deleteBySlugMethod($slug = null)
    {
        $object = $this;
        if ($slug) {
            $this->resetQuery();
            $object = $this->findBySlugMethod($slug);
        }
        if ($object) {
            $object->resetQuery();
            $object->setSql("UPDATE " . $object->getTableName() . " SET " . $this->getAttributeName($this->deletedAt) . " = NOW() ");
            $object->setWhere("AND", $this->getAttributeName($object->slugColumn) . " = ?");
            $object->addValue($object->slugColumn, $object->{$object->slugColumn});
            return $object->executeQuery();
        }
    }
    protected function allMethod()
    {
        $this->setSql("SELECT " . $this->getTableName() . ".* FROM " . $this->getTableName());
        $this->setWhere("AND", $this->getAttributeName($this->deletedAt) . " IS NULL ");
        $statement = $this->executeQuery();
        $data = $statement->fetchAll();
        if ($data) {
            $this->arrayToObjects($data);
            return $this->collection;
        }
        return [];
    }
    protected function totalMethod()
    {
        $this->setSql("SELECT * FROM " . $this->getTableName());
        $statement = $this->executeQuery();
        $data = $statement->fetchAll();
        if ($data) {
            $this->arrayToObjects($data);
            return $this->collection;
        }
        return [];
    }
    protected function countMethod()
    {
        $this->setWhere("AND", "{$this->getAttributeName($this->deletedAt)} IS NULL ");
        if ($this->is_relation) {
            return $this->getRelationCount();
        }
        return $this->getCount();
    }
    protected function findMethod($id)
    {
        $this->resetQuery();
        $this->setSql("SELECT " . $this->getTableName() . ".* FROM " . $this->getTableName());
        $this->setWhere("AND", $this->getAttributeName($this->primaryKey) . " = ? ");
        $this->addValue($this->primaryKey, $id);
        $this->setWhere("AND", $this->getAttributeName($this->deletedAt) . " IS NULL ");
        $statement = $this->executeQuery();
        $data = $statement->fetch();
        $this->setAllowedMethods(['update', 'delete', 'deleteBySlug', 'save']);
        if ($data)
            return $this->arrayToAttributes($data);
        return null;
    }
    protected function findBySlugMethod($slug)
    {
        $this->resetQuery();
        $this->setSql("SELECT " . $this->getTableName() . ".* FROM " . $this->getTableName());
        $this->setWhere("AND", $this->getAttributeName($this->slugColumn) . " = ? ");
        $this->addValue($this->slugColumn, $slug);
        $this->setWhere("AND", $this->getAttributeName($this->deletedAt) . " IS NULL ");
        $statement = $this->executeQuery();
        $data = $statement->fetch();
        $this->setAllowedMethods(['update', 'delete', 'deleteBySlug', 'save']);
        if ($data)
            return $this->arrayToAttributes($data);
        return null;
    }
    protected function getMethod($array = [])
    {
        if ($this->getSql() == '') {
            if (empty($array)) {
                $fields = $this->getTableName() . '.*';
            } else {
                foreach ($array as $key => $field) {
                    $array[$key] = $this->getAttributeName($field);
                }
                $fields = implode(' , ', $array);
            }
            $this->setSql("SELECT $fields FROM " . $this->getTableName());
        }
        $this->setWhere("AND", $this->getAttributeName($this->deletedAt) . " IS NULL ");
        $statement = $this->executeQuery();
        $data = $statement->fetchAll();
        if ($data) {
            $this->arrayToObjects($data);
            return $this->collection;
        }
        return [];
    }
    protected function paginateMethod($perPage)
    {

        $this->setWhere("AND", "{$this->getAttributeName($this->deletedAt)} IS NULL ");
        if ($this->is_relation)
            $totalRows = $this->getRelationCount();
        else
            $totalRows = $this->getCount();
        $currentPage = isset($_GET["_pageid"]) ? (int) $_GET["_pageid"] : 1;
        $totalPages = ceil($totalRows / $perPage);
        $currentPage = min($currentPage, $totalPages);
        $currentPage = max($currentPage, 1);
        $currentRow = ($currentPage - 1) * $perPage;
        $this->setLimit($currentRow, $perPage);
        if ($this->getSql() == "") {
            $this->setSql("SELECT {$this->getTableName()}.* FROM {$this->getTableName()}");
        }
        $statement = $this->executeQUery();
        $data = $statement->fetchAll();
        if ($data) {
            $this->arrayToObjects($data);
            return $this->collection;
        }
        return [];
    }
}
