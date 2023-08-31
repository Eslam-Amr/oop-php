<?php
session_start();
require('../conAndQueryFunction.php');
if (isset($_GET['id'])) {
$dataBase=new dataBaseConnection();
    $id = $_GET['id'];
    $dataBase->deleteData("tasks",$id);
    header("location:../todo.php");
}