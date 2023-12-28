<?php
// forgot_password.php

include('config/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $sql = "SELECT * FROM user_details WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            if (isset($_POST['password'], $_POST['confirm_password'])) {
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];

                if ($password === $confirm_password) {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    $update_sql = "UPDATE user_details SET password = '$hashed_password' WHERE email = '$email'";
                    mysqli_query($conn, $update_sql);

                    echo "<script>alert('Password updated successfully. Please login with your new password.')</script>";
                    header("Location: login.php");
                    exit();
                } else {
                    echo "<script>alert('Passwords do not match. Please try again.')</script>";
                }
            } else {
?>
                <?php
                include('templates/header.php');
                ?>


                <body class="login-page">
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="container-login">

                                <h1 class="login-header">Reset Password</h1>
                                <form action="" method="post">

                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="password" class="form-label"></label>
                                                <div class="password-wrapper">
                                                    <input required type="password" class="form-control" name="password" id="password" placeholder="Enter new password">
                                                    <button type="button" id="togglePassword">
                                                        <i class="fa fa-eye toggle-icon" id="toggleIcon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="password" class="form-label"></label>
                                                <div class="password-wrapper">
                                                    <input required type="password" class="form-control" name="confirm_password" id="password" placeholder="Confirm password">
                                                    <input type="hidden" name="email" value="<?= $email ?>">

                                                    <button type="button" id="togglePassword">
                                                        <i class="fa fa-eye toggle-icon" id="toggleIcon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <input class="btn btn-primary" style="margin-top: 10px;" type="submit" name="submit" value="Update Password">
                                        </div>
                                    </div>


                                </form>

                            </div>
                        </div>
                        <div class="col-lg-6 bg-image">

                            <img src="img/reset_password.jpg" alt="login" class="img-fluid">
                        </div>
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



<?php
                exit();
            }
        } else {
            echo "Email not found. Please try again.";
        }
    }
}
?>
<?php
include('templates/header.php');
?>


<body class="login-page">
    <div class="row">
        <div class="col-lg-6">
            <div class="container-login">

                <h1 class="login-header">Forgot Password</h1>
                <form action="" method="post">

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email address</label>
                                <input required type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                                <input class="btn" style="margin-top: 10px;" type="submit" name="submit" value="Submit">

                            </div>
                          
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-lg-6 bg-image">

                            <img src="img/forgot_password.jpg" alt="login" class="img-fluid">
                        </div>
    </div>

</body>