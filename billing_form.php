<?php
include('includes/config.php');

// Fetch billing from the database
$billingQuery = "SELECT billing_id, name FROM billing WHERE status = 'pending'";
$billingResult = $conn->query($billingQuery);

// Initialize response
$response = array('success' => false, 'message' => '');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $consumer_id = $_POST['consumer_id'];
    $billing_period = $_POST['billing_period'];
    $status = $_POST['status'];
    $previous_reading = $_POST['previous_reading'];
    $current_reading = $_POST['current_reading'];

    // Calculate consumption and amount due (assuming price per cubic meter is fixed)
    $consumption = $current_reading - $previous_reading;
    $price_per_cubic_meter = 10; // Example rate
    $amount_due = $consumption * $price_per_cubic_meter;

    // Insert billing record
    $insertBillingQuery = "INSERT INTO billings (billing_id, billing_period, due_period, previous_reading, current_reading, consumption, amount_due, status, created_at) 
                           VALUES ('$billing_id', '$billing_period', '$due_period', '$previous_reading', '$current_reading', '$consumption', '$amount_due', 'unpaid', NOW())";

    if ($conn->query($insertBillingQuery) === TRUE) {
        $response['success'] = true;
        $response['message'] = 'Billing record added successfully!';
    } else {
        $response['message'] = 'Error: ' . $conn->error;
    }
}
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
                <!-- Billing Form -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-file-invoice-dollar"></i> Add Billing Record</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="billing_id">Select billing</label>
                                <select class="form-control" id="billing_id" name="billing_id" required>
                                    <option value="">Select billing</option>
                                    <?php
                                    if ($billingResult->num_rows > 0) {
                                        while ($row = $billingResult->fetch_assoc()) {
                                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No active billing found</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="billing_period">Billing period</label>
                                <input type="period" class="form-control" id="billing_period" name="billing_period" required>
                            </div>
                            <div class="form-group">
                                <label for="due_period">Due period</label>
                                <input type="period" class="form-control" id="due_period" name="due_period" required>
                            </div>
                            <div class="form-group">
                                <label for="previous_reading">Previous Reading (m<sup>3</sup>)</label>
                                <input type="number" class="form-control" id="previous_reading" name="previous_reading" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="current_reading">Current Reading (m<sup>3</sup>)</label>
                                <input type="number" class="form-control" id="current_reading" name="current_reading" step="0.01" required>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->

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
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include('includes/footer.php'); ?>
</div>
<!-- ./wrapper -->

<?php include('includes/footer-scripts.php'); ?>
</body>
</html>
