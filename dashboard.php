<?php
include('includes/config.php');

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
// Visit codeastro.com for more projects
?>

<?php include('includes/header.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include('includes/nav.php'); ?>

    <?php include('includes/sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <?php include('includes/pagetitle.php'); ?>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Total users</span>
                  <span class="info-box-number">
                    <?php echo getTotalusersCount(); ?>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-list"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Total Tasks</span>
                  <span class="info-box-number"><?php echo getTotaltasksCount(); ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-hourglass-half"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Total users</span>
                  <span class="info-box-number"><?php echo getTotalusersCount(); ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-coins"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">PRICING</span>
                  <span class="info-box-number"><?php echo getAllprice();
                ?></span>
              
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- Visit codeastro.com for more projects -->
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">New users</span>
                  <span class="info-box-number"><?php displayNewusersCount(); ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-maroon elevation-1"><i class="fas fa-times"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Expired usership</span>
                  <span class="info-box-number"><?php displayExpiredusersCount(); ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>

          <!-- Main row -->
          <div class="row">

            <div class="col-md-12">



              <!-- Member LIST -->
              <?php
              // Fetch recently joined users
              $allusersQuery = "SELECT * FROM users ORDER BY created_at DESC LIMIT 4";
              $allusersResult = $conn->query($allusersQuery);
              ?>

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">All USERS</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- Visit codeastro.com for more projects -->
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <ul class="products-list product-list-in-card pl-2 pr-2">
                    <?php
                    while ($row = $allusersResult->fetch_assoc()) {
                      echo '<li class="name">';
                      echo '<div class="product-img">';
                      // Check if the member has a photo
                      if (!empty($row['photo'])) {
                        $photoPath = 'uploads/member_photos/' . $row['photo'];
                        echo '<img src="' . $photoPath . '" alt="Member Photo" class="img-size-50">';
                      } else {
                        echo '<img src="uploads/member_photos/default.jpg" alt="Default Photo" class="img-size-50">';
                      }

                      echo '<div>';
                      echo '<div class="product-info">';
                      echo '<a href="javascript:void(0)" class="product-title">' . $row['name'] . '</a>';
                      echo '<span class="product-description">';
                    
             
                      echo '</span>';
                      echo '</div>';
                      echo '</li>';
                    }
                    ?>
                  </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <a href="manage_users.php" class="uppercase">View All users</a>
                </div>
                <!-- /.card-footer -->
              </div>

              <?php
              // Function to get membership type name based on membership type ID
              function getMembershipTypeName($membershipTypeId)
              {
                global $conn;
                $membershipTypeQuery = "SELECT type FROM membership_types WHERE id = $membershipTypeId";
                $membershipTypeResult = $conn->query($membershipTypeQuery);

                if ($membershipTypeResult->num_rows > 0) {
                  $membershipTypeRow = $membershipTypeResult->fetch_assoc();
                  return $membershipTypeRow['type'];
                } else {
                  return 'Unknown';
                }
              }


              ?>

              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    
  </div>
  <!-- ./wrapper -->

  <?php include('includes/footer.php'); ?>
</body>

</html>