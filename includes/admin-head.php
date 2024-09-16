<?php require  'includes/config.php' ?>
<?php 
session_start(); // Start the session

// Check if user is logged in and if the user has an admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // If not logged in or not an admin, redirect to the login page or show an error
    header("Location: index.php"); // Redirect to login or a page with access denied message
    exit();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
  }
  
  // $pageTitle = 'Dashboard';
  
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
  
  function getTotalusersCount()
  {
    global $conn;
  
    $totalusersQuery = "SELECT COUNT(*) AS totalusers FROM users";
    $totalusersResults = $conn->query($totalusersQuery);
    
  
    if ($totalusersResults->num_rows > 0) {
      $TotalusersRow = $totalusersResults->fetch_assoc();
      return $TotalusersRow['totalusers'];
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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link
      href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css"
      rel="stylesheet"
    />
    <link href="css/styles.css" rel="stylesheet" />
    <script
      src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body class="sb-nav-fixed">
  <?php include('includes/nav.php'); ?>

    <?php include('sidebar.php');?>