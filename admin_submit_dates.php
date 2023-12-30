<?php
session_start();


include('config/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDateTime = date('Y-m-d H:i:s', strtotime($_POST['startDateTime']));
$endDateTime = date('Y-m-d H:i:s', strtotime($_POST['endDateTime']));

    $user_id = $_POST['user_id'];
    $add_id = $_POST['add_id'];

    
    $sql_insert = "INSERT INTO available_dates (startdatetime, enddatetime, user_id, add_id) 
            VALUES ('$startDateTime', '$endDateTime', '$user_id', '$add_id')";
            
            if (mysqli_query($conn, $sql_insert)) {
             
                $sql_update = "UPDATE add_car SET status = '1' WHERE add_id = '$add_id'";
        
                if (mysqli_query($conn, $sql_update)) {
                    echo '<script>
                    if (confirm("Car Rented Successfully! Click OK to proceed.")) {
                        window.location.href = "admin_profile.php?user_id='.$user_id.'";
                    }
                </script>';
            exit();
                } else {
                    echo "Error updating add_car table: " . mysqli_error($conn);
                }
            } else {
                echo "Error inserting into available_dates table: " . mysqli_error($conn);
            }
        }
        
?>