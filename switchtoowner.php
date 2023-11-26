<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Change the role to Car Owner 
    $_SESSION['role'] = 'Car Owner'; 

    // Redirect to the driver dashboard
    header('Location: carownerdashboard.php');
    exit();
} else {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}
?>
