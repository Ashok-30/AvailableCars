
<?php
include 'templates/addheader.php';
?>
<style>
  .rating {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 50%;
    margin-top: 10px;
  }

  .rating label {
    font-size: 24px;
    cursor: pointer;
    color: #ccc;
  }

  .rating label:hover,
  .rating label:hover ~ label,
  .rating input:checked ~ label {
    color: gold;
  }
</style>
<div class="container" style="margin-top: 20%;margin-left: 20%;margin-right: 20%;margin-bottom: 20%;">
<form id="ratingForm" method="post" action="">
  <label for="rating"><h2 style="font-family: 'Lucida Console', Monaco, monospace;">Submit Rating for Specific Car</h2></label></br>
  <label for="feedback">Enter Feedback:</label></br>
    <textarea required id="feedback" name="feedback" rows="3" cols="75"></textarea>
  <div class="rating">
    
 
    <input type="radio" id="star1" name="rating" value="1">
    <label for="star1">1★</label>
    <input type="radio" id="star2" name="rating" value="2">
    <label for="star2">2★</label>
    <input type="radio" id="star3" name="rating" value="3">
    <label for="star3">3★</label>
    <input type="radio" id="star4" name="rating" value="4">
    <label for="star4">4★</label>
    <input type="radio" id="star5" name="rating" value="5">
    <label for="star5">5★</label>
  </div>
  <input type="hidden" id="selectedRating" name="selectedRating">
  <input type="submit" class="btn btn-primary" style="width: auto;margin-top: 20px;margin-left: 20%" value="Submit Rating">
</form>
</div>

<script>
  const stars = document.querySelectorAll('.rating input[type="radio"]');
  const selectedRating = document.getElementById('selectedRating');

  stars.forEach(star => {
    star.addEventListener("change", function(event) {
      const clickedRating = event.target.value;
      selectedRating.value = clickedRating;

      // Update the appearance of stars based on the clicked rating
      for (let i = 0; i < stars.length; i++) {
        if (i < clickedRating) {
          stars[i].nextElementSibling.style.color = 'gold';
        } else {
          stars[i].nextElementSibling.style.color = '#ccc';
        }
      }
    });
  });
</script>
<?php

include 'config/db_connect.php'; // Ensure this file contains valid database connection details

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['user_id'])) {
  $feedback = $_POST['feedback'];
    $rating = $_POST["rating"];
    $user_id = $_GET['user_id'];
    $add_id = $_GET['add_id'];
    $finance='10';
    $currentDate = date("Y-m-d");
    $updateSql ="INSERT INTO rating (user_id, add_id,rating,finance,date_added,feedback) 
    VALUES ('$user_id', '$add_id','$rating','$finance',CURDATE(),'$feedback')";
    $result_remove_car = mysqli_query($conn, $updateSql);
    echo '<script>window.location.href = "complete_ride.php?user_id=' . $user_id . '&add_id=' . $add_id . '";</script>';
    exit();
}
?>



