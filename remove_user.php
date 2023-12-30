<?php
include('config/db_connect.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        // Perform deletion query
        $query = "DELETE FROM user_details WHERE id = $user_id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Deletion successful, redirect to admin dashboard
            header("Location: admindashboard.php");
            exit();
        } else {
            // Deletion failed, handle the error as needed
            echo "Deletion failed. Please try again.";
        }
    } else {
        // Display a confirmation popup
        echo '<script>
                var result = confirm("Do you really want to remove user?");
                if (result) {
                    window.location.href = "remove_user.php?user_id=' . $user_id . '&confirm=true";
                } else {
                    window.location.href = "admindashboard.php"; // Redirect back to dashboard
                }
              </script>';
    }
}
?>
