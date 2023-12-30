<?php
include('templates/ownerdashboardheader.php');
include('templates/ownersidebar.php');
include('config/db_connect.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'Car Owner') {
  header('Location: login.php');
  exit();
}

$user_id = $_SESSION['id'];

// Execute a query to get the number of cars for the user
$query = "SELECT COUNT(add_id) AS car_count FROM add_car WHERE user_id = $user_id";
$query2 = "SELECT COUNT(add_id) AS car_count FROM add_car WHERE user_id = $user_id AND status = '1'";
$query3 = "SELECT MONTH(r.date_added) AS month, COUNT(*) AS car_count
          FROM add_car ac
          LEFT JOIN rating r ON ac.add_id = r.add_id
          WHERE ac.user_id = $user_id AND YEAR(r.date_added) = 2023
          GROUP BY MONTH(r.date_added)";
$query4 = "SELECT MONTH(r.date_added) AS month, COUNT(*) AS car_count
          FROM add_car ac
          LEFT JOIN rating r ON ac.add_id = r.add_id
          WHERE ac.user_id = $user_id AND YEAR(r.date_added) = 2024
          GROUP BY MONTH(r.date_added)";
$query5 = "SELECT MONTH(r.date_added) AS month,COUNT(*) * '10' AS total_finance
FROM add_car ac LEFT JOIN rating r ON ac.add_id = r.add_id WHERE ac.user_id = $user_id AND YEAR(r.date_added) = 2023
GROUP BY MONTH(r.date_added)";

$query6 = "SELECT MONTH(r.date_added) AS month,COUNT(*) * '10' AS total_finance
FROM add_car ac LEFT JOIN rating r ON ac.add_id = r.add_id WHERE ac.user_id = $user_id AND YEAR(r.date_added) = 2024
GROUP BY MONTH(r.date_added)";



$result = mysqli_query($conn, $query);
$result2 = mysqli_query($conn, $query2);
$result3 = mysqli_query($conn, $query3);
$result4 = mysqli_query($conn, $query4);
$result5 = mysqli_query($conn, $query5);
$result6 = mysqli_query($conn, $query6);

$monthlyCounts2023 = array_fill(1, 12, 0);
$monthlyCounts2024 = array_fill(1, 12, 0);
$monthlyFinance2023 = array_fill(1, 12, 0);
$monthlyFinance2024 = array_fill(1, 12, 0);

$row = mysqli_fetch_assoc($result);
$row2 = mysqli_fetch_assoc($result2);

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

$car_count = $row['car_count'];
$car_count2 = $row2['car_count'];
?>

<div class="container-dashboard py-5">
  <div class="row">
    <div class="col-lg-12">
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
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 p-2">
      <canvas id="pieChart1" style="width:100%;max-width:700px"></canvas>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 p-2">

      <button class="btn" onclick="showYearData(2023)">2023</button>
      <button class="btn" onclick="showYearData(2024)">2024</button>
      <canvas id="monthlyCarsChart" width="400" height="200"></canvas>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 p-2">

      <button class="btn" onclick="showFinanceData(2023)">2023</button>
      <button class="btn" onclick="showFinanceData(2024)">2024</button>
      <canvas id="monthlyFinanceChart" width="400" height="200"></canvas>
    </div>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
  const carCount = <?php echo $car_count; ?>;
  const carCount2 = <?php echo $car_count2; ?>;
  const xValues = ["Listed", "Open to rent"];
  const yValues = [carCount, carCount2];
  const barColors = ["red", "green"];

  // Create the Chart using retrieved car count
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
        text: "Pie Chart: Total number of Cars"
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
          label: `Number of Times your car is Booked in (${selectedYear})`,
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
                label: `Total Finance Generated in \u00A3 (${selectedYear})`,
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