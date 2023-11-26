<?php
include 'config/db_connect.php';

if (isset($_POST['car_make'])) {
    $carMake = $_POST['car_make'];
    $sql = "SELECT car_model FROM car WHERE car_make = '$carMake'";
    $result = $conn->query($sql);

    $options = '<option value="" disabled selected>Select car model</option>';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options .= '<option value="' . $row['car_model'] . '">' . $row['car_model'] . '</option>';
        }
    }
    echo $options;
}
?>
