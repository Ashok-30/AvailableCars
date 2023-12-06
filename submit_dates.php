<?php
session_start();

include('config/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDateTime = date('Y-m-d H:i:s', strtotime($_POST['startDateTime']));
$endDateTime = date('Y-m-d H:i:s', strtotime($_POST['endDateTime']));

    $user_id = $_POST['user_id'];
    $add_id = $_POST['add_id'];

    // Insert into available_dates table
    $sql_insert = "INSERT INTO available_dates (startdatetime, enddatetime, user_id, add_id) 
            VALUES ('$startDateTime', '$endDateTime', '$user_id', '$add_id')";
            
            if (mysqli_query($conn, $sql_insert)) {
                // Update the add_car table to mark the car as rented
                $sql_update = "UPDATE add_car SET status = '1' WHERE add_id = '$add_id'";
        
                if (mysqli_query($conn, $sql_update)) {
                    // Redirect to rentals.php after successful insertion and update
                    header("Location: rentals.php");
                    exit();
                } else {
                    echo "Error updating add_car table: " . mysqli_error($conn);
                }
            } else {
                echo "Error inserting into available_dates table: " . mysqli_error($conn);
            }
        }
        
?>