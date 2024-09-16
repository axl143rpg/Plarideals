<?php
include('includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$selectQuery = "SELECT * FROM consumers";
$result = $conn->query($selectQuery);
?>


<?php include('includes/header.php');?>

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
                    <!-- left column -->
                    <div class="col-md-12">

                        <?php if ($response['success']): ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Success</h5>
                                <?php echo $response['message']; ?>
                            </div>
                        <?php elseif (!empty($response['message'])): ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-ban"></i> Error</h5>
                                <?php echo $response['message']; ?>
                            </div>
                        <?php endif; ?>

                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-keyboard"></i> consumers Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="" enctype="multipart/form-data">
                            <input type="hidden" name="consumers_id" value="<?php echo $id; ?>">
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col-sm-6">
                                    <label for="fullname">Full Name</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname"
                                        placeholder="Enter full name" required value="<?php echo $consumersDetails['fullname']; ?>">
                                </div>
                                        <div class="col-sm-3">
                                            <label for="dob">Date of Birth</label>
                                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $consumersDetails['dob']; ?>" required>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="Male" <?php echo ($consumersDetails['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                            <option value="Female" <?php echo ($consumersDetails['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                            <option value="Other" <?php echo ($consumersDetails['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                        </select>
                                    </div>

                                    </div>


                                    <div class="row mt-3">
                                        <div class="col-sm-6">
                                            <label for="contactNumber">Contact Number</label>
                                            <input type="tel" class="form-control" id="contactNumber"
                                                   name="contactNumber" placeholder="Enter contact number" value="<?php echo $consumersDetails['contact_number']; ?>" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                   placeholder="Enter email" value="<?php echo $consumersDetails['email']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-sm-6">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                   placeholder="Enter address" value="<?php echo $consumersDetails['address']; ?>" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control" id="country" name="country"
                                                   placeholder="Enter country" value="<?php echo $consumersDetails['country']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-sm-6">
                                            <label for="postcode">Postcode</label>
                                            <input type="text" class="form-control" id="postcode" name="postcode"
                                                   placeholder="Enter postcode" value="<?php echo $consumersDetails['postcode']; ?>" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="occupation">Occupation</label>
                                            <input type="text" class="form-control" id="occupation" name="occupation"
                                                   placeholder="Enter occupation" value="<?php echo $consumersDetails['occupation']; ?>" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                    <div class="col-sm-6">
                                        <label for="photo">consumers Photo</label>
                                        <input type="file" class="form-control" id="photo" name="photo">
                                        <small class="text-muted">Leave it blank if you don't want to change the photo.</small>
                                    </div>
                                </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->

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
    <footer class="main-footer">
    <strong> &copy; <?php echo date('Y');?> codeastro.com</a> -</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Developed By</b> <a href="https://codeastro.com/">CodeAstro</a>
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<?php include('includes/footer.php'); ?>
</body>
</html>
