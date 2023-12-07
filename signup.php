
<?php
include 'templates/header.php';
include 'config/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Initialize variables
$role = $first_name = $last_name = $address = $pincode = $email = $phone = $password = '';
$errors = array('first_name' => '', 'last_name' => '', 'address' => '', 'pincode' => '', 'email' => '', 'phone' => '', 'password' => '');

if (isset($_POST['submit'])) {

    //Validate email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required';
    } else {
        $email = $_POST['email'];
        $email_pattern = '/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/';
        if (!preg_match($email_pattern, $email)) {
            $errors['email'] = 'Please enter a valid email address in the format example@email.com';
        }
    }
    //Validate phone
    if (empty($_POST['phone'])) {
        $errors['phone'] = 'Phone number is required';
    } else {
        $phone = $_POST['phone'];
        $phone_pattern = '/^\+44\s?\d{10}$/';
        if (!preg_match($phone_pattern, $phone)) {
            $errors['phone'] = 'Please enter a valid UK phone number like +44 123 456 7890';
        }
    }
    // Validate password
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required';
    } else {
        $password = $_POST['password'];
        $password_pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>])(?=.*[^\da-zA-Z]).{8,}$/';
        if (!preg_match($password_pattern, $password)) {
            $errors['password'] = 'Password must contain at least 8 characters, one uppercase letter, one lowercase letter, one number, and one special character';
        }
    }
    //Validate pincode
    if (empty($_POST['pincode'])) {
        $errors['pincode'] = 'Pincode is required';
    } else {
        $pincode = $_POST['pincode'];
        $pincode_pattern = '/^[A-Z]{1,2}[0-9][0-9A-Z]?\s?[0-9][A-Z]{2}$/i';

        if (!preg_match($pincode_pattern, $pincode)) {
            $errors['pincode'] = 'Please enter a valid UK postcode (e.g., AB12 3CD)';
        }
    }
    if (empty($_POST['confirm_password'])) {
        $errors['confirm_password'] = 'Please confirm your password';
    } else {
        $confirm_password = $_POST['confirm_password'];
        if ($password !== $confirm_password) {
            $errors['confirm_password'] = 'Passwords do not match';
        }
    }
 if (!array_filter($errors)) {
        // Escape user inputs and create SQL
        
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        $role1 = 'Car Owner';
        $role2 = 'Renter';
        // Create the SQL query
        $sql = "INSERT INTO user_details (first_name, last_name, address, pincode, email, phone, password,role1, role2) 
            VALUES ('$first_name', '$last_name', '$address', '$pincode', '$email', '$phone', '$password', '$role1', '$role2')";

        // Attempt to execute the SQL query
        if (mysqli_query($conn, $sql)) {
            // Success - Redirect to another page
            header('Location: login.php');
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
    <div class="container-login">
        <h1 class="login-header">Sign-up</h1>
        <form action="" method="POST">
          

            <div class="mb-3">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" name="first_name" placeholder="First name"
                value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>" aria-label="First name">
            </div>
            <div class="col">
                <input type="text" class="form-control" name="last_name" placeholder="Last name" 
                value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>"aria-label="Last name">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="address" placeholder="Address"
        value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>" aria-label="Address">
    </div>
    <div class="mb-3">     
        <input type="text" class="form-control" name="pincode" placeholder="Pincode"
        value="<?php echo htmlspecialchars($_POST['pincode'] ?? ''); ?>" aria-label="Pincode"> 
        <div style="color: red;"><?php echo  htmlspecialchars($errors['pincode'] ?? ''); ?></div> 
    </div>
    <div class="mb-3">
        <div class="row">
        <div class="col">
            <input type="email" class="form-control" name="email" placeholder="Email"
            value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" aria-label="Email">
            <div style="color: red;"><?php echo htmlspecialchars($errors['email'] ?? ''); ?></div>

        </div>
            <div class="col">
               <input type="tel" class="form-control" name="phone" placeholder="Phone Number"
               value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" aria-label="Phone">
               <div style="color: red;"><?php echo htmlspecialchars($errors['phone'] ?? ''); ?></div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col password-toggle">
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
<div class="col password-toggle">
            <div class="row">
    <div class="col-md-12">
        <label for="password" class="form-label"></label>
        <div class="password-wrapper">
            <input type="password" class="form-control" name="confirm_password" id="password" 
                placeholder="Re-Enter password" value="<?php echo htmlspecialchars($_POST['confirm_password'] ?? ''); ?>">
            <button type="button" id="togglePassword">
                <i class="fa fa-eye toggle-icon" id="toggleIcon"></i>
            </button>
        </div>
        <div style="color: red;"><?php echo htmlspecialchars($errors['confirm_password'] ?? ''); ?></div>
    </div>
</div>
</div>
        </div>
    </div>
   

            <div class="d-grid">
                <button type="submit" name="submit" class="btn">Sign-up</button>
            </div>
        </form>
        <div class="mb-3" style="padding-left:40%;color: black;">
            Already have an account? <a style="color: purple;" href="login.php">Login</a>
        </div>
        </div>
        
    </div>
    <div class="col-lg-6 bg-image">
                <img src="img/sign-up.png" alt="login" class="img-fluid">
            </div>
        </div>
    </div>
    <script>
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
   