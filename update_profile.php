<?php
// update_profile.php

session_start();
include('config/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Retrieve form data
    $user_id = $_SESSION['id'];
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    

    // Update user profile in the database
    $sql = "UPDATE user_details SET first_name='$first_name', last_name='$last_name', address='$address', pincode='$pincode', email='$email', phone='$phone', password='$password' WHERE id='$user_id'";

   

    if (mysqli_query($conn, $sql)) {
        $sql_fetch_updated_data = "SELECT * FROM user_details WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql_fetch_updated_data);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['pincode'] = $row['pincode'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['password'] = $row['password'];
    }
        
        // Redirect to the profile page after successful update
        header('Location: profile.php');
        exit();
    } else {
        // Handle update failure
        echo 'Error updating profile: ' . mysqli_error($conn);
    }
} else {
    // Handle invalid request method
    echo 'Invalid request method';
}
?>