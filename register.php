<?php
include('includes/config.php'); // Include your database connection

if (isset($_POST['register'])) { // Changed to 'register' to match the button name

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']); // Fixed variable assignment
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $role = $_POST['role'];

    // Check if the user already exists
    $select = "SELECT * FROM users WHERE username = '$username'"; // Changed to check 'username' instead of 'name'
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        if ($password != $cpassword) {
            $error[] = 'Passwords do not match!';
        } else {
            // Hash the password after confirming it matches
            $hashed_password = md5($password);

            // Insert the new user into the 'users' table
            $insert = "INSERT INTO users (name, username, password, role) VALUES ('$name', '$username', '$hashed_password', '$role')";
            if (mysqli_query($conn, $insert)) {
                header('location: index.php'); // Redirect to index page after successful registration
                exit();
            } else {
                $error[] = 'Registration failed. Please try again.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Membership Management - codeastro.com</title>
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

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href=""><b>PLARIDEALS</b></a>
        </div>
        <!-- /.register-logo -->
        <div class="card">
            <div class="card-body register-card-body">
                <p class="register-box-msg">REGISTER</p>

                <form action="" method="POST">

                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="username" placeholder="Enter username" required>
                    </div>
                    <div class="input-group mb-2">
                        <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="input-group mb-2">
                        <input type="password" class="form-control" name="cpassword" placeholder="Confirm your password" required>
                    </div>
                    <div class="input-group mb-2">
                        <select name="role" class="form-control" required>
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="cashier">Cashier</option>
                            <option value="billing">Billing</option>
                            <option value="field_personnel">Field Personnel</option>
                        </select>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <!-- Register Button -->
                        <div class="col-7">
                            <button type="submit" name="register" class="btn btn-success btn-block">Register</button>
                        </div>
                    </div>
                </form>

            </div>

            <!-- /.register-card-body -->
        </div>
        <p class="d-flex align-items-center justify-content">Already have an account? <a href="index.php">Login now</a></p>
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

</body>

</html>