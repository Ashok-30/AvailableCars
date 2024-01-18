<?php include('templates/header.php');
include('config/db_connect.php');
?>

<!-- /*Index*/ -->

<section class="section index" id="home">

  <div class="container">
    <div class="row">

      <div class="col-lg-6">
        <div data-aos="flip-right" data-aos-duration="3000">
          <div class="index-content">
            <h2 class="h1 index-title">The easy way to Rent a Car</h2> 
            <p class="index-text">Booking a car has never been easier. Search for your car in desired location.</p>
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

      <!--ADVERTISEMENT -->
      <div class="col-lg-6">
        <div data-aos="flip-left" data-aos-duration="3000">
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
<!--STATISTICS -->
<?php

$query = "SELECT COUNT(id) AS user_count FROM user_details WHERE id != 56";
$query2 = "SELECT COUNT(add_id) AS car_count FROM add_car";
$query3 = "SELECT MONTH(date_added) AS month, COUNT(*) AS car_count
FROM rating WHERE  YEAR(date_added) = 2023
GROUP BY MONTH(date_added)";
$query4 = "SELECT MONTH(date_added) AS month, COUNT(*) AS car_count
FROM rating WHERE  YEAR(date_added) = 2024
GROUP BY MONTH(date_added)";
$query5 = "SELECT MONTH(date_added) AS month, COUNT(*) * '10' AS total_finance
FROM rating WHERE YEAR(date_added) = 2023
GROUP BY MONTH(date_added)";
$query6 = "SELECT MONTH(date_added) AS month, COUNT(*) * '10' AS total_finance
FROM rating WHERE YEAR(date_added) = 2024
GROUP BY MONTH(date_added)";
$query7 = "SELECT MONTH(date_added) AS month, COUNT(*) AS user_count
FROM user_details WHERE  YEAR(date_added) = 2023
GROUP BY MONTH(date_added);";
$query8 = "SELECT MONTH(date_added) AS month, COUNT(*) AS user_count
FROM user_details WHERE  YEAR(date_added) = 2024
GROUP BY MONTH(date_added);";


$result = mysqli_query($conn, $query);
$result2 = mysqli_query($conn, $query2);
$result3 = mysqli_query($conn, $query3);
$result4 = mysqli_query($conn, $query4);
$result5 = mysqli_query($conn, $query5);
$result6 = mysqli_query($conn, $query6);
$result7 = mysqli_query($conn, $query7);
$result8 = mysqli_query($conn, $query8);



$row = mysqli_fetch_assoc($result);
$row2 = mysqli_fetch_assoc($result2);

$monthlyCounts2023 = array_fill(1, 12, 0);
$monthlyCounts2024 = array_fill(1, 12, 0);
$monthlyFinance2023 = array_fill(1, 12, 0);
$monthlyFinance2024 = array_fill(1, 12, 0);
$monthlyUsers2023 = array_fill(1, 12, 0);
$monthlyUsers2024 = array_fill(1, 12, 0);



$user_count = $row['user_count'];
$car_count = $row2['car_count'];


while ($row3 = mysqli_fetch_assoc($result3)) {
  $month = $row3['month'];
  $carCount3 = $row3['car_count'];
  $monthlyCounts2023[$month] = $carCount3;
}

while ($row4 = mysqli_fetch_assoc($result4)) {
  $month = $row4['month'];
  $carCount4 = $row4['car_count'];
  $monthlyCounts2024[$month] = $carCount4;
}
while ($row5 = mysqli_fetch_assoc($result5)) {
  $month = $row5['month'];
  $finance3 = $row5['total_finance'];
  $monthlyFinance2023[$month] = $finance3;
}
while ($row6 = mysqli_fetch_assoc($result6)) {
  $month = $row6['month'];
  $finance4 = $row6['total_finance'];
  $monthlyFinance2024[$month] = $finance4;
}
while ($row7 = mysqli_fetch_assoc($result7)) {
  $month = $row7['month'];
  $userCount3 = $row7['user_count'];
  $monthlyUsers2023[$month] = $userCount3;
}
while ($row8 = mysqli_fetch_assoc($result8)) {
  $month = $row8['month'];
  $userCount4 = $row8['user_count'];
  $monthlyUsers2024[$month] = $userCount4;
}

$months = [];
$countData2023 = [];
$countData2024 = [];
$financemonths = [];
$financeData2023 = [];
$financeData2024 = [];
$usermonths = [];
$userData2023 = [];
$userData2024 = [];

for ($i = 1; $i <= 12; $i++) {
  $months[] = date("F", mktime(0, 0, 0, $i, 1));
  $countData2023[] = $monthlyCounts2023[$i];
  $countData2024[] = $monthlyCounts2024[$i];
}
for ($i = 1; $i <= 12; $i++) {
  $financemonths[] = date("F", mktime(0, 0, 0, $i, 1));
  $financeData2023[] = $monthlyFinance2023[$i];
  $financeData2024[] = $monthlyFinance2024[$i];
}
for ($i = 1; $i <= 12; $i++) {
  $usermonths[] = date("F", mktime(0, 0, 0, $i, 1));
  $userData2023[] = $monthlyUsers2023[$i];
  $userData2024[] = $monthlyUsers2024[$i];
}
?>

<div class="container-dashboard py-5" style="padding: 8%;margin-top: 5%;">
  <div class="row">
    <div class="col-lg-12">
      <a class="text-decoration-none" href="#">
        <div class="card p-3 shadow text-center border-0" style="margin-right:10%">
          <div class="card-body">
            <h1> <i class="fa fa-dashboard" aria-hidden="true"></i>STATISTICS</h1>
            <hr />
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<div class="container-dashboard py-5">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
      <canvas id="pieChart1" style="width:100%;max-width:700px"></canvas>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
      <button class="btn" onclick="showUserData(2023)">2023</button>
      <button class="btn" onclick="showUserData(2024)">2024</button>
      <canvas id="monthlyUsersChart" width="400" height="200"></canvas>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
      <button class="btn" onclick="showYearData(2023)">2023</button>
      <button class="btn" onclick="showYearData(2024)">2024</button>
      <canvas id="monthlyCarsChart" width="400" height="200"></canvas>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
      <button class="btn" onclick="showFinanceData(2023)">2023</button>
      <button class="btn" onclick="showFinanceData(2024)">2024</button>
      <canvas id="monthlyFinanceChart" width="400" height="200"></canvas>
    </div>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
  const userCount = <?php echo $user_count; ?>;
  const carCount = <?php echo $car_count; ?>;
  const xValues = ["Users", "Cars"];
  const yValues = [userCount, carCount];
  const barColors = ["blue", "yellow"];


  new Chart("pieChart1", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      legend: {
        display: false
      },
      title: {
        display: true,
        text: "Pie Chart: Total number of Users and Cars"
      }
    }
  });
  const months = <?php echo json_encode($months); ?>;
  const countData2023 = <?php echo json_encode($countData2023); ?>;
  const countData2024 = <?php echo json_encode($countData2024); ?>;

  function showYearData(selectedYear) {
    var ctx = document.getElementById('monthlyCarsChart').getContext('2d');
    var dataToDisplay = selectedYear === 2023 ? countData2023 : countData2024;

    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: months,
        datasets: [{
          label: `Number of Cars Booked/Rented in (${selectedYear})`,
          data: dataToDisplay,
          backgroundColor: 'rgba(154, 112, 238, 0.6)',
          borderColor: 'rgba(154, 112, 238, 2)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  }

  showYearData(2023);
  const usermonths = <?php echo json_encode($usermonths); ?>;
  const userData2023 = <?php echo json_encode($userData2023); ?>;
  const userData2024 = <?php echo json_encode($userData2024); ?>;

  function showUserData(selectedYear) {
    var ctx = document.getElementById('monthlyUsersChart').getContext('2d');
    var dataToDisplay = selectedYear === 2023 ? userData2023 : userData2024;

    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: months,
        datasets: [{
          label: `Number of Users joined in (${selectedYear})`,
          data: dataToDisplay,
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  }

  showUserData(2023);
  const financemonths = <?php echo json_encode($financemonths); ?>;
  const financeData2023 = <?php echo json_encode($financeData2023); ?>;
  const financeData2024 = <?php echo json_encode($financeData2024); ?>;

  function showFinanceData(selectedYear) {
    var ctx = document.getElementById('monthlyFinanceChart').getContext('2d');
    var dataToDisplay = selectedYear === 2023 ? financeData2023 : financeData2024;

    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: financemonths,
        datasets: [{
          label: `Revenue in \u00A3 (${selectedYear})`,
          data: dataToDisplay,
          fill: false,
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  }

  showFinanceData(2023);
</script>


<!--    - #LISTED CAR   -->
<?php


$user_id = $_SESSION['id'];
date_default_timezone_set('Europe/London');
$currentDateTime = date("Y-m-d H:i:s");
$sql = "SELECT ac.*, ad.*, adt.startdatetime, adt.enddatetime
FROM add_car ac
JOIN address ad ON ac.add_id = ad.add_id
JOIN available_dates adt ON ac.add_id = adt.add_id
WHERE ac.status = 1
AND adt.enddatetime > '$currentDateTime'
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
                      <li class="card-list-item">
                 
                      <span class="card-item-text">Available from</span></span>
                    </li>
                    <li class="card-list-item">
                     
                      <span class="card-item-text">' . $row['startdatetime'] . '</span>
                    </li>
                    <li class="card-list-item">
                
                    <span class="card-item-text">Available till</span></span>
                  </li>
                  <li class="card-list-item">
                   
                    <span class="card-item-text">' . $row['enddatetime'] . '</span>
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
    <div data-aos="flip-right" data-aos-offset="300" data-aos-easing="ease-in-sine">

      <div data-aos="zoom-in" data-aos-duration="3000">

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