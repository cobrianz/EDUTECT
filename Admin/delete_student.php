
<?php
require 'config/database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $student_id = mysqli_real_escape_string($connection, $_POST['student_id']);
    $confirm_delete = mysqli_real_escape_string($connection, $_POST['confirm_delete']);

    if ($confirm_delete === "yes") {
        // Query to delete student record
        $delete_query = "DELETE FROM users WHERE id='$student_id'";

        // Execute query
        if (mysqli_query($connection, $delete_query)) {
            // Deletion successful
            $_SESSION['register-success'] = "Student deleted successfully.";
            header("Location: " . ROOT_URL); // Redirect to previous page
            exit();
        } else {
            // Deletion failed
            $_SESSION['register'] = "Failed to delete student record: " . mysqli_error($connection);
            header("Location: " . ROOT_URL); // Redirect to previous page
            exit();
        }
    } else {
        // User canceled deletion
        $_SESSION['register'] = "Student deletion canceled.";
        header("Location: " . ROOT_URL); // Redirect to previous page
        exit();
    }
} else {
    // Invalid request
    $_SESSION['register'] = "Invalid request to delete student record.";
    header("Location: " . ROOT_URL); // Redirect to previous page
    exit();
}
?>
