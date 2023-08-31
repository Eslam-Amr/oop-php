<?php
session_start();
require("../function.php");
require("../conAndQueryFunction.php");
$conn = mysqli_connect("localhost", "root", "", "todoapp");
if (!$conn) {
    echo "not connected" . "<br>";
}
if (checkMethod("POST")) {
    $errors = [];
    foreach ($_POST as $key => $value) {
        $$key = sanitize($value);
    }
    if (!userValidation::notNull($email)) {
        $errors['email'] = "Email is required";
    } elseif (!userValidation::emailValid($email)) {
        $errors['email'] = "Email is invalid";
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
        $rows = $dataBase->getData("users", "name,email,password,id");
        foreach ($rows as $row) {
            if ($row['email'] == $email) {
                if ($row['password'] == $password) {
                    $_SESSION['auth'] = $row;
                    header("location:../todo.php");
                    die;
                }
            } else {
                $_SESSION['error_login'] = "Invalid email or password";
                header("location:../login.php");
            }
        }
    } else {
        $_SESSION['error'] = $errors;
        header("location:../login.php");
        die();
    }
} else {
    $_SESSION['error_method'] = "Invalid";
    header("location:../login.php");
    die();
}