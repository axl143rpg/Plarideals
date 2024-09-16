<?php
session_start();
include 'database/dbconfig.php.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to fetch user details
    $sql = "SELECT user_id, password, role_id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role_id'] = $user['role_id'];
            
            // Fetch role name
            $role_sql = "SELECT role_name FROM roles WHERE role_id = ?";
            $role_stmt = $conn->prepare($role_sql);
            $role_stmt->bind_param("i", $user['role_id']);
            $role_stmt->execute();
            $role_result = $role_stmt->get_result();
            $role = $role_result->fetch_assoc();

            // Redirect based on role
            switch ($role['role_name']) {
                case 'admin':
                    header("Location: /admin/dashboard.php");
                    break;
                case 'cashier':
                    header("Location: /cashier/dashboard.php");
                    break;
                case 'billing':
                    header("Location: /billing/dashboard.php");
                    break;
                case 'field':
                    header("Location: /field/dashboard.php");
                    break;
                default:
                    echo "Role not recognized.";
                    break;
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }
}
?>


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Plarideals</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href=""><b>LOG IN USER</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Log in to Dashboard</p>

        <?php
        if (isset($error_message)) {
          echo '<div class="alert alert-danger">' . $error_message . '</div>';
        }
        ?>

        <form action="" method="POST">
          <div class="input-group mb-3">
            <input type="username" class="form-control" name="username" placeholder="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group-append">
          <div class="input-group mb-3">
            <select name="role" class="form-control" aria-placeholder="">
              <option value="">Select Role</option>
              <option value="admin">Admin</option>
              <option value="cashier">Cashier</option>
              <option value="billing">Billing</option>
              <option value="field_personnel">Field_Personnel</option>
            </select>
         
              <div class="input-group-text">
                <span class="fas fa-user-tag"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
          </div>
          <br>
          <div class="row justify-content-center">
            <!-- Log In Button -->
            <div class="col-8">
              <button type="submit" name="login" class="btn btn-success btn-block">Log In</button>
            </div>
            <br>
            <br>
            <!-- Register Button -->
            <div class="col-8">
              <button type="button" onclick="window.location.href='register.php';" class="btn btn-success btn-block">Register</button>
            </div>

          </div>
        </form>

      </div>
      <!-- /.login-card-body -->
    </div>
    <footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
      <div class="d-flex align-items-center justify-content-between small">
        <div class="text-muted">Copyright &copy; Your Website 2023</div>
        <div>
          <a href="#">Privacy Policy</a>
          &middot;
          <a href="#">Terms &amp; Conditions</a>
        </div>
      </div>
    </div>
  </footer>
  </div>
  <!-- /.login-box -->
 
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

</body>


