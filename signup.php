<?php
require 'config/constants.php';

//get back form data after an error occurred

$name = $_SESSION['signup-data']['name'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;


//delete the signup data session
unset($_SESSION['signup-data']);

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
                display: none;
            }

            .form-box {
                margin-top: 0;
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
                <div class="form-image" style="    border-right: none;">
                    <img src="./assets/logout.avif" alt="">
                </div>
                <div class="form-box">
                    <?php if (isset($_SESSION['signup'])): ?>
                        <div class="alert__message error">
                            <p><?= $_SESSION['signup'];
                            unset($_SESSION['signup']);
                            ?>
                            </p>
                        </div>

                        <?php
                    endif
                    ?>
                    <h2>Welcome, Create Account</h2>
                    <form action="<?= ROOT_URL ?>signup__logic.php" enctype="multipart/form-data" method="POST">
                        <div class="input-group">
                            <label for="name">Name *</label>
                            <input type="text" id="name" name="name" value="<?= $name ?>" required>
                        </div>
                        <div class="input-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" value="<?= $email ?>" required>
                        </div>
                        <div class="input-group">
                            <label for="password">Password *</label>
                            <input type="password" id="password" name="createpassword" value="<?= $createpassword ?>"
                                required>
                        </div>
                        <div class="input-group">
                            <label for="confirm-password">Confirm Password *</label>
                            <input type="password" id="confirmpassword" name="confirmpassword"
                                value="<?= $confirmpassword ?>" required>
                        </div>
                        <div class="input-group">
                            <label for="confirm-password">Avatar *</label>
                            <input type="file" id="avatar" name="avatar" required
                                style="border: none; color: slateblue;">
                        </div>
                        <button type="submit" name="submit" class="form-btn">Sign Up</button>
                        <p style="text-align: left;">Already have an account? <a href="login.php">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>