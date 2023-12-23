<?php
session_start();
include('templates/adminheader.php');

include('config/db_connect.php');
if (isset($_GET['user_id'])) {
  $user_id = $_GET['user_id'];
  
}

$sql = "SELECT * FROM user_details WHERE id = '$user_id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $first_name = $row['first_name'];
  $last_name = $row['last_name'];
  $address = $row['address'];
  $email = $row['email'];
  $phone = $row['phone'];
  $pincode = $row['pincode'];

  $profilePhoto = $row['profile_photo'];

  // Image path
  $imagePath = 'uploads/' . $profilePhoto;
}
?>
<style>

  .editable-field {
    border: 2px solid #916dd9d4; 
    border-radius: 5px;
    padding: 5px;
  }
</style>
<div class="container" style="padding-top: 10%;">
<h2 class="h2 section-title" style="text-align: center;">USER PROFILE</h2>

  <div class="row gutters-sm">
    <div class="col-md-4 mb-3">

      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-column align-items-center text-center">
            <img src="<?php echo $imagePath; ?>" alt="Add image" class="avatar" width="150">
            <div class="mt-3">
              <form id="uploadForm" action="admin_update_photo.php" method="POST" enctype="multipart/form-data">
                
              <input type ="hidden" name="user_id" value="<?php echo $user_id; ?>">
              <label for="fileInput" class="custom-file-upload">

               
                <input required type="file" id="fileInput" name="image" accept="image/*" style="display: none;">
                </label>
                <button type="button" id="uploadButton" class="btn rent-btn">Upload</button>

              </form>



            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="col-md-8">
      <div class="card mb-3">
        <form id="profileForm" method="POST" action="admin_update_profile.php">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">First Name</h6>
              </div>
              <div class="col-sm-9 text-secondary">

                <input required type="text" id="firstName" name="first_name" value="<?php echo $first_name; ?>" readonly>
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Last Name</h6>
              </div>
              <div class="col-sm-9 text-secondary">

                <input required type="text" id="lastName" name="last_name" value="<?php echo $last_name; ?>" readonly>

              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Email</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input required type="text" id="email" name="email" value="<?php echo $email; ?>" readonly>

              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Phone</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input required type="text" id="phone" name="phone" value="<?php echo $phone; ?>" readonly>

              </div>
            </div>
            <hr>

            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Address</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input required type="text" id="address" name="address" value="<?php echo $address; ?>" readonly>

              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Pincode</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input required type="text" id="pincode" name="pincode" value="<?php echo $pincode; ?>" readonly>

              </div>
            </div>

            <div class="col-sm-12" style="padding-top: 20px;">
              <button type="button" id="editProfile" class="btn btn-info">Edit</button>
              <button type="submit" id="saveProfile" class="btn btn-success" style="display: none;">Save</button>
            </div>
            <div class="col-sm-12" style="padding-top: 20px;">
       
<button type="button" class="btn" id="addCarBtn" data-user-id="<?php echo $user_id; ?>">Add Car</button>

           
            </div>

        </form>
      </div>
    </div>
  </div>
</div>
<?php

$sql = "SELECT ac.*, ad.*
FROM add_car ac
JOIN address ad ON ac.add_id = ad.add_id WHERE ac.user_id = $user_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<section class="section listed-car rentals" id="listed-car">
            <div class="container">
              <div class="title-wrapper"style="padding-left:25%;">
                <h2 class="h2 section-title">ALL ADDED CARS</h2>
              </div>
              <ul class="listed-admin-list" style="margin-left:-15%;">';
    
    while ($row = mysqli_fetch_assoc($result)) {
        $imageFileName = $row['image_name'];
        echo '<li>
                <div class="listed-car-card">
                  <figure class="card-banner">';
        
    
        if (!empty($imageFileName) && file_exists("uploads/$imageFileName")) {
          echo "<img class='img-fluid' src='uploads/$imageFileName' alt='Car Image' 
          style='width: 100%; height: 100%; object-fit: cover;'>";
        } else {
            echo "<img src='placeholder-image.jpg' alt='Placeholder Image'>";
            
        }

        echo '</figure>
                  <div class="card-content">
                    <div class="card-title-wrapper">
                      <h3 class="h3 card-title">
                        <a href="#">'.$row['make'].' '.$row['model'].'</a>
                      </h3>
                      <data class="year" value="'.$row['no_of_seats'].'">'.$row['no_of_seats'].' seater</data>
                    </div>
                    <ul class="card-list">
                      <li class="card-list-item">
                        
                        <span class="card-item-text">TRANSMISSION</span>
                      </li>
                      <li class="card-list-item">
                      
                        <span class="card-item-text">'.$row['transmission'].'</span>
                      </li>
                      <li class="card-list-item">
                     
                        <span class="card-item-text">ADDRESS</span>
                      </li>
                      <li class="card-list-item">
                    
                        <span class="card-item-text">'.$row['address'].'</span>
                      </li>
                      
                      <li class="card-list-item">
                    
                        <span class="card-item-text">CAR NUMBER</span>
                      </li>
                      <li class="card-list-item">
                       
                        <span class="card-item-text">'.$row['car_number'].'</span>
                      </li>
                    </ul>
                    <div class="card-price-wrapper">
                      <p class="card-price">
                        <strong>&pound;'.$row['price'].'</strong> / day
                      </p>
                      <button class="btn admin_rent-btn" data-add-id="'.$row['add_id'].'" data-user-id="'.$user_id.'">Rent now</button>

                      <button class="btn remove-btn" data-add-id="'.$row['add_id'].'">Remove</button>
                      </div>
                  </div>
                </div>
              </li>';
    }
    
    echo '</ul></div></section>';
} else {

  echo '<form>
          <!-- Other form elements here -->
          <input type="text" class="add_car_indicator" value="No Cars Listed" disabled>
          <!-- Other form elements here -->
        </form>';
}
?>


<script>
$(document).ready(function() {
    $('.admin_rent-btn').on('click', function() {
        var addId = $(this).data('add-id');
        var userId = $(this).data('user-id'); 

        window.location.href = 'admin_datepicker.php?add_id=' + addId + '&user_id=' + userId;
    });
});
$(document).ready(function() {
    $('.remove-btn').on('click', function() {
        var addId = $(this).data('add-id');
        
        $.ajax({
            type: 'POST',
            url: 'remove_car.php', 
            data: { add_id: addId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    console.log('Status updated successfully');
                    location.reload();
                } else {
                    console.log('Failed to update status');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});

  $(document).ready(function() {
    $('#addCarBtn').click(function(){
        var userId = $(this).data('user-id');
        window.location.href = 'admin_addcar.php?user_id=' + userId;
    });
  
    $("#editProfile").click(function() {
     
      $("#profileForm input").prop("readonly", false);
      $("#passwordField").prop("disabled", false);
      $("#saveProfile").show();
      $(this).hide();
      $("#profileForm input").addClass("editable-field");
    });

    $("#saveProfile").click(function() {

      $("#profileForm").submit();
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('fileInput').addEventListener('change', function() {
      document.getElementById('uploadForm').submit();
    });

    document.querySelector('.custom-file-upload').addEventListener('click', function() {
      document.getElementById('fileInput').click();
    });

    document.getElementById('uploadButton').addEventListener('click', function() {
      document.getElementById('fileInput').click();
    });
  });
</script>