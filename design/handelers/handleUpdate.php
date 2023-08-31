<?php
require("../function.php"); 
require("../conAndQueryFunction.php"); 

session_start();
if(checkMethod("POST")){
    $updatetask=sanitize($_POST['updateTask']);
    if(!userValidation::maxLength($updatetask,25)){
        $_SESSION['error']='filed should be less than 25 char';
        header('location:./update-tasks.php');
    }
    if(!userValidation::minLength($updatetask,6)){
        $_SESSION['error']='filed should be more than 6 char';
        header('location:./update-tasks.php');
    }
    if(!userValidation::notNull($updatetask)){
        $_SESSION['error']='filed require';
        header('location:./update-tasks.php');
        
    }
    
}else{
    $_SESSION['error']='invalid method';
    header('location:../index');
}
if(!isset($_SESSION['error'])){
    $dataBase=new dataBaseConnection();
    $idd=$_SESSION["user_id"];
    $dataBase->updateData("tasks",$updatetask,$idd);
    header('location:../todo.php');
}
var_dump($_POST['updateTask']);