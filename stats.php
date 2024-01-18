<?php
include 'templates/adminheader.php';
include('config/db_connect.php');

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

$query9 = "SELECT COUNT(DISTINCT car_make) AS make_count FROM car";

$query10 = "SELECT COUNT(DISTINCT car_model) AS model_count FROM car";

$result = mysqli_query($conn, $query);
$result2 = mysqli_query($conn, $query2);
$result3 = mysqli_query($conn, $query3);
$result4 = mysqli_query($conn, $query4);
$result5 = mysqli_query($conn, $query5);
$result6 = mysqli_query($conn, $query6);
$result7 = mysqli_query($conn, $query7);
$result8 = mysqli_query($conn, $query8);
$result9 = mysqli_query($conn, $query9);
$result10 = mysqli_query($conn, $query10);


$row = mysqli_fetch_assoc($result);
$row2 = mysqli_fetch_assoc($result2);
$row9 = mysqli_fetch_assoc($result9);
$row10 = mysqli_fetch_assoc($result10);
$monthlyCounts2023 = array_fill(1, 12, 0);
$monthlyCounts2024 = array_fill(1, 12, 0);
$monthlyFinance2023 = array_fill(1, 12, 0);
$monthlyFinance2024 = array_fill(1, 12, 0);
$monthlyUsers2023 = array_fill(1, 12, 0);
$monthlyUsers2024 = array_fill(1, 12, 0);



$user_count = $row['user_count'];
$car_count = $row2['car_count'];
$make_count = $row9['make_count'];
$model_count = $row10['model_count'];

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
      <canvas id="pieChart2" style="width:100%;max-width:700px"></canvas>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
      <button class="btn" onclick="showFinanceData(2023)">2023</button>
      <button class="btn" onclick="showFinanceData(2024)">2024</button>
      <canvas id="monthlyFinanceChart" width="400" height="200"></canvas>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
      <button class="btn" onclick="showYearData(2023)">2023</button>
      <button class="btn" onclick="showYearData(2024)">2024</button>
      <canvas id="monthlyCarsChart" width="400" height="200"></canvas>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
      <button class="btn" onclick="showUserData(2023)">2023</button>
      <button class="btn" onclick="showUserData(2024)">2024</button>
      <canvas id="monthlyUsersChart" width="400" height="200"></canvas>
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
  const makeCount = <?php echo $make_count; ?>;
  const modelCount = <?php echo $model_count; ?>;
  const x = ["Make", "Model"];
  const y = [makeCount, modelCount];
  const colors = ["red", "green"];


  new Chart("pieChart2", {
    type: "pie",
    data: {
      labels: x,
      datasets: [{
        backgroundColor: colors,
        data: y
      }]
    },
    options: {
      legend: {
        display: false
      },
      title: {
        display: true,
        text: "Pie Chart: Total number of Makes and Models of Cars"
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