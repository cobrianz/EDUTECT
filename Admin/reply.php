<?php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $reply_message = $_POST['message'];
    $message_time = date('Y-m-d H:i:s');
    // Prepare an update statement
    $update_query = "UPDATE notifications SET reply = ?, reply_time = ? WHERE id = ?";
    $stmt = mysqli_prepare($connection, $update_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssi', $reply_message, $message_time, $user_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['reply-success'] = "Reply sent successfully.";
        } else {
            $_SESSION['reply'] = "Unable to send reply. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['reply'] = "Technical error. Please contact the developers.";
    }

    header("Location: ".ROOT_URL); 
    exit();
}
