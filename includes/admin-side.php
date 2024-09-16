<?php
// $pages = array(
//     'dashboard.php',
//     'members_list.php',
//     'add_type.php',
//     'view_type.php'
//     // Add other page names here
// );
require 'includes/config.php';

$current_page = basename($_SERVER['PHP_SELF']);

$countQuery = "SELECT COUNT(*) as total_types FROM membership_types";
$countResult = $conn->query($countQuery);

if ($countResult && $countResult->num_rows > 0) {
  $totalCount = $countResult->fetch_assoc()['total_types'];
} else {
  $totalCount = 0;
}
?>


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="" class="img-circle elevation-2" alt="User Image">

      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo getusername(); ?></a>
        <span class="brand-text font-weight-light"><?php echo getusername(); ?></span>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              ADMIN DASHBOARD
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link <?php echo ($current_page == 'add_type.php' || $current_page == 'view_type.php' || $current_page == 'edit_type.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-th-list"></i>
            <p>
            User Management
              <i class="fas fa-angle-left right"></i>
              <!-- <span class="badge badge-info right"><?php echo $totalCount; ?></span> -->
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="consumers.php" class="nav-link">
                <i class="fas fa-circle-notch nav-icon"></i>
                <p>Consumers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="view_type.php" class="nav-link">
                <i class="fas fa-circle-notch nav-icon"></i>
                <p>OFFICE PERSONNELS</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="add_members.php" class="nav-link <?php echo ($current_page == 'add_members.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Add Members</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="manage_users.php" class="nav-link <?php echo ($current_page == 'manage_users.php' || $current_page == 'edit_member.php' || $current_page == 'userProfile.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>Manage Members</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="list_renewal.php" class="nav-link <?php echo ($current_page == 'list_renewal.php' || $current_page == 'renew.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-undo"></i>
            <p>Renewal</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="report.php" class="nav-link <?php echo ($current_page == 'report.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-file-invoice"></i>
            <p>Membership Report</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="revenue_report.php" class="nav-link <?php echo ($current_page == 'revenue_report.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-money-check"></i>
            <p>Revenue Report</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="settings.php" class="nav-link <?php echo ($current_page == 'settings.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Settings</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="logout.php" class="nav-link <?php echo ($current_page == 'logout.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-power-off"></i>
            <p>Logout</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>