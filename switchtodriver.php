<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Change the role to Driver (Renter)
    $_SESSION['role'] = 'Renter'; 

    // Redirect to the driver dashboard
    header('Location: driverdashboard.php');
    exit();
} else {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}
?>
