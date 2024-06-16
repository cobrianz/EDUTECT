<?php
require 'config/database.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate form inputs
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $national_id = mysqli_real_escape_string($connection, $_POST['national']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $salary = mysqli_real_escape_string($connection, $_POST['salary']);
    $password = mysqli_real_escape_string($connection, $_POST['createpassword']);
    $confirm_password = mysqli_real_escape_string($connection, $_POST['confirmpassword']);

    // Validate passwords
    if ($password !== $confirm_password) {
        $_SESSION['register'] = 'Passwords do not match.';
        header('Location: ' . ROOT_URL); // Redirect to admin dashboard or appropriate page
        exit;
    }

    // Check password length
    if (strlen($password) < 8) {
        $_SESSION['register'] = 'Password must be at least 8 characters long.';
        header('Location: ' . ROOT_URL ); // Redirect to admin dashboard or appropriate page
        exit;
    }

    // Check if email already exists
    $email_check_query = "SELECT * FROM admins WHERE email = '$email'";
    $email_check_result = mysqli_query($connection, $email_check_query);
    if (mysqli_num_rows($email_check_result) > 0) {
        $_SESSION['register'] = 'Email already exists.';
        header('Location: ' . ROOT_URL); // Redirect to admin dashboard or appropriate page
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Use static avatar
    $avatar = 'avatar.webp';

    // Get the name of the admin who is adding this new admin
    $admin_id = $_SESSION['admin-id'];
    $added_by_query = "SELECT name FROM admins WHERE id = '$admin_id'";
    $added_by_result = mysqli_query($connection, $added_by_query);
    if ($added_by_row = mysqli_fetch_assoc($added_by_result)) {
        $added_by = $added_by_row['name'];
    } else {
        $_SESSION['register'] = 'Failed to identify the admin adding this user.';
        header('Location: ' . ROOT_URL); // Redirect to admin dashboard or appropriate page
        exit;
    }

    // Insert data into the database
    $query = "INSERT INTO admins (name, email, national_id, phone, salary, password, added_by, date, avatar)
              VALUES ('$name', '$email', '$national_id', '$phone', '$salary', '$hashed_password', '$added_by', NOW(), '$avatar')";

    if (mysqli_query($connection, $query)) {
        $_SESSION['register-success'] = 'Admin registered successfully!';
    } else {
        $_SESSION['register'] = 'Error: ' . mysqli_error($connection);
    }

    header('Location: ' . ROOT_URL); // Redirect to admin dashboard or appropriate page
    exit;
}
