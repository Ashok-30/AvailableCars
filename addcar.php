<?php
session_start();


include 'templates/ownerdashboardheader.php';
include 'templates/ownersidebar.php';
include 'config/db_connect.php';


$sql1 = "SELECT DISTINCT car_make FROM car";
$result1 = $conn->query($sql1);
$car_make = '';


$options = '<option value="" disabled selected>Select car</option>';
if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $options .= '<option value="' . $row['car_make'] . '">' . $row['car_make'] . '</option>';
    }
}

$user_id = $_SESSION['id'];
$status='0';
$make = $model = $no_of_seats = $transmission = $price = $car_number = '';
$errors = array('make' => '', 'model' => '', 'no_of_seats' => '', 'transmission' => '', 'price' => '', 'car_number' => '');

if (isset($_POST["submit"])) {
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
      
        var_dump($_FILES["image"]);

        $targetDir = "uploads/";
        $targetFilePath = $targetDir . basename($_FILES["image"]["name"]);
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'jpeg', 'png');

        if (in_array(strtolower($fileType), $allowTypes)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                $newFileName = $user_id . '_' . basename($_FILES["image"]["name"]);
                $newFilePath = $targetDir . $newFileName;
                if (rename($targetFilePath, $newFilePath)) {
                    echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded as " . $newFileName;
                   
                    var_dump($_POST);
    // Validate make
    if (empty($_POST['make'])) {
        $errors['make'] = 'Make is required';
    } else {
        $make = mysqli_real_escape_string($conn, $_POST['make']);
    }

    // Validate model
    if (empty($_POST['model'])) {
        $errors['model'] = 'Model is required';
    } else {
        $model = mysqli_real_escape_string($conn, $_POST['model']);
    }

    // Validate no_of_seats
    if (empty($_POST['no_of_seats'])) {
        $errors['no_of_seats'] = 'Number of seats is required';
    } else {
        $no_of_seats = mysqli_real_escape_string($conn, $_POST['no_of_seats']);
    }

    // Validate transmission
    if (empty($_POST['transmission'])) {
        $errors['transmission'] = 'Transmission type is required';
    } else {
        $transmission = mysqli_real_escape_string($conn, $_POST['transmission']);
    }

    // Validate price
    if (empty($_POST['price'])) {
        $errors['price'] = 'Price is required';
    } else {
        $price = mysqli_real_escape_string($conn, $_POST['price']);
    }

    // Validate car_number
 
    if (empty($_POST['car_number'])) {
        $errors['car_number'] = 'Car Number is required';
    } else {
        $car_number = mysqli_real_escape_string($conn, $_POST['car_number']);
    }

    if (array_filter($errors)) {
        
    } else {
        $currentDate = date("Y-m-d");
        $sql = "INSERT INTO add_car (make, model, no_of_seats, transmission, price, car_number, user_id,status, image_name,date_added)
                VALUES ('$make', '$model', '$no_of_seats', '$transmission', '$price', '$car_number', '$user_id', '$status', '$newFileName',CURDATE())";

        if (mysqli_query($conn, $sql)) {
           
            header('Location: add_address.php');
            exit();
        } else {
            // Query error
            echo 'Query error: ' . mysqli_error($conn);
        }
    }
                } else {
                    echo "Sorry, there was an error renaming the file.";
                }
        } else {
            echo 'Error: Invalid file format. Only JPG, JPEG, and PNG files are allowed.';
        }
    } else {
        echo 'Error: ' . $_FILES['image']['error'];
    }
}
}

?>
<div class="container-add">
    <div class="row">
        <div class="col-lg-6 mt-5">
        <h1>ADD CAR</h1>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <div class="row">
        <div class="col">
    <label for="carMake" class="form-label">Car Make</label>
    <select class="form-select" name="make" id="carMake">
        <option value="">Select car make</option>
        
        <?php 
         echo $options; 
        ?> 
    </select>
</div>
    <!-- Select car model dropdown -->
<div class="col">
    <label for="carModel" class="form-label">Car Model</label>
    <select class="form-select" name="model" id="carModel">
    <option value="" disabled selected>Select car model</option>
     Models will be populated dynamically using JavaScript 
    </select>

</div>
</div>
    </div>
    <div class="mb-3">
        <div class="row">
        <div class="col">
    <label for="priceDropdown" class="form-label" >Number of Passengers</label>
    <select class="form-select"name="no_of_seats" id="priceDropdown" aria-label="Price">
        <option selected>Select seats</option>
        <option value="2">2 seater</option>
        <option value="4">4 seater</option>
        <option value="6">6 seater</option>
     </select>
</div>

<div class="col">
    <label for="priceDropdown" class="form-label" >Type of Transmission</label>
    <select class="form-select" name="transmission" id="priceDropdown" aria-label="Price">
        <option selected>Select type</option>
        <option value="MANUAL">Manual</option>
        <option value="AUTOMATIC">Automatic</option>
    </select>
</div>
    </div>
    </div>
    <div class="row">
            <div class="col">Price per day
            <input required type="text" class="form-control"name="price" placeholder="Price in &pound;" aria-label="price">
            </div>
            <div class="col">Car Number
            <input required type="text" class="form-control"name="car_number" placeholder="Number plate" aria-label="number">

            </div>
        </div>
        <div class="mb-3">
                    <label for="photo">Upload Photo(.jpg,.png,.jpeg)</label>
                    <input required type="file" class="form-control"  id="photo" name="image" accept="image/*">
                </div>

    <div>
      <button type="submit" name="submit" value="Upload"class="btn">NEXT</button>
    </div>
  </form>
 
        </div>
        <div class="col-lg-6 mt-5">
        <div data-aos="flip-left"
     data-aos-easing="ease-out-cubic"
     data-aos-duration="2000">

  <img class="img-fluid" src="img/addcar.jpg">
  </div>
    </div>
    </div>
</div>
    </div>
    </div>

  
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#carMake').change(function() {
        var carMake = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'get_car_models.php', 
            data: { car_make: carMake },
            success: function(response) {
                $('#carModel').html(response);
            }
        });
    });
});
</script>   

<script>
  AOS.init();
</script>
