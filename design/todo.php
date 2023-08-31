<?php
session_start();
require('./conAndQueryFunction.php');
$dataBase = new dataBaseConnection();
$result = $dataBase->getData("tasks");
if (!isset($_SESSION['auth'])) {
    header('location:./login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <form action="handelers/store-task.php" method="POST" class="form border p-2 my-5">
                    <?php
                    if (isset($_SESSION['auth'])): ?>
                        <div class="alert alert-warning ">
                            <h2>
                                Name:
                                <?= $_SESSION['auth']['name']; ?>
                            </h2>
                        </div>
                    <?php endif; ?>
                    <a href="./handelers/logout.php" class="btn btn-danger">LOG OUT</a>
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger text-center">
                            <?= $_SESSION['error']; ?>
                            <?php unset($_SESSION["error"]); ?>
                        </div>
                    <?php endif ?>
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success text-center">
                            <?= $_SESSION['success']; ?>
                            <?php unset($_SESSION["success"]); ?>
                        </div>
                    <?php endif ?>
                    <?php if (isset($_SESSION['delete'])): ?>
                        <div class="alert alert-danger text-center">
                            <?= $_SESSION['delete']; ?>
                            <?php unset($_SESSION["delete"]); ?>
                        </div>
                    <?php endif ?>
                    <input type="text" name="title" class="form-control my-3 border border-success"
                        placeholder="add new todo">
                    <input type="submit" value="Add" class="form-control btn btn-primary my-3 "
                        placeholder="add new todo">
                </form>
            </div>
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row): ?>
                            <?php
                            if ($_SESSION['auth']['id'] == $row['users_id']) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $row['id']; ?>
                                    </td>
                                    <td>
                                        <?= $row['title']; ?>
                                    </td>
                                    <td>
                                        <a href="handelers/delete-tasks.php?id=<?= $row['id']; ?>" class="btn btn-danger"><i
                                                class="fa-solid fa-trash-can"></i> </a>
                                        <a href="handelers/update-tasks.php?id=<?= $row['id']; ?>" class="btn btn-info"><i
                                                class="fa-solid fa-edit"></i> </a>
                                    </td>
                                </tr>
                            <?php }endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>