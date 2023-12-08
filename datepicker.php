<?php 
session_start();
include('templates/ownerdashboardheader.php');
include('templates/ownersidebar.php');
include('config/db_connect.php');
$user_id = $_SESSION['id'];

if (isset($_GET['add_id'])) {
    
    $addId = $_GET['add_id'];
    $stmt = $conn->prepare("SELECT status FROM add_car WHERE add_id = ?");
    $stmt->bind_param('i', $addId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['status'] == 1) {
            
            echo '<script>alert("Car is already rented.");</script>';
            // Redirect to listings.php after showing the message
            echo '<script>window.location.href = "listings.php";</script>';
            exit();
        }
    } 
} 
?>

<section class="section index" id="home" style="padding-left: 15%;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="index-content">
                    <h2 class="h1 index-title">Enter Start Date and End Date</h2>
                </div>
                <form action="submit_dates.php" id="dateForm" class="index-form" method="POST" onsubmit="return validateForm()">
                
                    <div class="input-wrapper">
                        <label for="startDateTime" class="input-label">Rent Start Time</label>
                        <input type="datetime-local" name="startDateTime" id="startDateTime" class="input-field" placeholder="" required>
                    </div>
                    <div class="input-wrapper">
                        <label for="endDateTime" class="input-label">End Renting Time</label>
                        <input type="datetime-local" name="endDateTime" id="endDateTime" class="input-field" placeholder="" required>
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
function validateForm() {
    var startDateTime = new Date(document.forms["dateForm"]["startDateTime"].value);
    var endDateTime = new Date(document.forms["dateForm"]["endDateTime"].value);
    var currentDateTime = new Date();

    if (startDateTime < currentDateTime) {
        alert("Rent Start Time cannot be in the past");
        return false;
    }

    if (endDateTime < startDateTime) {
        alert("End Renting Time cannot be earlier than Rent Start Time");
        return false;
    }

    return true; 
}

$(document).ready(function() {
    $('.rent-btn').on('click', function() {
        var addId = $('#add_id').val();
        $('#add_id').val(addId);
    });
});
</script>
