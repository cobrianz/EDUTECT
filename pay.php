<?php
require 'config/database.php';

function generateRandomString()
{
    $prefix = 'TRANSC';
    $randomNumbers = mt_rand(1000000, 9999999); // Generates a random number with 7 digits
    return $prefix . $randomNumbers;
}

$randomString = generateRandomString();

if (isset($_SESSION['user-id'])) {
    $userId = $_SESSION['user-id'];
    $fetch_user_query = "SELECT * FROM users WHERE id = '$userId'";
    $run_query = mysqli_query($connection, $fetch_user_query);
    $user_record = mysqli_fetch_assoc($run_query);
    $email = $user_record['email'];
    $date = date('Y-m-d H:i:s');
    $amount = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_INT);
    $id = $randomString;
    if ($amount < 3000) {

        $_SESSION['pay'] = "Please enter the valid amount.";
        header('location: ' . ROOT_URL . 'account.php');
    } else {
        $sql = "INSERT INTO finances (id, userId, email, date) VALUES ('$id', '$userId', '$email', '$date')";
        $result = mysqli_query($connection, $sql);

        if ($sql) {
            $premium = "UPDATE users SET plan = 1, premium_date = '$date' WHERE id = '$userId'";
            $result = mysqli_query($connection, $premium);

            if ($result) {
                $_SESSION['pay-success'] = "payment successful. Congratulations for becoming premium member.";
                header('location: ' . ROOT_URL . 'account.php');

            }
        } else {
            $_SESSION['pay'] = "unable to to send your payment. contact your instructor.";
            header('location: ' . ROOT_URL . 'account.php');

        }
    }

    // Close the database connection
    mysqli_close($connection);
}
