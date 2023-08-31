<?php

class dataBaseConnection
{
    public $conn;
    function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=todoapp", "root", "");
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            die($e->getMessage());
        }
    }
    public function getData($table, $columns = "*", $condition = true)
    {
        $query = "SELECT $columns FROM $table WHERE $condition";
        $data = $this->conn->query($query);
        return $data->fetchAll();
    }

    public function insertData($table, $columns, $data, $message, $path)
    {
        foreach ($columns as $column) {
            $c[] = '`' . $column . '`';
        }
        $col = implode(', ', $c);
        $d = array_map(function ($x) {
            return gettype($x) == 'string' ? "'" . $x . "'" : $x;
        }, $data);
        $info = implode(', ', $d);
        $query = "INSERT INTO $table ($col) VALUES ($info)";
        $sql = $this->conn->prepare($query);
        $_SESSION["success"] = $message . " added successfully!";
        header("location:$path");
        return $sql->execute();
    }

    public function updateData($table, $data, $condition)
    {
        $query = "UPDATE $table SET title='$data' WHERE id='$condition'";
        $sql = $this->conn->prepare($query);
        return $sql->execute();
    }

    public function deleteData($table, $condition = true)
    {
        $query = "DELETE FROM $table WHERE id=$condition";
        $sql = $this->conn->prepare($query);
        $_SESSION["delete"] = "task deleted successfully!";
        return $sql->execute();
    }
}