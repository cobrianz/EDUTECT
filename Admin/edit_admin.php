<?php
require 'config/database.php';



// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs (example validation)
    $admin_id = $_POST['admin_id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];
    $password = $_POST['password'];

    // Perform validation (add more as per your requirements)
    // Example: Check if required fields are not empty

    // Update admin details in the database
    $update_query = "UPDATE admins SET email='$email', phone='$phone', salary='$salary' WHERE id='$admin_id'";

    // Execute the query
    if (mysqli_query($connection, $update_query)) {
        // Update successful
        $_SESSION['register-success'] = "Admin details updated successfully.";
    } else {
        // Update failed
        $_SESSION['register'] = "Failed to update admin details. Please try again.";
    }

    // Redirect back to the admin page or wherever appropriate
    header("Location:". ROOT_URL);
    exit();
} else {
    // Redirect to a proper error page if accessed directly without POST method
    header("Location:" . ROOT_URL);
    exit();
}
