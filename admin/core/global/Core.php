<?php

/**
 * Created by PhpStorm.
 * User: ceeb
 * Date: 8/20/16
 * Time: 8:38 PM
 */
class Core
{
    private $db;
    public $date;

    function __construct()
    {
        require_once __DIR__ . '/../classes/Database.php';
        $this->db = new Database();
    }

    public function date()
    {
        return $this->date = date('Y-m-d H:i:s');
    }

    public function update($field, $table, $criteria)
    {
        $this->db = new Database();
        $sql = "UPDATE " . $table . " SET " . $field . " WHERE " . $criteria;
        $this->db->query($sql);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function execute($sql)
    {
        $this->db = new Database();
        $this->db->query($sql);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($table, $criteria)
    {
        $this->db = new Database();
        $sql = "DELETE FROM " . $table . " WHERE " . $criteria;
        $this->db->query($sql);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCount($field, $table, $criteria = null)
    {
        $this->db = new Database();
        $sql = "SELECT COUNT(" . $field . ") AS count FROM " . $table;
        if ($criteria != null) {
            $sql .= " WHERE " . $criteria;
        }
        $this->db->query($sql);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return $this->db->single();
        } else {
            return null;
        }
    }

    public function getAll($field, $table, $criteria = null)
    {
        $this->db = new Database();
        $sql = "SELECT " . $field . " FROM " . $table;
        if ($criteria != null) {
            $sql .= " WHERE " . $criteria;
        }
        $this->db->query($sql);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return $this->db->resultset();
        } else {
            return null;
        }
    }

    public function getSingle($field, $table, $criteria = null)
    {
        $this->db = new Database();
        $sql = "SELECT " . $field . " FROM " . $table;
        if ($criteria != null) {
            $sql .= " WHERE " . $criteria;
        }
        $this->db->query($sql);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return $this->db->single();
        } else {
            return null;
        }
    }

    public function getSingleValue($table, $prop, $value, $columnName)
    {
        $this->db = new Database();
        $this->db->query("SELECT `$columnName` FROM `$table` WHERE $prop='" . $value . "'");
        $this->db->execute();
        $result = $this->db->single();
        return $result;
    }

    public function getTop($top, $field, $table, $critera = null)
    {
        $this->db = new Database();
        $sql = "SELECT TOP(" . $top . ") " . $field . " FROM " . $table;
        if ($critera != null) {
            $sql .= " WHERE " . $critera;
        }
        $this->db->query($sql);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return $this->db->resultset();
        } else {
            return null;
        }
    }

    public function getMax($field, $table, $critera = null)
    {
        $this->db = new Database();
        $sql = "SELECT MAX(" . $field . ") AS mx FROM " . $table;
        if ($critera != null) {
            $sql .= " WHERE " . $critera;
        }
        $this->db->query($sql);
        if ($this->db->execute()) {
            return $this->db->single();
        } else {
            return null;
        }
    }

    public function getMin($field, $table, $critera = null)
    {
        $this->db = new Database();
        $sql = "SELECT MIN(" . $field . ") AS mn FROM " . $table;
        if ($critera != null) {
            $sql .= " WHERE " . $critera;
        }
        $this->db->query($sql);
        if ($this->db->execute()) {
            return $this->db->single();
        } else {
            return null;
        }
    }


}