<?php
include('templates/driverdashboardheader.php');

include ('config/db_connect.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'Renter') {
  header('Location: login.php');
  exit();
}

$user_id = $_SESSION['id'];


$query3 = "SELECT MONTH(date_added) AS month, COUNT(*) AS car_count
FROM rating WHERE user_id = $user_id AND YEAR(date_added) = 2023
GROUP BY MONTH(date_added)";
$query4 = "SELECT MONTH(date_added) AS month, COUNT(*) AS car_count
FROM rating WHERE user_id = $user_id AND YEAR(date_added) = 2024
GROUP BY MONTH(date_added)";
$query5 ="SELECT MONTH(date_added) AS month, COUNT(*) * '10' AS total_finance
FROM rating WHERE user_id = $user_id AND YEAR(date_added) = 2023
GROUP BY MONTH(date_added)";
$query6 = "SELECT MONTH(date_added) AS month, COUNT(*) * '10' AS total_finance
FROM rating WHERE user_id = $user_id AND YEAR(date_added) = 2024
GROUP BY MONTH(date_added)";


$result3 = mysqli_query($conn, $query3);
$result4 = mysqli_query($conn, $query4);
$result5 = mysqli_query($conn, $query5);
$result6 = mysqli_query($conn, $query6);

$monthlyCounts2023 = array_fill(1, 12, 0);
$monthlyCounts2024 = array_fill(1, 12, 0);
$monthlyFinance2023 = array_fill(1, 12, 0);
$monthlyFinance2024 = array_fill(1, 12, 0);


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

$months = [];
$countData2023 = [];
$countData2024 = [];
$financemonths = [];
$financeData2023 = [];
$financeData2024 = [];

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

?>

<div class="container-dashboard py-5">
  <div class="row">
    <div class="col-lg-12"style="margin-top: 5%;">
      <a class="text-decoration-none" href="#">
        <div class="card p-3 shadow text-center border-0">
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
      <button class="btn"onclick="showYearData(2023)">2023</button>
      <button class="btn"onclick="showYearData(2024)">2024</button>
      <canvas id="monthlyCarsChart" width="400" height="200"></canvas>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
      <button class="btn"onclick="showFinanceData(2023)">2023</button>
      <button class="btn"onclick="showFinanceData(2024)">2024</button>
      <canvas id="monthlyFinanceChart" width="400" height="200"></canvas>
    </div>
    
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
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
        label: `Number of time you Rented a car in (${selectedYear})`,
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

showYearData(2023);
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
              label: `Total Money Spent in \u00A3 (${selectedYear})`,
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
