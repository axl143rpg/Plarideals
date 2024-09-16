<?php

include('../includes/config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'cashier') {

  header("Location: ./index.php"); // Redirect to login or a page with access denied message
  exit();
}

$current_page = basename($_SERVER['PHP_SELF']);

$fetchSystemNameQuery = "SELECT system_name FROM settings WHERE id = 1";
$fetchSystemNameResult = $conn->query($fetchSystemNameQuery);

$systemName = ($fetchSystemNameResult->num_rows > 0) ? $fetchSystemNameResult->fetch_assoc()['system_name'] : 'Plarideals';


//counter parts


function getTotaltasksCount()
{
  global $conn;

  $totaltasksQuery = "SELECT COUNT(*) AS totaltasks FROM tasks";
  $totaltasksResult = $conn->query($totaltasksQuery);

  if ($totaltasksResult->num_rows > 0) {
    $totaltasksRow = $totaltasksResult->fetch_assoc();
    return $totaltasksRow['totaltasks'];
  } else {
    return 0;
  }
}

function getTotaluserssCount()
{
  global $conn;

  $totaluserssQuery = "SELECT COUNT(*) AS totaluserss FROM usership_types";
  $totaluserssResult = $conn->query($totaluserssQuery);

  if ($totaluserssResult->num_rows > 0) {
    $totaluserssRow = $totaluserssResult->fetch_assoc();
    return $totaluserssRow['totaluserss'];
  } else {
    return 0;
  }
}

function getTotalconsumersCount()
{
  global $conn;

  $totalconsumersQuery = "SELECT COUNT(*) AS totalconsumers FROM consumers";
  $totalconsumersResults = $conn->query($totalconsumersQuery);


  if ($totalconsumersResults->num_rows > 0) {
    $TotalconsumersRow = $totalconsumersResults->fetch_assoc();
    return $TotalconsumersRow['totalconsumers'];
  } else {
    return 0;
  }
}

// function getTotalRevenue()
// {
//     global $conn;

//     $totalRevenueQuery = "SELECT SUM(total_amount) AS totalRevenue FROM renew";
//     $totalRevenueResult = $conn->query($totalRevenueQuery);

//     if ($totalRevenueResult->num_rows > 0) {
//         $totalRevenueRow = $totalRevenueResult->fetch_assoc();
//         return $totalRevenueRow['totalRevenue'];
//     } else {
//         return 0;
//     }
// }

function getAllprice()
{
  global $conn;

  $allusersQuery = "SELECT * FROM users ORDER BY created_at DESC LIMIT 4";
  $allusersResult = $conn->query($allusersQuery);
}

function getNewusersCount()
{
  global $conn;
  // Visit codeastro.com for more projects
  $twentyFourHoursAgo = time() - (24 * 60 * 60);

  $newusersQuery = "SELECT COUNT(*) AS newusersCount FROM users WHERE created_at >= FROM_UNIXTIME($twentyFourHoursAgo)";
  $newusersResult = $conn->query($newusersQuery);

  if ($newusersResult) {
    $row = $newusersResult->fetch_assoc();
    return $row['newusersCount'];
  } else {
    return 0;
  }
}

// Function to display the total count of new users with HTML markup
function displayNewusersCount()
{
  $newusersCount = getNewusersCount();
  echo "<span class='info-box-number'>$newusersCount</span>";
}


function getExpiredusersCount()
{
  global $conn;

  $expiredusersQuery = "SELECT COUNT(*) AS expiredusersCount FROM users WHERE (expiry_date IS NULL OR expiry_date < NOW())";
  $expiredusersResult = $conn->query($expiredusersQuery);

  if ($expiredusersResult) {
    $row = $expiredusersResult->fetch_assoc();
    return $row['expiredusersCount'];
  } else {
    return 0;
  }
}

function displayExpiredusersCount()
{
  $expiredusersCount = getExpiredusersCount();
  echo "<span class='info-box-number'>$expiredusersCount</span>";
}

$fetchLogoQuery = "SELECT logo FROM settings WHERE id = 1";
$fetchLogoResult = $conn->query($fetchLogoQuery);

if ($fetchLogoResult->num_rows > 0) {
  $settings = $fetchLogoResult->fetch_assoc();
  $logoPath = $settings['logo'];
} else {
  $logoPath = 'dist/img/default-logo.png';
}
// Visit codeastro.com for more projects
?>
<?php include('includes/header.php');
include('includes/navbar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Consumers</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

                <h4> <?php echo getTotalconsumersCount(); ?></h4>
                

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->


  <?php
  include('includes/scripts.php');
  include('includes/footer.php');
  ?>

</div>