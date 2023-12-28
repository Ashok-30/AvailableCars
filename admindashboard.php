<?php
include 'templates/adminheader.php';
include 'config/db_connect.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

$sql = "SELECT * FROM user_details WHERE id != 56 ORDER BY id LIMIT 10";
$sql1 = "SELECT * FROM user_details WHERE id != '56'";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    echo '<section class="section listed-car rentals" id="listed-car"style="padding-top: 5%;">
            <div class="container">
              <div class="title-wrapper">
                <h2 class="h2 section-title">Users</h2>
              </div>
              <ul class="listed-car-list">';

    while ($row = mysqli_fetch_assoc($result)) {
        $imageFileName = $row['profile_photo'];
        echo '<li>
                <div class="listed-car-card ">
                  <figure>';

        
        if (!empty($imageFileName) && file_exists("uploads/$imageFileName")) {
            echo "<img class='img-fluid' src='uploads/$imageFileName' alt='Car Image' 
          style='height: 15rem;display: block;
          margin-left: auto;
          margin-right: auto;
          '>";
        } else {
            echo "<img class='img-fluid' style='height: 15rem;display: block;
            margin-left: auto;
            margin-right: auto;
            'src='img/profile.png' alt='Placeholder Image'>";
          
        }

        echo '</figure>
                  <div class="card-content">
                    <div class="card-title-wrapper">
                      <h3 class="h3 card-title">
                        <a href="#">' . $row['first_name'] . ' ' . $row['last_name'] . '</a>
                      </h3>
                     
                    </div>
                    <ul class="card-list">
                      <li class="card-list-item">
                        
                        <span class="card-item-text">PINCODE</span>
                      </li>
                      <li class="card-list-item">
                       
                        <span class="card-item-text">' . $row['pincode'] . '</span>
                      </li>
                      <li class="card-list-item">
                        
                      <span class="card-item-text">EMAIL</span>
                    </li>
                    <li class="card-list-item">
                     
                      <span class="card-item-text">' . $row['email'] . '</span>
                    </li>
                     
                      <li class="card-list-item">
                        
                        <span class="card-item-text">ADDRESS</span>
                      </li>
                      <li class="card-list-item">
                       
                        <span class="card-item-text">' . $row['address'] . '</span>
                      </li>
                      
                      <li class="card-list-item">
                       
                        <span class="card-item-text">PHONE</span>
                      </li>
                      <li class="card-list-item">
                      
                        <span class="card-item-text">' . $row['phone'] . '</span>
                      </li>
                    </ul>
                    <div class="card-price-wrapper">
                      <p class="card-price">
                       
                      </p>
                      <button class="btn view-btn" data-add-id="' . $row['id'] . '">View</button>

                      
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
    $('.view-btn').on('click', function() {
        var userId = $(this).data('add-id');
     
        window.location.href = 'admin_profile.php?user_id=' + userId;
    });
});
   
</script>

