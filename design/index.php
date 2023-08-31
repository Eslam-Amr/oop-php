<?php
require('./function.php');
session_start();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<div class="text-center">
    <h2 class="text-success">Register Form</h2>
</div>
<div class="text-center">
    <?= displayError2('error', 'password') ?>
    <?= displayError2('error', 'email') ?>
    <?= displayError2('error', 'name') ?>
    <?= displayError2('error', 'image') ?>
    <?= displayError1('request_error') ?>
    <?= success('success', 'user') ?>
</div>

<div class="container w-25 border m-auto mt-2">
    <form action="handelers/handleregister.php" method="POST" class="form-group" >
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name">

        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
                placeholder="Enter E-mail">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleFormControlTextarea1"
            placeholder="Enter Password">
            
        </div>

        <div class="mb-3">
            <input type="submit" class="btn btn-primary" value="Register">
            <a href="login.php" class="btn btn-secondary">Already Have Account</a>
        </div>
    </form>
</div>