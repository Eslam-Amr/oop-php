<?php
session_start();
require_once "../function.php";
require('../conAndQueryFunction.php');
$conn = mysqli_connect("localhost", "root", "", "todoapp");
if (!$conn) {
    echo "not connected" . "<br>";
}
if (checkMethod("POST")) {
    $errors = [];

    foreach ($_POST as $key => $value) {
        $$key = sanitize($value);
    }

    if (!userValidation::notNull($name)) {
        $errors['name'] = "Name is required";
    } elseif (!userValidation::minLength($name, 2)) {
        $errors['name'] = "Name must be at least 3 characters";
    } elseif (!userValidation::maxLength($name, 15)) {
        $errors['name'] = "Name must be smaller than 15 characters";
    }

    if (!userValidation::notNull($email)) {
        $errors['email'] = "Email is required";
    } elseif (!userValidation::emailValid($email)) {
        $errors['email'] = "Email is invalid";
    }
    $sql = "SELECT `email` FROM `users`";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['email'] == $email) {
            $errors['email'] = "Email Already Exists";
        }
    }
    if (!userValidation::notNull($password)) {
        $errors['password'] = "Password is required";
    } elseif (!userValidation::minLength($password, 6)) {
        $errors['password'] = "Password must be at least 7 characters";
    } elseif (!userValidation::maxLength($password, 15)) {
        $errors['password'] = "password must be smaller than 15 characters";
    }
    if (empty($errors)) {
        $dataBase = new dataBaseConnection();
        print_r($dataBase->insertData("users", ['email', 'name', 'password'], [$email, $name, $password], "user", "../index.php"));

    } else {
        $_SESSION['error'] = $errors;
        header("location:../index.php");
    }
} else {
    $_SESSION['request_error'] = "Invalid Method";
    header("location:../index.php");
}