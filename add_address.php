<?php
include 'templates/addheader.php';
include 'templates/ownersidebar.php';
include ('config/db_connect.php');
session_start();
$user_id = $_SESSION['id'];
$postcode = '';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['address'], $_POST['latitude'], $_POST['longitude'], $_POST['postcode'])) {
        $sql1 = "SELECT add_id FROM add_car ORDER BY add_id DESC LIMIT 1;";
$result1 = $conn->query($sql1);


    // Fetch the result as an associative array
    $row = $result1->fetch_assoc();

    $add_id = $row['add_id'];

        
        $address = $_POST['address'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $postcode = $_POST['postcode'];
       
        $sql = "INSERT INTO address (address, latitude, longitude, user_id, add_id, postcode) VALUES ('$address', '$latitude', '$longitude', '$user_id', '$add_id', '$postcode')";

        if (mysqli_query($conn, $sql)) {
            
            header('Location: listings.php');
            exit();
        } else {
           
            echo 'Query error: ' . mysqli_error($conn);
        }
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

    <input  type="hidden" id="lat" name="latitude">
<input  type="hidden" id="lng" name="longitude"><br>
<label for="postcode">Enter Postcode:</label></br>
    <textarea id="postcode" name="postcode"></textarea>
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

  




    <script src="https://maps.googleapis.com/maps/api/js?key=googlemapsapi" async defer></script>

<script>
function geocodeAddress() {
    var geocoder = new google.maps.Geocoder();
    var address = document.getElementById('address').value;

    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == 'OK') {
            var lat = results[0].geometry.location.lat();
            var lng = results[0].geometry.location.lng();

      
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;

     
            document.querySelector('form').submit();
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}
</script>