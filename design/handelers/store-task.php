<?php
require('../function.php');
require('../conAndQueryFunction.php');
session_start();
if(isset($_SESSION['auth'])){
    $id=$_SESSION['auth']['id'];
    
}
    if(checkMethod("POST")&&isset($_POST['title'])){
        $title=sanitize($_POST['title']);
        if(!userValidation::maxLength($title,25)){
            $_SESSION['error']='filed should be less than 25 char';
            header('location:../todo.php');
        }
        if(!userValidation::minLength($title,6)){
            $_SESSION['error']='filed should be more than 6 char';
            header('location:../todo.php');
        }    
        if(!userValidation::notNull($title)){
        $_SESSION['error']='filed require';
        header('location:../todo.php');
        
    }
    header("location:../todo.php");
}else{
    
    $_SESSION['error']='invalid method';
    header("location:../todo.php");
}
if(!isset($_SESSION['error'])){
    $dataBase= new dataBaseConnection();
$dataBase->insertData( "tasks",['title','users_id'],["$title","$id"],"task","../todo.php");

}