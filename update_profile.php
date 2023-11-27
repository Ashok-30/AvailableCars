<?php
// update_profile.php
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

    // Debug: Output form data to check values
    echo var_dump($_POST); // Check if the form data is being received

    // Update user profile in the database
    $sql = "UPDATE user_details SET first_name='$first_name', last_name='$last_name', address='$address', pincode='$pincode', email='$email', phone='$phone', password='$password' WHERE id='$user_id'";

    // Debug: Output SQL query for verification
    var_dump($sql); // Check the generated SQL query

    if (mysqli_query($conn, $sql)) {
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
