<?php

include('templates/ownerdashboardheader.php');
include('templates/ownersidebar.php');
include 'config/db_connect.php';
$user_id = $_GET['user_id'];
$add_id = "$_GET[add_id]";



$sql = "SELECT *
FROM add_car
WHERE user_id = $user_id
AND add_id IN (
    SELECT add_id
    FROM booking
);
";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<section class="section listed-car rentals" id="listed-car">
            <div class="container">
              <div class="title-wrapper">
                <h2 class="h2 section-title">BOOKED CARS</h2>
              </div>
              <ul class="listed-car-list">';

    while ($row = mysqli_fetch_assoc($result)) {
        $imageFileName = $row['image_name'];
        echo '
        <form action ="complete_ride.php?user_id='. $user_id .'" method="post">
        <li>
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
                        <a href="#">' . $row['make'] . ' ' . $row['model'] . '</a>
                      </h3>
                      <data class="year" value="' . $row['no_of_seats'] . '">' . $row['no_of_seats'] . ' seater</data>
                    </div>
                    <ul class="card-list">
                      <li class="card-list-item">
                        <ion-icon name="flash-outline"></ion-icon>
                        <span class="card-item-text">STATUS</span>
                      </li>
                      <li class="card-list-item">
                        <ion-icon name="flash-outline"></ion-icon>
                        <span class="card-item-text"> BOOKED</span>
                      </li>
                      <li class="card-list-item">
                      <ion-icon name="flash-outline"></ion-icon>
                      <span class="card-item-text">PICK-UP ADDRESS</span>
                    </li>
                    <li class="card-list-item">
                      <ion-icon name="flash-outline"></ion-icon>
                      <span class="card-item-text">' . $row['add_id'] . '</span>
                    </li>
                   
                      <li class="card-list-item">
                        <ion-icon name="flash-outline"></ion-icon>
                        <span class="card-item-text">CAR NUMBER</span>
                      </li>
                      <li class="card-list-item">
                        <ion-icon name="hardware-chip-outline"></ion-icon>
                        <span class="card-item-text">' . $row['car_number'] . '</span>
                      </li>
                    </ul>
                    <div class="card-price-wrapper">
                      <button type="submit" class="btn remove-btn" name="remove_car" 
                      data-add-id="' . $row['add_id'] . '">
                        Remove
                      </button>
                      <input type="hidden" name="add_id_to_remove" 
                      value="' . $row['add_id'] . '">
                    </div>
                  </div>
                </li>
              </form>';
    }

    echo '</ul></div></section>';
} else {

    echo '<form>
          <!-- Other form elements here -->
          <input type="text" class="add_car_indicator" value="No cars Rented. Please rent from listings" disabled>
          <!-- Other form elements here -->
        </form>';
}
?>

