<?php
require "config/constants.php";


if (isset($_SESSION['admin-id'])){
    unset($_SESSION['admin-id']);
}

header('location: ' . ROOT_URL . 'login.php');
