<?php
include('config/db_connect.php');
$user_id=$_GET['user_id'];
if (isset($_POST['remove_car'])) {
    $remove_add_id = $_POST['add_id_to_remove'];

    
    $sql_remove_car = "DELETE FROM booking WHERE add_id = $remove_add_id";
    
    $result_remove_car = mysqli_query($conn, $sql_remove_car);
    echo '<script>window.location.href = "booked.php?user_id=' . $_GET['user_id'] . '";</script>';
    exit();
}

?>
