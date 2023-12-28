<?php 
session_start();
$role = $_SESSION['role'] ?? '';

if ($role === 'Renter') {
  include('templates/driverdashboardheader.php');

  include('config/db_connect.php');;
} else {
  include('templates/header.php');
  
  include('config/db_connect.php');
}



$user_id = $_SESSION['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $user_id = $_SESSION['id'];
  $postcode = $_POST['postcode'] ?? '';
  $startDateTime = $_POST['startdatetime'] ?? '';
  $endDateTime = $_POST['enddatetime'] ?? '';
$sql = "SELECT add_car.*, address.address
FROM add_car
JOIN address ON add_car.add_id = address.add_id
JOIN available_dates ON add_car.add_id = available_dates.add_id
LEFT JOIN booking ON add_car.add_id = booking.add_id
WHERE add_car.status = 1
AND address.postcode = '$postcode'
AND add_car.user_id != '$user_id'
AND '$startDateTime' BETWEEN available_dates.startdatetime AND available_dates.enddatetime
AND '$endDateTime' BETWEEN available_dates.startdatetime AND available_dates.enddatetime
AND (booking.booking_status IS NULL OR booking.booking_status != 1);


";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    echo '<section class="section listed-car rentals"style="margin-right: 2%;padding-top: 3%;margin-left: 2%;" id="listed-car">
            <div class="container">
              <div class="title-wrapper">
                <h2 class="h2 section-title">CARS FOR YOUR LOCATION</h2>
              </div>
              <ul class="listed-car-list">';
    
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
                     
                      <button class="btn rent-btn login-btn" onclick="redirectToBooking('.$row['add_id'].')">View Location</button>
                      
                      

                      </div>
                  </div>
                </div>
              </li>';
    }
    
    echo '</ul></div></section>';
} else {
 
  echo '<div class="container" style="text-align: center;">';
  echo '<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">';
  echo '<form>';
  echo '<input type="text" class="add_car_indicator" value="Sorry, Currently no cars in this location" disabled>';
  echo '</form>';
  echo '</div>';
  echo '</div>';
  
}
}
?>
<script>

function redirectToBooking(addId) {
    var userId = <?php echo json_encode($user_id); ?>;

    window.location.href = 'maps.php?add_id=' + addId + '&user_id=' + userId;
}

</script>

