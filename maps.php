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

$add_id = $_GET['add_id'] ?? null;
$user_id =$_GET['user_id'] ?? null;
if($user_id === "null"){
    header('Location: login.php');
    exit;
}

$sql = "SELECT add_car.*, address.address
        FROM add_car
        JOIN address ON add_car.add_id = address.add_id
        WHERE add_car.add_id = '$add_id'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="row"style="padding-top: 5%;">';
    echo '<div class="col-lg-6 mt-5">';
    echo '<section class="section listed-car rentals" id="listed-car">
            <div class="container">
              <ul>';

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
                        <ion-icon name="flash-outline"></ion-icon>
                        <span class="card-item-text">TRANSMISSION</span>
                      </li>
                      <li class="card-list-item">
                        <ion-icon name="flash-outline"></ion-icon>
                        <span class="card-item-text">'.$row['transmission'].'</span>
                      </li>

                      <li class="card-list-item">
                        <ion-icon name="flash-outline"></ion-icon>
                        <span class="card-item-text">ADDRESS</span>
                      </li>
                      <li class="card-list-item">
                        <ion-icon name="hardware-chip-outline"></ion-icon>
                        <span class="card-item-text">'.$row['address'].'</span>
                      </li>
                      
                      <li class="card-list-item">
                        <ion-icon name="flash-outline"></ion-icon>
                        <span class="card-item-text">CAR NUMBER</span>
                      </li>
                      <li class="card-list-item">
                        <ion-icon name="hardware-chip-outline"></ion-icon>
                        <span class="card-item-text">'.$row['car_number'].'</span>
                      </li>
                    </ul>
                    <div class="card-price-wrapper">
                      <p class="card-price">
                        <strong>&pound;'.$row['price'].'</strong> / day
                      </p>
                      <form action="payment.php?add_id='.$row['add_id'].'&user_id='.$user_id.'" method="POST">
                      <button type="submit" class="btn rent-btn">Book now</button>
                  </form>
                  
                    </div>
                  </div>
                </div>
              </li>';
    }
    
    echo '</ul></div></section> </div>';

    echo '<div class="col-lg-6 mt-5">';
    if ($add_id) {
        $sql2 = "SELECT latitude, longitude FROM address WHERE add_id = $add_id";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2 && mysqli_num_rows($result2) > 0) {
            $row2 = mysqli_fetch_assoc($result2);
            $latitude = $row2['latitude'];
            $longitude = $row2['longitude'];
            

            $destination = $latitude . ',' . $longitude;
            $map_url = 'https://www.google.com/maps/embed/v1/directions?key=???&origin=current_location&destination=' . $destination . '&zoom=15';
            
            echo '<iframe src="' . $map_url . '" width="600" height="700" frameborder="0" style="border:0" allowfullscreen></iframe>';
        } else {
            echo 'No location found for this car.';
        }
    } else {
        echo 'No add_id provided.';
    }
    echo '</div>
    </div>';
}

?>
