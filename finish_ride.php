<?php
include('config/db_connect.php');
$user_id=$_GET['user_id'];
$add_id = $_GET['add_id'];

    
    $sql_remove_car = "DELETE FROM booking WHERE add_id = $add_id";
    
    $result_remove_car = mysqli_query($conn, $sql_remove_car);
    echo '<script>window.location.href = "booking_display.php?user_id=' . $_GET['user_id'] . '";</script>';
    exit();


?>
