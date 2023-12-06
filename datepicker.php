<?php 
session_start();
include('templates/ownerdashboardheader.php');
include('templates/ownersidebar.php');
$user_id = $_SESSION['id'];

if(isset($_GET['add_id'])) {
    // Retrieve the add_id from the URL
    $addId = $_GET['add_id'];
} 

?>

<section class="section index" id="home" style="padding-left: 15%;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="index-content">
                    <h2 class="h1 index-title">Enter Start Date and End Date</h2>
                </div>
                <form action="submit_dates.php" id="dateForm" method="POST" class="index-form">
                    <div class="input-wrapper">
                        <label for="startDateTime" class="input-label">Rent Start Time</label>
                        <input type="datetime-local" name="startDateTime" id="startDateTime" class="input-field" placeholder="">
                    </div>
                    <div class="input-wrapper">
                        <label for="endDateTime" class="input-label">End Renting Time</label>
                        <input type="datetime-local" name="endDateTime" id="endDateTime" class="input-field" placeholder="">
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" id="add_id" name="add_id" value="<?php echo $addId; ?>">
                    <button type="submit" class="btn index-btn rent-btn">Rent</button>
                </form>
            </div>
            <div class="col-lg-6">
                <img src="img/DatePicker.png" alt="car" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.rent-btn').on('click', function() {
        var addId = $('#add_id').val();
        $('#add_id').val(addId);
    });
});
</script>
