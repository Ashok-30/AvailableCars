
<?php
include 'templates/adminheader.php';
include 'config/db_connect.php';



// Initialize variables
$car_make = $car_model = '';
$errors = array('car_make' => '', 'car_model' => '');

if (isset($_POST['submit'])) {

    //Validate email
    if (empty($_POST['car_make'])) {
        $errors['car_make'] = 'car_make is required';
    }
    //Validate phone
    if (empty($_POST['car_model'])) {
        $errors['car_model'] = 'car_model is required';
    } 
    
 if (!array_filter($errors)) {
        // Escape user inputs and create SQL
        
        $car_make = mysqli_real_escape_string($conn, $_POST['car_make']);
        $car_model = mysqli_real_escape_string($conn, $_POST['car_model']);
       
        // Create the SQL query
        $sql = "INSERT INTO car (car_make, car_model) 
        VALUES ('$car_make', '$car_model')";

    

        // Attempt to execute the SQL query
        if (mysqli_query($conn, $sql)) {
            // Success - Redirect to another page
            header('Location: admindashboard.php');
            exit();
        } else {
            // Query error
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}
?>


<body class="login-page">
    <div class="row">
    <div class="col-lg-6">
    <div data-aos="fade-right"data-aos-easing="linear"
     data-aos-duration="1000">
    <div class="container-login">
        <h1 class="login-header">ADD NEW MODEL CAR</h1>
        <form action="" method="POST">
          

            <div class="mb-3">
        <div class="row">
            <div class="col">
                <input required type="text" class="form-control" name="car_make" placeholder="Car Make"
                value="<?php echo htmlspecialchars($_POST['car_make'] ?? ''); ?>" aria-label="Car Make">
            </div>
            <div class="col">
                <input required type="text" class="form-control" name="car_model" placeholder="Car Model" 
                value="<?php echo htmlspecialchars($_POST['car_model'] ?? ''); ?>"aria-label="Car Model">
            </div>
        </div>
    </div>
            <div class="d-grid">
                <button type="submit" name="submit" class="btn">ADD</button>
            </div>
        </form>
      
        </div>
        </div>
    </div>
    <div class="col-lg-6 bg-image">
    <div data-aos="zoom-in-down"data-aos-easing="linear"
     data-aos-duration="1500">
                <img src="img/sign-up.png" alt="login" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
  AOS.init();
</script>
   