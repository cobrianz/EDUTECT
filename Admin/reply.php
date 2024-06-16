<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];

    $reply_query = "UPDATE notifications SET reply = '$message', reply_time = CURRENT_TIMESTAMP WHERE id = $user_id";
    mysqli_query($connection, $reply_query);

    header('Location: index.php'); // redirect to the chat page
}