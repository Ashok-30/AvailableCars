<?php


session_start();
$role = $_SESSION['role'] ?? '';

if ($role === 'Renter') {
  include('templates/driverdashboardheader.php');

  include('config/db_connect.php');;
} else {
  include('templates/ownerdashboardheader.php');
  include('templates/ownersidebar.php');
  include('config/db_connect.php');
}
$user_id = $_SESSION['id'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$address = $_SESSION['address'];
$pincode = $_SESSION['pincode'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];
$password = $_SESSION['password'];
$sql = "SELECT profile_photo FROM user_details WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $profilePhoto = $row['profile_photo'];


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

<div class="container">
  <div class="profile">

    <div class="row gutters-sm">
      <div class="col-md-4 mb-3">

        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <img src="<?php echo $imagePath; ?>" alt="Add image" class="avatar" width="150">
              <div class="mt-3">
                <form id="uploadForm" action="update_photo.php" method="POST" enctype="multipart/form-data">
                  <label for="fileInput" class="custom-file-upload">

                  
                  <input type="file" id="fileInput" name="image" accept="image/*" style="display: none;">
                  </label>
                  <button type="button" id="uploadButton" class="btn">Upload</button>
                </form>



              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-md-8">
        <div class="card mb-3">
          <form id="profileForm" method="POST" action="update_profile.php">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">First Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">

                  <input type="text" id="firstName" name="first_name" value="<?php echo $first_name; ?>" readonly>

                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Last Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">

                  <input type="text" id="lastName" name="last_name" value="<?php echo $last_name; ?>" readonly>

                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" id="email" name="email" value="<?php echo $email; ?>" readonly>

                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Phone</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" readonly>

                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Address</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" id="address" name="address" value="<?php echo $address; ?>" readonly>

                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Pincode</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" id="pincode" name="pincode" value="<?php echo $pincode; ?>" readonly>

                </div>
              </div>
              
                <div class="col-sm-12" style="padding-top: 20px;">
                  <button type="button" id="editProfile" class="btn btn-info">Edit</button>
                  <button type="submit" id="saveProfile" class="btn btn-success" style="display: none;">Save</button>
                </div>
             
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
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