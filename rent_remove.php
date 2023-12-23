<?php
include('config/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (isset($_POST['add_id'])) {
        $add_id = mysqli_real_escape_string($conn, $_POST['add_id']);
        
      
        $updateSql = "UPDATE add_car SET status = '0' WHERE add_id = '$add_id'";
        
        if (mysqli_query($conn, $updateSql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        exit();
    }
}
?>
