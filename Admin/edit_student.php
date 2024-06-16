
<?php
require 'config/database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $student_id = mysqli_real_escape_string($connection, $_POST['student_id']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['createpassword']); // You might want to hash this
    // Query to update student record
    $update_query = "UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$student_id'";

    // Execute query
    if (mysqli_query($connection, $update_query)) {
        // Update successful
        $_SESSION['register-success'] = "Student record updated successfully.";
        header("Location: " . ROOT_URL); // Redirect to previous page
        exit();
    } else {
        // Update failed
        $_SESSION['register'] = "Failed to update student record: " . mysqli_error($connection);
        header("Location: " . ROOT_URL); // Redirect to previous page
        exit();
    }
} else {
    // Invalid request
    $_SESSION['register'] = "Invalid request to update student record.";
    header("Location: " . ROOT_URL); // Redirect to previous page
    exit();
}