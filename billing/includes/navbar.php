   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->


     <?php

      function getSystemName()
      {
        global $conn;

        $systemNameQuery = "SELECT system_name FROM settings";
        $systemNameResult = $conn->query($systemNameQuery);

        if ($systemNameResult->num_rows > 0) {
          $systemNameRow = $systemNameResult->fetch_assoc();
          return $systemNameRow['system_name'];
        } else {
          return 'Empty';
        }
      }

      function getLogoUrl()
      {
        global $conn;

        $logoQuery = "SELECT logo FROM settings";
        $logoResult = $conn->query($logoQuery);

        if ($logoResult->num_rows > 0) {
          $logoRow = $logoResult->fetch_assoc();
          return $logoRow['logo'];
        } else {
          return 'dist/img/AdminLTELogo.png';
        }
      }
      function getusername()
      {
        global $conn;

        $nameQuery = "SELECT username FROM users";
        $nameResult = $conn->query($nameQuery);

        if ($nameResult->num_rows > 0) {
          $nameRow = $nameResult->fetch_assoc();
          return $nameRow['username'];
        } else {
          return 'dist/img/AdminLTELogo.png';
        }
      }
      ?>

     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
       <div class="sidebar-brand-icon rotate-n-15">
         <img src="<?php echo getLogoUrl(); ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
       </div>
       <div class="sidebar-brand-text mx-3"><span class="brand-text font-weight-light"><?php echo getSystemName(); ?></span></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">


     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
       <a class="nav-link" href="index.php">
         <i class="fas fa-fw fa-tachometer-alt"></i>
         <span>Billing Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
       Task Management
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
         <i class="fas fa-fw fa-users"></i>
         <span>Field Personnels</span>
       </a>
       <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
         <div class="bg-white py-2 collapse-inner rounded">
           <h6 class="collapse-header">Task</h6>
           <a class="collapse-item" href="../task.php">View</a>
           <a class="collapse-item" href="../assign.php">Assign</a>
         </div>
       </div>
     </li>




     <li class="nav-item">
       <a class="nav-link" href="register.php">
         <i class="fas fa-fw fa-user"></i>
         <span>Profile</span></a>
     </li>



     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
         <i class="fas fa-fw fa-wrench"></i>
         <span>Task Management</span>
       </a>
       <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
         <div class="bg-white py-2 collapse-inner rounded">
           <h6 class="collapse-header">Task Utilities:</h6>
           <a class="collapse-item" href="utilities-color.html">Update</a>
           <a class="collapse-item" href="utilities-border.html">Assign</a>
           <a class="collapse-item" href="utilities-animation.html">Delete</a>
           <a class="collapse-item" href="utilities-other.html">Other</a>
         </div>
       </div>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
       Consumers Management
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
         <i class="fas fa-fw fa-folder"></i>
         <span>Consumers Records</span>
       </a>
       <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
         <div class="bg-white py-2 collapse-inner rounded">
           <h6 class="collapse-header">Billing Records:</h6>
           <a class="collapse-item" href="login.html">Login</a>
           <a class="collapse-item" href="register.html">Register</a>
           <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
           <div class="collapse-divider"></div>
           <h6 class="collapse-header">Consumers:</h6>
           <a class="collapse-item" href="404.html">Outstanding Balance</a>
           <a class="collapse-item" href="blank.html">Penalties</a>
         </div>
       </div>
     </li>

    s

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
       <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

   </ul>
   <!-- End of Sidebar -->

   <!-- Content Wrapper -->
   <div id="content-wrapper" class="d-flex flex-column">

     <!-- Main Content -->
     <div id="content">

       <!-- Topbar -->
       <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

         <!-- Sidebar Toggle (Topbar) -->
         <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
           <i class="fa fa-bars"></i>
         </button>

         <!-- Topbar Search -->
         <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
           <div class="input-group">
             <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
             <div class="input-group-append">
               <button class="btn btn-primary" type="button">
                 <i class="fas fa-search fa-sm"></i>
               </button>
             </div>
           </div>
         </form>


         <!-- Topbar Navbar -->
         <ul class="navbar-nav ml-auto">

           <!-- Nav Item - Search Dropdown (Visible Only XS) -->
           <li class="nav-item dropdown no-arrow d-sm-none">
             <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-search fa-fw"></i>
             </a>
             <!-- Dropdown - Messages -->
             <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
               <form class="form-inline mr-auto w-100 navbar-search">
                 <div class="input-group">
                   <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                   <div class="input-group-append">
                     <button class="btn btn-primary" type="button">
                       <i class="fas fa-search fa-sm"></i>
                     </button>
                   </div>
                 </div>
               </form>
             </div>
           </li>

           <!-- Nav Item - Alerts -->
           <!-- Notifications Dropdown -->
           <li class="nav-item dropdown no-arrow mx-1">
             <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-bell fa-fw"></i>
               <span class="badge badge-danger badge-counter" id="notification-count">0</span>
             </a>
             <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
               <h6 class="dropdown-header">
                 Alerts Center
               </h6>
               <div id="notification-list">
                 <!-- Notifications will be inserted here -->
               </div>
               <a class="dropdown-item text-center small text-gray-500" href="">Show All Alerts</a>
             </div>
           </li>

           <!-- Messages Dropdown -->
           <li class="nav-item dropdown no-arrow mx-1">
             <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-envelope fa-fw"></i>
               <span class="badge badge-danger badge-counter" id="message-count">0</span>
             </a>
             <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
               <h6 class="dropdown-header">
                 Message Center
               </h6>
               <div id="message-list">
                 <!-- Messages will be inserted here -->
               </div>
               <a class="dropdown-item text-center small text-gray-500" href="#">Show All Messages</a>
             </div>
           </li>

           <!-- Divider -->
           <div class="topbar-divider d-none d-sm-block"></div>


           <!-- Nav Item - task -->
           <!-- Tasks Dropdown -->
           <li class="nav-item dropdown no-arrow mx-1">
             <a class="nav-link dropdown-toggle" href="#" id="tasksDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-tasks fa-fw"></i>
               <span class="badge badge-danger badge-counter" id="task-count">0</span>
             </a>
             <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="tasksDropdown">
               <h6 class="dropdown-header">
                 Task Center
               </h6>
               <div id="task-list">
                 <!-- Tasks will be dynamically inserted here -->
               </div>
               <a class="dropdown-item text-center small text-gray-500" href="../task.php">Show All Tasks</a>
             </div>
           </li>



           <div class="topbar-divider d-none d-sm-block"></div>

           <!-- Nav Item - User Information -->
           <li class="nav-item dropdown no-arrow">
             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <span class="mr-2 d-none d-lg-inline text-gray-600 small">

                 ADMIN

               </span>
               <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
             </a>
             <!-- Dropdown - User Information -->
             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
               <a class="dropdown-item" href="#">
                 <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                 Profile
               </a>
               <a class="dropdown-item" href="#">
                 <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                 Settings
               </a>
               <a class="dropdown-item" href="#">
                 <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                 Activity Log
               </a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                 <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                 Logout
               </a>
             </div>
           </li>

         </ul>

       </nav>
       <!-- End of Topbar -->


       <!-- Scroll to Top Button-->
       <a class="scroll-to-top rounded" href="#page-top">
         <i class="fas fa-angle-up"></i>
       </a>


       <!-- Logout Modal-->
       <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
               </button>
             </div>
             <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
             <div class="modal-footer">
               <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

               <form action="logout.php" method="POST">

                 <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>

               </form>


             </div>
           </div>
         </div>
       </div>