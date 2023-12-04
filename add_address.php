<?php
include 'templates/addheader.php';
include 'templates/ownersidebar.php';
include ('config/db_connect.php');
session_start();
$user_id = $_SESSION['id'];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['address'], $_POST['latitude'], $_POST['longitude'])) {
        $sql1 = "SELECT add_id FROM add_car ORDER BY add_id DESC LIMIT 1;";
$result1 = $conn->query($sql1);


    // Fetch the result as an associative array
    $row = $result1->fetch_assoc();
    
    // Access the 'add_id' column and assign it to $add_id
    $add_id = $row['add_id'];

        
        $address = $_POST['address'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        
        // Prepare INSERT query
        $sql = "INSERT INTO address (address, latitude, longitude, user_id, add_id) VALUES ('$address', '$latitude', '$longitude', '$user_id', '$add_id')";

        if (mysqli_query($conn, $sql)) {
            // Success - Redirect to another page
            header('Location: listings.php');
            exit();
        } else {
            // Query error
            echo 'Query error: ' . mysqli_error($conn);
        }
    } else {
        echo 'Address or coordinates not provided.';
    }
}

$conn->close();
?>

<div class="container-add">
    <div class="row">
        <div class="col-lg-6 mt-5">
        <h1>ADD ADDRESS for PICKUP</h1>
        <form action="" method="POST" enctype="multipart/form-data">
    <label for="address">Enter Address:</label></br>
    <textarea id="address" name="address" rows="3" cols="50"></textarea>

    <input type="hidden" id="lat" name="latitude">
<input type="hidden" id="lng" name="longitude">
<div style="text-align: left;">
    <button class="btn" type="button" onclick="geocodeAddress()">Submit</button>
</div>
</form>
       
 
        </div>
        <div class="col-lg-6 mt-5">
  <img class="img-fluid" src="img/addcar.jpg">
  </div>
    </div>
</div>
    </div>
    </div>

  




<script src="https://maps.googleapis.com/maps/api/js?key=***&libraries=places" async defer></script>
<script>
function geocodeAddress() {
    var geocoder = new google.maps.Geocoder();
    var address = document.getElementById('address').value;

    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == 'OK') {
            var lat = results[0].geometry.location.lat();
            var lng = results[0].geometry.location.lng();

            // Set latitude and longitude values in hidden input fields
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;

            // Submit the form
            document.querySelector('form').submit();
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}
</script>