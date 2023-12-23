<?php
session_start();

if (isset($_POST['logout'])) {
 
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page after logout
    header("Location: login.php");
    exit();
}
?>
