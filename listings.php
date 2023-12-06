<?php
include('templates/ownerdashboardheader.php');
include('templates/ownersidebar.php');
include('config/db_connect.php');

// Fetch data from the database
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM add_car where user_id = '$user_id'";

$result = mysqli_query($conn, $sql);

// Check if there are rows in the result set
if (mysqli_num_rows($result) > 0) {
    echo '<section class="section listed-car rentals" id="listed-car">
            <div class="container">
              <div class="title-wrapper">
                <h2 class="h2 section-title">ALL ADDED CARS</h2>
              </div>
              <ul class="listed-car-list">';
    
    while ($row = mysqli_fetch_assoc($result)) {
        $imageFileName = $row['image_name'];
        echo '<li>
                <div class="listed-car-card">
                  <figure class="card-banner">';
        
        // Display the image from the 'uploads' folder using the retrieved image name
        if (!empty($imageFileName) && file_exists("uploads/$imageFileName")) {
            echo "<img src='uploads/$imageFileName' alt='Car Image'>";
        } else {
            echo "<img src='placeholder-image.jpg' alt='Placeholder Image'>";
            // If the image does not exist or the 'image_name' column is empty, display a placeholder image
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
                      <button class="btn rent-btn" data-add-id="'.$row['add_id'].'">Rent now</button>
                      <button class="btn remove-btn" data-add-id="'.$row['add_id'].'">Remove</button>
                      </div>
                  </div>
                </div>
              </li>';
    }
    
    echo '</ul></div></section>';
} else {
  // Displaying form with "No cars found in the database" message
  echo '<form>
          <!-- Other form elements here -->
          <input type="text" class="add_car_indicator" value="No cars Rented. Please rent from listings" disabled>
          <!-- Other form elements here -->
        </form>';
}
?>


<script>
$(document).ready(function() {
    $('.rent-btn').on('click', function() {
        var addId = $(this).data('add-id');
        
        $.ajax({
            type: 'POST',
            url: 'rent_car.php', 
            data: { add_id: addId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    console.log('Status updated successfully');
                    location.reload(); // Reload the page after successful update
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
                    location.reload(); // Reload the page after successful update
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
</script>
