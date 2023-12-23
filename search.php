<?php
include 'config/db_connect.php';
if (isset($_POST['query'])) {
    $search = $_POST['query'];

    // Adjust this query according to your database structure and search requirements
    $sql = "SELECT * FROM user_details WHERE role1 != 'Admin' AND first_name LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row['first_name'] . "\n";
        }
    } else {
        echo "No suggestions found";
    }
}

$conn->close();
?>
