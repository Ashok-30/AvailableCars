<?php
include 'templates/header.php';
include 'config/db_connect.php';

// Fetch user data from the database for the dropdown list
$sql = "SELECT id, first_name FROM user_details";
$result = $conn->query($sql);
$userFirstName = '';
$userLastName = '';
$userEmail = '';
$userAddress = '';
$userPincode = '';
$userPhone = '';

// Generate dropdown options
$options = '<option value="" disabled selected>Select user</option>';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['id'] . '">' . $row['first_name'] . '</option>';
    }
}
// Check if a specific user is selected for search
if (isset($_GET['user'])) {
    $search = $_GET['user'];

    // Perform a SELECT query based on search criteria
    if ($search !== '') {
        $sql2 = "SELECT * FROM user_details WHERE id = '$search'";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            // Display the results in a table
            echo '<table border="1">';
            while ($row = $result2->fetch_assoc()) {
                $userFirstName = $row['first_name'];
                $userLastName = $row['last_name'];
                $userEmail = $row['email'];
                $userAddress = $row['address'];
                $userPincode = $row['pincode'];
                $userPhone = $row['phone'];
            }
            echo '</table>';
        } else {
            echo "No results found";
        }
    }
}



// Initialize variables
$role = $first_name = $last_name = $address = $pincode = $email = $phone = $password = '';
$errors = array('first_name' => '', 'last_name' => '', 'address' => '', 'pincode' => '', 'email' => '', 'phone' => '', 'password' => '');

if (isset($_POST['update'])) {

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
        $pincodeord = $_POST['pincode'];
        $pincode_pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>])(?=.*[^\da-zA-Z]).{8,}$/';
        if (!preg_match($pincode_pattern, $password)) {
            $errors['pincode'] = 'Please enter a valid UK postcode (e.g., AB12 3CD)';
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
        // UPDATE the SQL query
        $sql2 = "UPDATE INTO user_details (first_name, last_name, address, pincode, email, phone, password,role1, role2) 
            VALUES ('$first_name', '$last_name', '$address', '$pincode', '$email', '$phone', '$password', '$role1', '$role2')";

        // Attempt to execute the SQL query
        if (mysqli_query($conn, $sql2)) {
            // Success - Redirect to another page
            header('Location: index.php');
        } else {
            // Query error
            echo 'query error: ' . mysqli_error($conn);
        }
    }
    $conn->close();
}
?>

<!-- /*Index*/ -->
<section class="section index" id="home">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <form action="" class="index-form">
                    <div class="input-wrapper">
                        <label for="input-1" class="input-label">Search for user</label>
                        <div>
                            <select name="user" id="selected-user" class="input-field">
                                <?php echo $options; ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn index-btn">Search</button>
                </form>
            </div>
        
            <div>
            <div class="row">
            <div class="col">
    <input type="text" class="form-control" name="first_name" value="<?php echo htmlspecialchars($userFirstName); ?>" placeholder="First name" aria-label="First name">
</div>
            <div class="col">
                <input type="text" class="form-control" name="last_name"value="<?php echo htmlspecialchars($userLastName); ?>" placeholder="Last name" aria-label="Last name">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($userAddress); ?>" placeholder="Address" aria-label="Address">
    </div>
    <div class="mb-3">     
        <input type="text" class="form-control" name="pincode"value="<?php echo htmlspecialchars($userPincode); ?>" placeholder="Pincode" aria-label="Pincode"> 
          
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col">
                <input type="email" class="form-control" name="email"value="<?php echo htmlspecialchars($userEmail); ?>" placeholder="Email" aria-label="Email">
                <div class="text-danger"><?php echo htmlspecialchars($errors['email'] ?? ''); ?></div>
            </div>
            <div class="col">
               <input type="tel" class="form-control" name="phone"value="<?php echo htmlspecialchars($userPhone); ?>" placeholder="Phone Number" aria-label="Phone">
            </div>
        </div>
    </div>
    </div>
    <button type="submit" name="update" class="btn index-btn">Update</button>

        </div>
    </div>
</section>
