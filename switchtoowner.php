<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
   
    $_SESSION['role'] = 'Car Owner'; 

   
    header('Location: carownerdashboard.php');
    exit();
} else {
   
    header('Location: login.php');
    exit();
}
?>
