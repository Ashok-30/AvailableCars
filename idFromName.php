<?php
include 'config/db_connect.php';

if (isset($_POST['name'])) {
    $searchedName = $_POST['name'];

    
    $stmt = $conn->prepare("SELECT id FROM user_details WHERE first_name = ?");
    $stmt->bind_param("s", $searchedName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        echo $id;
    } else {
        echo "ID not found"; 
    }

    $stmt->close();
    $conn->close();
}
?>
