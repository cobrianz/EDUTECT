<?php
require 'config/constants.php';
$email = $_SESSION['login-data']['email'] ?? null;
$password = $_SESSION['login-data']['password'] ?? null;

unset($_SESSION['login-data']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUTECH</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>

</head>


<body>
    <div class="admin-container">

        <div class="admin-form">
            <h2> EDUTECH ADMIN PORTAL</h2>
                <div class="login">
                    <img src="./images/login.webp" alt="">
                </div>
            <form action="login-logic.php" method="POST">
                <?php if (isset($_SESSION['login-success'])): ?>

                    <div class="alert__message success">
                        <p>
                            <?= $_SESSION['login-success'];
                            unset($_SESSION['login-success']);
                            ?>
                        </p>
                    </div>
                <?php elseif (isset($_SESSION['login'])): ?>
                    <div class="alert__message error">
                        <p>
                            <?= $_SESSION['login'];
                            unset($_SESSION['login']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>
                <div class="input">
                    <input type="email" name="email" placeholder="Email" value="<?=$email?>">
                    <span><i class="fa fa-user" aria-hidden="true"></i></span>
                </div>
                <div class="input">
                    <input type="password" name="password" placeholder="Password" value="<?=$password?>">
                    <span><i class="fa fa-lock" aria-hidden="true"></i></span>
                </div>
                <button type="submit" name="submit" value="Submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>