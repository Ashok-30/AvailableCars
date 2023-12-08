<?php
session_start();
include('config/db_connect.php');

$user_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $targetDir = "uploads/";
    $targetFilePath = $targetDir . basename($_FILES["image"]["name"]);
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allow certain file formats
    $allowTypes = array('jpg', 'jpeg', 'png');

    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $newFileName = $user_id . '_' . basename($_FILES["image"]["name"]);
            $newFilePath = $targetDir . $newFileName;

            if (rename($targetFilePath, $newFilePath)) {
                $sql="UPDATE user_details SET profile_photo = '$newFileName' WHERE id = '$user_id'";
                if ($conn->query($sql) === TRUE) {
                    header('Location: profile.php');
                    // Perform additional operations here (if required)
                } else {
                    echo "Error updating profile photo in the database: " . $conn->error;
                }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo 'Error: Invalid file format. Only JPG, JPEG, and PNG files are allowed.';
    }
} else {
    echo "Error: Invalid request.";
}
}
?>
