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
    <style>
        @media only screen and (max-width: 800px) {
            .form-container {
                border-radius: 0;
                border: none;
                box-shadow: none;
            }

            .form-image img {
                width: initial;
            }
        }
    </style>
</head>

<body>
    <div class="hero" style="background: #fff;">
        <div class="container">
            <nav>
                <div class="navbar">
                    <div class="logo">
                        <a href="index.php">
                            <img src="./assets/logo.png" alt="">
                        </a>
                    </div>




                </div>
            </nav>
        </div>
        <div class="hero__section container">
            <div class="form-container">
                <div class="form-image">
                    <img src="./assets/login.png" alt="">
                </div>
                <div class="form-box" style="border-left: none;">
                    <h2>Welcome Back</h2>
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
                    <form action="<?= ROOT_URL ?>login-logic.php" method="POST">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="input-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <button type="submit" name="submit" class="form-btn"><a href="./account.php"
                                style="color: #fff;">Login</a></button>
                        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>