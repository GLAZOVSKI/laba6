<?php
session_start();

require_once 'manage.php';
require 'login.php';

$DB = new Book();

if (!empty($_GET['logout'])) {
    unset($_SESSION['auth']);
    $messages = '<div class="bg-success p-4 mt-4 text-light rounded">Вы вышли из системы!</div>';
}

if (!empty($_POST['submit']) && $_POST['submit'] == 'SIGNIN') {
    if (login($_POST['login'], $_POST['password'])) {
        $messages = '<div class="bg-success p-4 mt-4 text-light rounded">Вы вошли в систему!</div>';
    }else {
        $messages = '<div class="bg-danger p-4 mt-4 text-light rounded">Не верный логин или пароль!</div>';
    }
}

if (!empty($_GET['del'] && $_SESSION['auth'])) {
    if ($DB->delete($_GET['id'])) {
        $messages = '<div class="bg-success p-4 mt-4 text-light rounded">Запись удалена!</div>';
    }
}

if (!empty($_POST['submit']) && $_POST['submit'] == 'ADD') {
    if ( $DB->add($_POST['author'], $_POST['title'], $_POST['type'], $_POST['year']) ) {
        $messages = '<div class="bg-success p-4 mt-4 text-light rounded">Запись добавлена!</div>';
    }
}

if (!empty($_POST['submit']) && $_POST['submit'] == 'EDIT') {
    if ( $DB->edit($_POST['author'], $_POST['title'], $_POST['type'], $_POST['year'], $_GET['id']) ) {
        $messages = '<div class="bg-success p-4 mt-4 text-light rounded">Запись изменена!</div>';
    }
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Библеотека</title>
</head>
<body>
<div class="container">
    <?php include "header.php"; ?>

    <?= $messages; ?>

    <?php
    if (!empty($_GET['log'])) { ?>
            <div class="bg-secondary p-4 mt-4 text-light rounded">
                <form action="" method="post">
                    <h4>Авторизация</h4>

                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" name="login" placeholder="Login" required>
                        </div>
                        <div class="col">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>

                    <input type="submit" name="submit" class="btn-primary btn mt-2" value="SIGNIN">
                </form>
            </div>
    <?php
    }
    ?>

        <?php
        if (!empty($_GET['edit'] && $_SESSION['auth'])) { ?>
            <div class="bg-secondary p-4 mt-4 text-light rounded">
                <form action="" method="post">
                    <h4>Редактировать запись</h4>

                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" name="author" placeholder="Author" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="title" placeholder="Title" required>
                        </div>
                    </div>

                    <div class="form-row mt-2">
                        <div class="col">
                            <input type="text" class="form-control" name="type" placeholder="Category" required>
                        </div>
                        <div class="col">
                            <input type="number" maxlength="4" class="form-control" name="year" placeholder="Year" required>
                        </div>
                    </div>

                    <input type="submit" name="submit" class="btn-primary btn mt-2" value="EDIT">
                </form>
            </div>
            <?php
        }
        ?>

    <?php
    if (!empty($_GET['add'] && $_SESSION['auth'])) { ?>
        <div class="bg-secondary p-4 mt-4 text-light rounded">
            <form action="" method="post">
                <h4>Добавить запись</h4>

                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" name="author" placeholder="Author" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="title" placeholder="Title" required>
                    </div>
                </div>

                <div class="form-row mt-2">
                    <div class="col">
                        <input type="text" class="form-control" name="type" placeholder="Category" required>
                    </div>
                    <div class="col">
                        <input type="number" maxlength="4" class="form-control" name="year" placeholder="Year" required>
                    </div>
                </div>

                <input type="submit" name="submit" class="btn-primary btn mt-2" value="ADD">
            </form>
        </div>
        <?php
    }
    ?>

    <?= $DB->getAll(); ?>

</div>
</body>
</html>