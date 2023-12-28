<?php include('templates/header.php');
include('config/db_connect.php');
?>
<!-- /*Index*/ -->

<section class="section index" id="home">

  <div class="container">
    <div class="row">
    
      <div class="col-lg-6">
      <div data-aos="flip-right"data-aos-duration="3000">
        <div class="index-content">
          <h2 class="h1 index-title">The easy way to Rent a Car</h2> 
          <p class="index-text">Booking a car has never been easier. Search for your desired car in desired location.</p>
        </div>
        <form action="availablecars.php" class="index-form" method="POST" onsubmit="return validateForm()">
    
          <div class="input-wrapper">
            <label for="input-1" class="input-label">POSTCODE</label>

            <input required type="text" name="postcode" placeholder="" id="input-1" class="input-field" value="<?php echo htmlspecialchars($_POST['postcode'] ?? ''); ?>" aria-label="Postcode">
            <div class="">
              <?php echo '<span style="color: red;">' . htmlspecialchars($errors['postcode'] ?? '') . '</span>'; ?>
            </div>

          </div>
          <div class="input-wrapper">
            <label for="input-2" class="input-label">Check-in time</label>
            <input required type="datetime-local" name="startdatetime" id="input-2" class="input-field" placeholder="">
          </div>
          <div class="input-wrapper">
            <label for="input-3" class="input-label">Checkout time </label>
            <input required type="datetime-local" name="enddatetime" id="input-3" class="input-field" placeholder="">
          </div>
          <button type="submit" name="submit" class="btn index-btn">Search</button>
        </form>

      </div>
      </div>
      <div class="col-lg-6">
      <div data-aos="flip-left"data-aos-duration="3000">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
              <img src="img/advertisement1.jpg" class="d-block w-100" style="height: 33rem;" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="img/advertisement2.jpeg" class="d-block w-100" style="height: 33rem;" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="img/advertisement3.png" class="d-block w-100" style="height: 33rem;" alt="...">
            </div>

          </div>
        </div>
      </div>
</div>
    </div>
  </div>
   
</section>

<!--    - #LISTED CAR   -->
<?php


$user_id = $_SESSION['id'];
$sql = "SELECT ac.*, ad.*
FROM add_car ac
JOIN address ad ON ac.add_id = ad.add_id
WHERE ac.status = 1
AND ac.add_id NOT IN (
    SELECT DISTINCT add_id
    FROM booking
    WHERE add_id = ac.add_id
)ORDER BY id LIMIT 10";
$result = mysqli_query($conn, $sql);

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

    if (!empty($imageFileName) && file_exists("uploads/$imageFileName")) {
      echo "<img class='img-fluid' src='uploads/$imageFileName' alt='Car Image' 
          style='width: 100%; height: 100%; object-fit: cover;'>";
    } else {
      echo "<img src='placeholder-image.jpg' alt='Placeholder Image'>";

    }

    echo '</figure>
    <div data-aos="flip-down"data-aos-duration="3000">
                  <div class="card-content">
                    <div class="card-title-wrapper">
                      <h3 class="h3 card-title">
                        <a href="#">' . $row['make'] . ' ' . $row['model'] . '</a>
                      </h3>
                      <data class="year" value="' . $row['no_of_seats'] . '">' . $row['no_of_seats'] . ' seater</data>
                    </div>
                    <ul class="card-list">
                      <li class="card-list-item">
                        
                        <span class="card-item-text">TRANSMISSION</span>
                      </li>
                      <li class="card-list-item">
                        
                        <span class="card-item-text">' . $row['transmission'] . '</span>
                      </li>
                      <li class="card-list-item">
                       
                      <span class="card-item-text">ADDRESS</span>
                    </li>
                    <li class="card-list-item">
                      
                      <span class="card-item-text">' . $row['address'] . '</span>
                    </li>
                     
                      <li class="card-list-item">
                       
                        <span class="card-item-text">CAR NUMBER</span>
                      </li>
                      <li class="card-list-item">
                        
                        <span class="card-item-text">' . $row['car_number'] . '</span>
                      </li>
                    </ul>
                    <div class="card-price-wrapper">
                      <p class="card-price">
                        <strong>&pound;' . $row['price'] . '</strong> / day
                      </p>
                      <button class="btn rent-btn login-btn" data-add-id="' . $row['add_id'] . '">Book</button>
                      
                      

                      </div>
                  </div>
                </div>
                </div>
              </li>';
  }

  echo '</ul></div></section>';
} else {

  echo '<form>
          <!-- Other form elements here -->
          <input type="text" class="add_car_indicator" value="No cars Rented. Please come back later" disabled>
          <!-- Other form elements here -->
        </form>';
}
?>


<!-- 
        - #GET START
      -->

<section class="section get-start">
  <div class="container">
  <div data-aos="flip-right"
     data-aos-offset="300"
     data-aos-easing="ease-in-sine">

  <div data-aos="zoom-in"data-aos-duration="3000">

    <h2 class="h2 section-title">Get Set and Rent</h2>

    <ul class="get-start-list">

      <li>
        <div class="get-start-card">

          <div class="card-icon icon-1">
            <ion-icon name="person-add-outline"></ion-icon>
          </div>

          <h3 class="card-title">Create a profile</h3>

          <p class="card-text">
            Welcome to our platform's user profile creation feature! Your profile is your gateway to
            personalized experiences and enhanced interactions within our community.
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
            Experience comfort and convenience on the road! Choose from our diverse selection of quality cars
            for a smooth and enjoyable ride tailored to your preferences.
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
            Connect with car owners directly and find the perfect match for your rental needs. Enjoy a seamless
            process, hassle-free transactions, and personalized experiences.
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
            Negotiate and finalize your rental terms easily. Seal the deal swiftly with our platform, ensuring
            fair agreements and smooth transactions for both parties involved.
          </p>

        </div>
      </li>

    </ul>
    </div>
  </div>
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
              <img src="img/ad-1.jpg" alt="Opening of new offices of the company" loading="lazy" class="w-100">
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

                <time datetime="2022-01-14">August 10, 2007</time>
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
              <img src="img/ad-2.jpg" alt="What cars are most vulnerable" loading="lazy" class="w-100">
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

                <time datetime="2022-01-14">October 21, 2015</time>
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
              <img src="img/ad-3.jpg" alt="Statistics showed which average age" loading="lazy" class="w-100">
            </a>

            <a href="#" class="btn card-badge">Stats</a>

          </figure>

          <div class="card-content">

            <h3 class="h3 card-title">
              <a href="#">Statistics showed which average age</a>
            </h3>

            <div class="card-meta">

              <div class="publish-date">
                <ion-icon name="time-outline"></ion-icon>

                <time datetime="2022-01-14">March 1, 2009</time>
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
              <img src="img/ad-4.jpg" alt="What´s required when renting a car?" loading="lazy" class="w-100">
            </a>

            <a href="#" class="btn card-badge">Rent</a>

          </figure>

          <div class="card-content">

            <h3 class="h3 card-title">
              <a href="#">What´s required when renting a car?</a>
            </h3>

            <div class="card-meta">

              <div class="publish-date">
                <ion-icon name="time-outline"></ion-icon>

                <time datetime="2022-01-14">July 29, 2022</time>
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
              <img src="img/ad-5.jpg" alt="New rules for handling our cars" loading="lazy" class="w-100">
            </a>

            <a href="#" class="btn card-badge">Rules</a>

          </figure>

          <div class="card-content">

            <h3 class="h3 card-title">
              <a href="#">New rules for handling our cars</a>
            </h3>

            <div class="card-meta">

              <div class="publish-date">
                <ion-icon name="time-outline"></ion-icon>

                <time datetime="2022-01-14">January 9, 2021</time>
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
  function validateForm() {
        var startDateTime = new Date(document.forms[0]["startdatetime"].value);
        var endDateTime = new Date(document.forms[0]["enddatetime"].value);
        var currentDateTime = new Date();

        if (startDateTime < currentDateTime) {
            alert("Check-in time cannot be in the past");
            return false;
        }

        if (endDateTime < startDateTime) {
            alert("Checkout time cannot be earlier than Check-in time");
            return false;
        }

        return true; 
    }
</script>
<script>
  AOS.init();
</script>