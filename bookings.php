<?php

include 'config/db_connect.php';
$user_id = $_GET['user_id'];
$add_id = "$_GET[add_id]";
$booking_status = 1;



$sql = "INSERT INTO booking (user_id, add_id, booking_status,booked_time) VALUES ('$user_id', '$add_id', '$booking_status',NOW())";

if (mysqli_query($conn, $sql)) {

    echo '<script>window.location.href = "booking_display.php?user_id=' . $_GET['user_id'] . '";</script>';
    exit();
} else {
    // Query error
    echo 'query error: ' . mysqli_error($conn);
}

?>
