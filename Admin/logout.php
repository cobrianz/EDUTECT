<?php
require "config/constants.php";


if (isset($_SESSION['user-id'])){
    unset($_SESSION['user-id']);
}

header('location: ' . ROOT_URL . 'login.php');
