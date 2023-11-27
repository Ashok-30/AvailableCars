<?php
include('templates/ownerdashboardheader.php');
include('templates/ownersidebar.php');
include('config/db_connect.php');
$user_id = $_SESSION['id'];
$first_name=$_SESSION['first_name'];
$last_name=$_SESSION['last_name'];
$address=$_SESSION['address'];
$pincode=$_SESSION['pincode'];
$email=$_SESSION['email'];
$phone=$_SESSION['phone'];
$password=$_SESSION['password'];

?>
<div class="container">
    <div class="profile">
    <form id="profileForm" method="POST" action="update_profile.php">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="" alt="Add image" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>John Doe</h4>
                      <input type="file" id="fileInput" style="display: none;" accept="image/*">
                        
                     
                      <button type="button" id="uploadBtn"class="btn btn-primary">Add Photo</button>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
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
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Password</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                        <input type="password" id="passwordField" name="password" value="<?php echo $password; ?>" disabled >
                    </div>
                    <div class=" col-sm-3">
                        <button type="button" id="togglePassword">
                        <i class="fa fa-eye toggle-icon" id="toggleIcon"></i>
                        </button>
                    </div>
                  </div>
<hr>

                  <div class="row">
                  <div class="col-sm-12">
                    <button type="button" id="editProfile" class="btn btn-info">Edit</button>
                    <button type="submit" id="saveProfile" class="btn btn-success" style="display: none;">Save</button>
                </div>
                  </div>
</form>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#togglePassword").click(function() {
        var passwordField = $("#passwordField");
        var toggleIcon = $("#toggleIcon");
        
        if (passwordField.attr("type") === "password") {
            passwordField.attr("type", "text");
            toggleIcon.removeClass("fa-eye");
            toggleIcon.addClass("fa-eye-slash");
        } else {
            passwordField.attr("type", "password");
            toggleIcon.removeClass("fa-eye-slash");
            toggleIcon.addClass("fa-eye");
        }
    });

    $("#editProfile").click(function() {
        // Enable all input fields for editing
        $("#profileForm input").prop("readonly", false);
        $("#passwordField").prop("disabled", false); 
        $("#saveProfile").show();
        $(this).hide();
    });

    $("#saveProfile").click(function() {
        // Submit the form to update profile
        $("#profileForm").submit();
    });
});
document.getElementById("uploadBtn").addEventListener("click", function() {
    document.getElementById("fileInput").click();
});

document.getElementById("fileInput").addEventListener("change", function() {
    // Handle file selection here
    var file = this.files[0];
    if (file) {
        // You can use this file object to preview or upload the image
        console.log("Selected file:", file);
        // You can submit the form or perform any other necessary action here
    }
});
</script>