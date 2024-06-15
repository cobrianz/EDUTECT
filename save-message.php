<?php
require 'config/database.php';

if (isset($_SESSION['user-id'])) {
    $id = $_SESSION['user-id'];
    $fetch_user_query = "SELECT * FROM users WHERE id = '$id'";
    $run_query = mysqli_query($connection, $fetch_user_query);
    $user_record = mysqli_fetch_assoc($run_query);
    $author = $user_record['name'];
    $avatar = $user_record['avatar'];
    $message_time = date('Y-m-d H:i:s');
    $message_text = filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    ;
    // Insert the message into the database
    $sql = "INSERT INTO notifications (user_id, author, avatar, message_text, message_time) VALUES ($id, '$author', '$avatar', '$message_text', '$message_time')";

    if ($sql) {
        $_SESSION['message-success'] = "Message sent successfully, please wait for notification from your instructor.";
    } else {
        $_SESSION['message'] = "unable to to send your message. contact your instructor through email. briancheruiyot022@gmail.com";

    }
    header('location: '. ROOT_URL. 'account.php');
}
if (!mysqli_query($connection, $sql)) {
    $_SESSION['message'] = "Unable to contact the admin please try again later.";
}

// Close the database connection
mysqli_close($connection);
