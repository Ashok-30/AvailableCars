<?php
include('config/db_connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['address'], $_POST['latitude'], $_POST['longitude'])) {
        $address = $_POST['address'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];

        // Prepare INSERT query
        $sql = "INSERT INTO address (address, latitude, longitude) VALUES ('$address', '$latitude', '$longitude')";

        if ($conn->query($sql) === TRUE) {
            echo "New record inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo 'Address or coordinates not provided.';
    }
}

$conn->close();
?>
