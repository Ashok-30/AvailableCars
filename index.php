<?php include('templates/header.php');
include('config/db_connect.php');
 ?>
<!-- /*Index*/ -->

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

<!--    - #LISTED CAR   -->
<?php



// Fetch data from the database
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM add_car where status='1'";
$result = mysqli_query($conn, $sql);

// Check if there are rows in the result set
if (mysqli_num_rows($result) > 0) {
    echo '<section class="section listed-car rentals"style="margin-right: 2%;margin-left: 2%;" id="listed-car">
            <div class="container">
              <div class="title-wrapper">
                <h2 class="h2 section-title">ALL CARS CURRENTLY IN RENT</h2>
              </div>
              <ul class="listed-car-list">';
    
    while ($row = mysqli_fetch_assoc($result)) {
        $imageFileName = $row['image_name'];
        echo '<li>
                <div class="listed-car-card">
                  <figure class="card-banner">';
        
        // Display the image from the 'uploads' folder using the retrieved image name
        if (!empty($imageFileName) && file_exists("uploads/$imageFileName")) {
            echo "<img src='uploads/$imageFileName' alt='Car Image'>";
        } else {
            echo "<img src='placeholder-image.jpg' alt='Placeholder Image'>";
            // If the image does not exist or the 'image_name' column is empty, display a placeholder image
        }

        echo '</figure>
                  <div class="card-content">
                    <div class="card-title-wrapper">
                      <h3 class="h3 card-title">
                        <a href="#">'.$row['make'].' '.$row['model'].'</a>
                      </h3>
                      <data class="year" value="'.$row['no_of_seats'].'">'.$row['no_of_seats'].' seater</data>
                    </div>
                    <ul class="card-list">
                      <li class="card-list-item">
                        
                        <span class="card-item-text">TRANSMISSION</span>
                      </li>
                      <li class="card-list-item">
                        
                        <span class="card-item-text">'.$row['transmission'].'</span>
                      </li>
                     
                      <li class="card-list-item">
                       
                        <span class="card-item-text">CAR NUMBER</span>
                      </li>
                      <li class="card-list-item">
                        
                        <span class="card-item-text">'.$row['car_number'].'</span>
                      </li>
                    </ul>
                    <div class="card-price-wrapper">
                      <p class="card-price">
                        <strong>&pound;'.$row['price'].'</strong> / day
                      </p>
                      <button class="btn rent-btn login-btn" data-add-id="'.$row['add_id'].'">Book</button>
                      
                      

                      </div>
                  </div>
                </div>
              </li>';
    }
    
    echo '</ul></div></section>';
} else {
  // Displaying form with "No cars found in the database" message
  echo '<form>
          <!-- Other form elements here -->
          <input type="text" class="add_car_indicator" value="No cars Rented. Please rent from listings" disabled>
          <!-- Other form elements here -->
        </form>';
}
?>


      <!-- 
        - #GET START
      -->

      <section class="section get-start">
        <div class="container">

          <h2 class="h2 section-title">Get Set and Rent</h2>

          <ul class="get-start-list">

            <li>
              <div class="get-start-card">

                <div class="card-icon icon-1">
                  <ion-icon name="person-add-outline"></ion-icon>
                </div>

                <h3 class="card-title">Create a profile</h3>

                <p class="card-text">
                  If you are going to use a passage of Lorem Ipsum, you need to be sure.
                </p>

                <a href="#" class="card-link">Get started</a>

              </div>
            </li>

            <li>
              <div class="get-start-card">

                <div class="card-icon icon-2">
                  <ion-icon name="car-outline"></ion-icon>
                </div>

                <h3 class="card-title">Tell us what car you want to rent</h3>

                <p class="card-text">
                  Various versions have evolved over the years, sometimes by accident, sometimes on purpose
                </p>

              </div>
            </li>

            <li>
              <div class="get-start-card">

                <div class="card-icon icon-3">
                  <ion-icon name="person-outline"></ion-icon>
                </div>

                <h3 class="card-title">Match with Owner</h3>

                <p class="card-text">
                  It to make a type specimen book. It has survived not only five centuries, but also the leap into
                  electronic
                </p>

              </div>
            </li>

            <li>
              <div class="get-start-card">

                <div class="card-icon icon-4">
                  <ion-icon name="card-outline"></ion-icon>
                </div>

                <h3 class="card-title">Make a deal</h3>

                <p class="card-text">
                  There are many variations of passages of Lorem available, but the majority have suffered alteration
                </p>

              </div>
            </li>

          </ul>

        </div>
      </section>






      <!-- 
        - #BLOG
      -->

      <section class="section blog" id="blog">
        <div class="container">

          <h2 class="h2 section-title">Our Blog</h2>

          <ul class="blog-list has-scrollbar">

            <li>
              <div class="blog-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="./assets/images/blog-1.jpg" alt="Opening of new offices of the company" loading="lazy"
                      class="w-100">
                  </a>

                  <a href="#" class="btn card-badge">Company</a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">Opening of new offices of the company</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="./assets/images/blog-2.jpg" alt="What cars are most vulnerable" loading="lazy"
                      class="w-100">
                  </a>

                  <a href="#" class="btn card-badge">Repair</a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">What cars are most vulnerable</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="./assets/images/blog-3.jpg" alt="Statistics showed which average age" loading="lazy"
                      class="w-100">
                  </a>

                  <a href="#" class="btn card-badge">Cars</a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">Statistics showed which average age</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="./assets/images/blog-4.jpg" alt="What´s required when renting a car?" loading="lazy"
                      class="w-100">
                  </a>

                  <a href="#" class="btn card-badge">Cars</a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">What´s required when renting a car?</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="./assets/images/blog-5.jpg" alt="New rules for handling our cars" loading="lazy"
                      class="w-100">
                  </a>

                  <a href="#" class="btn card-badge">Company</a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">New rules for handling our cars</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

          </ul>

        </div>
      </section>
      <?php include('templates/footer.php');
 ?>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
   // redirects to login page
    $('.login-btn').on('click', function() {
        window.location.href = 'login.php';
    });
});

</script>