<?php
// require containFilter class using php
require_once("containFilter.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MySQLHandler
 *
 * @author webre
 */
class MySQLHandler implements DBHandler
{


    private $_db_handler;
    private $_table;
    private $_primary_key;
    public $rawCount;
    // DB
    protected $query;
    protected $sql;
    protected $pdo;
    private $conn;

    public function __construct($table, $primary_key = "id")
    {
        $this->_table = $table;
        $this->connect();
        $this->_primary_key = $primary_key;
        $this->rawCount =  $this->getCount($this->_table);
        $this->conn = $this->_db_handler;
        $this->pdo = new PDO("mysql:host=" . __HOST__ . ";dbname=" . __DB__, __USER__, __PASS__);
    }

    public function connect()
    {
        try {
            $handler = mysqli_connect(__HOST__, __USER__, __PASS__, __DB__, __PORT__);
            if ($handler) {
                $this->_db_handler = $handler;
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            // log();
            die("Somthing went wrong try again later");
        }
    }

    public function disconnect()
    {
        if ($this->_db_handler)
            mysqli_close($this->_db_handler);
    }

    public function get_all_records_paginated($fields = array(), $start = 0)
    {
        $table = $this->_table;
        if (empty($fields)) {
            $sql = "select * from `$table`";
        } else {
            $sql = "select ";
            foreach ($fields as $f) {
                $sql .= " `$f`, ";
            }
            $sql .= "from  `$table` ";
            $sql = str_replace(", from", "from", $sql);
        }
        $sql .= "limit $start," . __RECORDS_PER_PAGE__;
        return $this->get_results($sql);
    }

    public function get_record_by_id($id)
    {

        $primary_key = $this->_primary_key;

        $table = $this->_table;
        $sql = "select * from `$table` where `$primary_key` = '$id' ";

        return $this->get_results($sql);
    }

    private function get_results($sql)
    {
        $this->debug($sql);
        $_handler_results = mysqli_query($this->_db_handler, $sql);
        $_arr_results = array();

        if ($_handler_results) {
            // while ($row = mysqli_fetch_array($_handler_results, MYSQLI_ASSOC)) {
            //     $_arr_results[] = array_change_key_case($row);
            // }
            $this->disconnect();
            return $_arr_results;
        } else {
            $this->disconnect();
            return false;
        }
    }
    function getCount($sql)
    {
        $table = $this->_table;
        $sql = "select count(*) from `$table`";
        $_handler_results = mysqli_query($this->_db_handler, $sql);
        $count = mysqli_fetch_array($_handler_results)[0];

        return $count;
    }
    public function save($new_values)
    {
        if (is_array($new_values)) {
            $table = $this->_table;
            $sql1 = "insert into `$table` (";
            $sql2 = " values (";
            foreach ($new_values as $key => $value) {
                $sql1 .= "`$key` ,";
                if (is_numeric($value))
                    $sql2 .= " $value ,";
                else
                    $sql2 .= " '" . $value . "' ,";
            }
            $sql1 = $sql1 . ") ";
            $sql2 = $sql2 . ") ";
            $sql1 = str_replace(",)", ")", $sql1);
            $sql2 = str_replace(",)", ")", $sql2);
            $sql = $sql1 . $sql2;


            if (mysqli_query($this->_db_handler, $sql)) {
                $this->disconnect();
                return true;
            } else {
                $this->disconnect();
                return false;
            }
        }
    }

    public function filter($column, $column_value)
    {
        $table = $this->_table;
        $filter = new ContainFilter($column, $column_value);
        $where = $filter->get_sql();
        $sql = "select * from `$table` where $where ";
        return $this->get_results($sql);
    }

    public function update($edited_values, $id)
    {
        $table = $this->_table;
        $primary_key = $this->_primary_key;
        $sql = "update  `" . $table . "` set  ";
        foreach ($edited_values as $key => $value) {
            if ($key != $primary_key) {
                if (!is_numeric($value))
                    $sql .= " `$key` = '$value'  ,";
                else
                    $sql .= " `$key` = $value ,";
            }
        }

        $sql .= "where `" . $primary_key . "` = $id";
        $sql = str_replace(",where", "where", $sql);

        if (mysqli_query($this->_db_handler, $sql)) {
            $this->disconnect();
            return true;
        } else {
            $this->disconnect();
            return false;
        }
    }


    public function delete($id)
    {
        $table = $this->_table;
        $primary_key = $this->_primary_key;
        $sql = "delete  from `" . $table . "` where `" . $primary_key . "` = $id";
        $this->debug($sql);
        if (mysqli_query($this->_db_handler, $sql)) {
            $this->disconnect();
            return true;
        } else {
            $this->disconnect();
            return false;
        }
    }

    private function debug($sql)
    {
        if (__Debug__Mode__ === 1)
            echo "<h5>Sent Query: </h5>" . $sql . "<br/> <br/>";
    }
    //============================= DB =======================================
    public function selectAll($table)
    {
        $query = mysqli_query($this->conn, "SELECT * FROM `$table`");
        $data = $query->fetch_all(MYSQLI_ASSOC);

        return $data;
    }
    public function select($table, $column)
    {
        $this->sql = "SELECT $column FROM `$table`";

        return $this;
    }

    public function where($column, $compair, $value)
    {
        $this->sql  .=  "WHERE `$column` $compair $value";

        return $this;
    }
    public function having($column, $compair, $value)
    {
        $this->sql  .=  "Having `$column` $compair $value;";
        // var_dump($this->sql);
        return $this;
    }
    public function andWhere($column, $compair, $value)
    {
        $this->sql  .=  "AND `$column` $compair $value;";

        return $this;
    }
    public function orWhere($column, $compair, $value)
    {
        $this->sql  .=  "OR `$column`$compair $value;";

        return $this;
    }
    public function join($column, $col1, $condition, $col2)
    {
        $this->sql  .=  "JOIN `$column` ON  $col1 $condition $col2 ";
        // var_dump($this->sql);

        return $this;
    }
    public function groupBy($column)
    {
        $this->sql  .=  " GROUP BY `$column`; ";
        // var_dump($this->sql);

        return $this;
    }
    public function getALL()
    {
        $this->query = mysqli_query($this->conn, $this->sql);
        $data = mysqli_fetch_all($this->query, MYSQLI_ASSOC);

        return $data;
    }
    public function getOne()
    {
        $this->query = mysqli_query($this->conn, $this->sql);
        $data = mysqli_fetch_assoc($this->query);

        return $data;
    }

    public function insert($table, $data)
    {
        $coulmns = '';
        $values = '';

        foreach ($data as $key => $value) {
            $coulmns .= "`$key` ,";
            $values .= "'$value' ,";
        }

        $coulmns = rtrim($coulmns, ",");
        $values = rtrim($values, ",");

        $this->sql = "INSERT INTO `$table`($coulmns) VALUES ($values);";

        return $this;
    }
    public function updateDB($tabel, $data)
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "`$key` = '$value' ,";
        }

        $set = rtrim($set, ",");

        $this->sql = "UPDATE $tabel SET $set ";
        return $this;
    }
    public function deleteDB($tabel)
    {
        $this->sql = "DELETE FROM `$tabel` ";
        return $this;
    }

    // public function execute()
    // {
    //     // print_r($this->sql);
    //     // die;
    //     $this->query = mysqli_query($this->conn, $this->sql);
    //     if (mysqli_affected_rows($this->conn) > 0) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    public function execute($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    public function fetchAll($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
