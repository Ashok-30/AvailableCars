<?php
session_start();
include('config/db_connect.php');
include('templates/header.php');

if (isset($_SESSION['logged_in'])) {
    if ($_SESSION['role'] === 'Car Owner') {
        header('Location: carownerdashboard.php');
        exit();
    } elseif ($_SESSION['role'] === 'Renter') {
        header('Location: driverdashboard.php');
        exit();
    } elseif ($_SESSION['role'] === 'Admin') {
        header('Location: admindashboard.php');
        exit();
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if the user is an admin
    if ($email === '123@admin.com' && $password === '@Dmin123') {
        $_SESSION['logged_in'] = true;
        $_SESSION['role'] = 'Admin'; // Set the role as 'Admin'
        header('Location: admindashboard.php');
        exit();
    }

    // If not an admin, proceed to regular user login
    $sql = "SELECT * FROM user_details WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the entered password with the hashed password from the database
        if (password_verify($password, $row['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['role'] = $role;
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['pincode'] = $row['pincode'];

            if ($role === 'Car Owner') {
                header('Location: carownerdashboard.php');
                exit();
            } elseif ($role === 'Renter') {
                header('Location: driverdashboard.php');
                exit();
            }
        } else {
            $error_msg = "Invalid email or password";
        }
    } else {
        $error_msg = "No user found with that email";
    }
}
?>


<body class="login-page">
<div class="row">
    <div class="col-lg-6">
<div class="container-login">

  <h1 class="login-header">Login</h1>
  <form action="login.php" method="POST">
  <div class="mb-3">
  <label for="userType" class="form-label"style="color: black;">Login as ?</label>
        <select class="form-control" name="role"style="background-color: white; color: black;" id="userType" name="userType">
            <option value="Car Owner">Car Owner</option>
            <option value="Renter">Renter</option>
        </select>
    </div>
    <div class="mb-3">
      <label for="email"  class="form-label">Email address</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="Enter email"
      value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
      
    </div>
    <div class="mb-3">
    <div class="row">
    <div class="col-md-12">
        <label for="password" class="form-label"></label>
        <div class="password-wrapper">
            <input type="password" class="form-control" name="password" id="password" 
                placeholder="Enter password" value="<?php echo htmlspecialchars($_POST['password'] ?? ''); ?>">
            <button type="button" id="togglePassword">
                <i class="fa fa-eye toggle-icon" id="toggleIcon"></i>
            </button>
        </div>
        <div style="color: red;"><?php echo htmlspecialchars($errors['password'] ?? ''); ?></div>
    </div>
</div>
    </div>
    <div class="mb-3" style="padding-left:65%;">
      <a style="color: black;"href="forgot-password.php">Forgot password?</a>
    </div>
    <div class="d-grid">
      <button type="submit" name="login" class="btn">Login</button>
    </div>
    
  </form>
<div class="mb-3" style="padding-left:40%; color: black;">
    Don't have an account? <a style="color: purple;"href="signup.php">Sign-up</a>
  </div>
</div>
</div>
<div class="col-lg-6 bg-image">
                <img src="img/login.jpg" alt="login" class="img-fluid">
            </div>
</div>

<div class="position-fixed top-50 start-50 translate-middle" style="z-index: 11" id="toastContainer">
  <div id="toast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">Error</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Invalid username or password.
    </div>
  </div>
</div>

<script>
  <?php if(isset($error_msg) && !empty($error_msg)) { ?>
    document.addEventListener('DOMContentLoaded', function () {
      var myToast = new bootstrap.Toast(document.getElementById('toast'));
      myToast.show();

      // Hide the toast after 3 seconds 
      setTimeout(function() {
        myToast.hide();
        document.getElementById('toastContainer').classList.add('hide'); 
      }, 3000); // 3000 milliseconds = 3 seconds
    });
  <?php } ?>
  $(document).ready(function() {
    $("#togglePassword").click(function() {
        var passwordField = $("#password");
        var toggleIcon = $("#toggleIcon");
        
        if (passwordField.attr("type") === "password") {
            passwordField.attr("type", "text");
            toggleIcon.removeClass("fa-eye");
            toggleIcon.addClass("fa-eye-slash");
        } else {
            passwordField.attr("type", "password");
            toggleIcon.removeClass("fa-eye-slash");
            toggleIcon.addClass("fa-eye");
        }
    });
});
</script>


</body>

 
