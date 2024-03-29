<?php
include('templates/ownerdashboardheader.php');
include('templates/ownersidebar.php');
include('config/db_connect.php');

$user_id = $_SESSION['id'];
 // Replace 'Your_Timezone' with your desired timezone



$sql = "SELECT ac.*, ad.*, adt.startdatetime, adt.enddatetime
FROM add_car ac
JOIN address ad ON ac.add_id = ad.add_id
JOIN available_dates adt ON ac.add_id = adt.add_id

WHERE ac.user_id = $user_id
AND ac.status = 1


AND ac.add_id NOT IN (
    SELECT DISTINCT add_id
    FROM booking
    WHERE add_id = ac.add_id
)
";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<section class="section listed-car rentals" id="listed-car">
            <div class="container">
              <div class="title-wrapper">
                <h2 class="h2 section-title">CARS OPEN TO RENT</h2>
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
                      <ion-icon name="flash-outline"></ion-icon>
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
                      <li class="card-list-item">
                      <ion-icon name="flash-outline"></ion-icon>
                      <span class="card-item-text">Available from</span></span>
                    </li>
                    <li class="card-list-item">
                      <ion-icon name="hardware-chip-outline"></ion-icon>
                      <span class="card-item-text">'.$row['startdatetime'].'</span>
                    </li>
                    <li class="card-list-item">
                    <ion-icon name="flash-outline"></ion-icon>
                    <span class="card-item-text">Available till</span></span>
                  </li>
                  <li class="card-list-item">
                    <ion-icon name="hardware-chip-outline"></ion-icon>
                    <span class="card-item-text">'.$row['enddatetime'].'</span>
                  </li>
                      
                    </ul>
                    <div class="card-price-wrapper">
                      <p class="card-price">
                        <strong>&pound;'.$row['price'].'</strong> / day
                      </p>
                      <button class="btn removefromrent-btn" data-add-id="'.$row['add_id'].'">Remove from Rent</button>
                      
                      </div>
                  </div>
                </div>
              </li>';
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
<script>
$(document).ready(function() {
    $('.removefromrent-btn').on('click', function() {
        var addId = $(this).data('add-id');
        
        $.ajax({
            type: 'POST',
            url: 'rent_remove.php', 
            data: { add_id: addId },
            dataType: 'json',
            success: function(response) {
    console.log(response);  // Log the response to the console
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
</script>
