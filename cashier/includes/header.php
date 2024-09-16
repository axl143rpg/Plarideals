<?php
$fetchSystemNameQuery = "SELECT system_name FROM settings WHERE id = 1";
$fetchSystemNameResult = $conn->query($fetchSystemNameQuery);

$systemName = ($fetchSystemNameResult->num_rows > 0) ? $fetchSystemNameResult->fetch_assoc()['system_name'] : 'Plarideals';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $systemName; ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> Funda of Web IT | Admin Panel</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">