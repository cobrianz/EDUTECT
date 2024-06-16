<?php
require 'config/database.php';


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize admin ID and confirm_delete
    $admin_id = $_POST['admin_id'];
    $confirm_delete = $_POST['confirm_delete'];

    // Perform validation (example validation)
    if (empty($admin_id)) {
        $_SESSION['register'] = "Admin ID is required for deletion.";
        header("Location:". ROOT_URL);
        
    }

    // Check if the user confirmed deletion
    if ($confirm_delete === "yes") {
        // Perform deletion operation
        $delete_query = "DELETE FROM admins WHERE id='$admin_id'";

        // Execute the query
        if (mysqli_query($connection, $delete_query)) {
            // Deletion successful
            $_SESSION['register-success'] = "Admin deleted successfully.";
        } else {
            // Deletion failed
            $_SESSION['register'] = "Failed to delete admin. Please try again.";
        }
    } else {
        // User chose not to delete (do nothing or redirect as needed)
        $_SESSION['register'] = "Deletion cancelled by user.";
    }

    // Redirect back to the admin page or wherever appropriate
    header("Location:". ROOT_URL);
    
} else {
    // Redirect to a proper error page if accessed directly without POST method
    header("Location:". ROOT_URL);
    
}

   
