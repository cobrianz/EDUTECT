<?php
require 'config/database.php';

$user_id = $_GET['user_id'];
$fetch_user_query = "SELECT * FROM notifications WHERE id = $user_id";
$fetch_user_result = mysqli_query($connection, $fetch_user_query);

while ($user_record = mysqli_fetch_assoc($fetch_user_result)): ?>
    <div class="notification">
        <span><?= $user_record['reply'] ?></span>
        <small><?= $user_record['reply_time'] ?></small>
    </div>
    <div class="notification send">
        <span><?= $user_record['message_text'] ?></span>
        <small><?= $user_record['message_time'] ?></small>
    </div>
<?php endwhile;
?>
