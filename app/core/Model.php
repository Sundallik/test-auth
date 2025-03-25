<?php

namespace App\Core;

abstract class Model
{
    use Database;

    protected $table;

    public function create($data)
    {
        $keys = array_keys($data);

        $query = "insert into $this->table (".implode(",", $keys).") values (:".implode(",:", $keys).")";
        $this->query($query, $data);

        return false;
    }

    public function find(array $data)
    {
        $keys = array_keys($data);

        $query = "select * from $this->table where ";
        foreach ($keys as $key) {
            $query .= $key . " = :". $key . " and ";
        }
        $query = substr($query, 0, -5) . " limit 1";

        return $this->query($query, $data);
    }

    public function update($data)
    {
        $keys = array_keys($data);

        $query = "update $this->table set ";
        foreach ($keys as $key) {
            $query .= $key . " = :". $key . ", ";
        }
        $query = trim($query,", ");
        $query .= " where id = :id ";

        $this->query($query, $data);
        return false;
    }
}