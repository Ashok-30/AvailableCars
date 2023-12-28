<?php
session_start();
$user_id = $_SESSION['id'] ?? '';
?>
<div class="sidebar">
  
  <a href="carownerdashboard.php">Dashboard</a>
  <a href="addcar.php">Add a Car</a>
  <a href="rentals.php">Rentals</a>
  <a href="listings.php">Listings</a>
  

  <a href="#" onclick="navigateToBooking(<?php echo $user_id; ?>)">Booked</a>

 
  <a href="profile.php">Profile</a>
  <a href="#contact">Help</a>
</div>
<script>
  function navigateToBooking(userId) {

    window.location.href = 'booked.php?user_id=' + userId;
  }
</script>