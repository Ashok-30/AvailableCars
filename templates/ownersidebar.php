<?php
session_start();
$user_id = $_SESSION['id'] ?? '';
?>
<style>
  .sidebar a.active {
    color: #916dd9d4;

}
</style>
<div class="sidebar">
  
  <a href="carownerdashboard.php" >Dashboard</a>
  <a href="addcar.php">Add a Car</a>
  <a href="rentals.php">Rentals</a>
  <a href="listings.php">Listings</a>
  

  <a href="#" onclick="navigateToBooking(<?php echo $user_id; ?>)">Booked</a>

 
  <a href="profile.php">Profile</a>
  <a href="#contact">Help</a>
</div>
<script>

var currentUrl = window.location.href;
var links = document.querySelectorAll('.sidebar a');

links.forEach(function(link) {
  if (link.href === currentUrl) {
    link.classList.add('active'); 
  }
});

  function navigateToBooking(userId) {

    window.location.href = 'booked.php?user_id=' + userId;
  }
</script>