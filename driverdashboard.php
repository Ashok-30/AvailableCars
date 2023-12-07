<?php 
session_start();
include('templates/driverdashboardheader.php');
include('templates/sidebar.php');
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'Renter') {
    header('Location: login.php');
    exit();
  }
  
?>

<section class="section index" id="home">

<div class="container">
<div class="row">
  <div class="col-lg-6">
    <div class="index-content">
            <h2 class="h1 index-title">The easy way to Rent a Car</h2> 
              <p class="index-text">Live Anywhere in London!</p>
    </div>
      <form action="availablecars.php" class="index-form" method="POST">
          <div class="input-wrapper">
              <label for="input-1" class="input-label">POSTCODE</label>
                  
                <input type="text"  name="postcode" placeholder="" id="input-1" class="input-field"
        value="<?php echo htmlspecialchars($_POST['postcode'] ?? ''); ?>" aria-label="Postcode"> 
        <div class="">
    <?php echo '<span style="color: red;">' . htmlspecialchars($errors['postcode'] ?? '') . '</span>'; ?>
</div>

          </div>
            <div class="input-wrapper">
              <label for="input-2" class="input-label">Check-in time</label>
                   <input type="datetime-local" name="startdatetime" id="input-2" class="input-field" placeholder="">
            </div>
            <div class="input-wrapper">
              <label for="input-3" class="input-label">Checkout time </label>
                    <input type="datetime-local" name="enddatetime" id="input-3" class="input-field" placeholder="">
            </div>
              <button type="submit" name="submit" class="btn index-btn">Search</button>
            </form>
 
  </div>
  <div class="col-lg-6">
    <img src="img/home.jpg" alt="car" class="img-fluid">
  </div>
</div>
</div>
 </section>


