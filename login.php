<?php
session_start();
include('config/db_connect.php');
include('templates/header.php');
if (isset($_SESSION['logged_in'])) {
    // If already logged in, redirect to the respective dashboard
    if ($_SESSION['role'] === 'Car Owner') {
        header('Location: carownerdashboard.php');
        exit();
    } elseif ($_SESSION['role'] === 'Renter') {
        header('Location: driverdashboard.php');
        exit();
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM user_details WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $email, $password);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['logged_in'] = true;
        $_SESSION['role'] = $role;
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['pincode'] = $row['pincode'];
        $_SESSION['password'] = $row['password'];

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
}
?>


<body class="login-page">

<div class="container-login">
  <h1 class="login-header">Login</h1>
  <form action="login.php" method="POST">
  <div class="mb-3">
  <label for="userType" class="form-label"style="color: white;">Login as ?</label>
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
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Enter password"
      value="<?php echo htmlspecialchars($_POST['password'] ?? ''); ?>">
    </div>
    <div class="mb-3" style="padding-left:65%;">
      <a style="color: white;"href="forgot-password.php">Forgot password?</a>
    </div>
    <div class="d-grid">
      <button type="submit" name="login" class="btn">Login</button>
    </div>
    <div class="text-white"><?php echo htmlspecialchars($error_msg ?? ''); ?></div>
  </form>
<div class="mb-3" style="padding-left:40%; color: white;">
    Don't have an account? <a style="color: white;"href="signup.php">Sign-up</a>
  </div>
</div>
</body>

 
