<?php
include('includes/config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {

    header("Location: ./index.php"); // Redirect to login or a page with access denied message
    exit();
  }

$response = array('success' => false, 'message' => '');

// Fetch all consumers for potential dropdowns or lists
$consumersStatusQuery = "SELECT * FROM consumers";
$consumersStatusResult = $conn->query($consumersStatusQuery);

$consumersDetails = null; // Initialize $consumersDetails to avoid undefined variable errors

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $consumersId = (int)$_GET['id'];  // Ensure ID is an integer

    // Fetch consumer details by ID
    $fetchConsumersQuery = "SELECT * FROM consumers WHERE id = ?";
    $stmt = $conn->prepare($fetchConsumersQuery);
    $stmt->bind_param("i", $consumersId);
    $stmt->execute();
    $fetchConsumersResult = $stmt->get_result();

    if ($fetchConsumersResult->num_rows > 0) {
        $consumersDetails = $fetchConsumersResult->fetch_assoc();
    } else {
        // Consumer not found, redirect or handle the error
        header("Location: admin-dashboard.php"); // Redirect if consumer is not found
        exit();
    }
} else {
    // Invalid or missing ID, redirect or handle the error
    header("Location: admin-dashboard.php"); // Redirect if ID is not provided
    exit();
}

function generateUniqueFileName($filename)
{
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $basename = pathinfo($filename, PATHINFO_FILENAME);
    $uniqueName = $basename . '_' . time() . '.' . $ext;
    return $uniqueName;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $status = $_POST['status'];
    $account_number = $_POST['account_number'];

    // Optional: Handle photo upload if required
    $photoUpdate = "";
    if (!empty($_FILES['photo']['name'])) {
        $photo = $_FILES['photo'];
        $uniquePhotoName = generateUniqueFileName($photo['name']);
        move_uploaded_file($photo['tmp_name'], 'uploads/' . $uniquePhotoName);
        $photoUpdate = ", photo='$uniquePhotoName'";
    }

    $updateQuery = "UPDATE consumers SET name=?, address=?, contact_number=?, status=?, account_number=? $photoUpdate WHERE id=?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssssi", $name, $address, $contact_number, $status, $account_number, $consumersId);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Consumer updated successfully!';
        header("Location: manage_consumers.php");
        exit();
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

    <div class="content-wrapper">
        <?php include('includes/pagetitle.php'); ?>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
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

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-keyboard"></i> Edit Consumer Details</h3>
                            </div>
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   placeholder="Enter full name" required value="<?php echo isset($consumersDetails) ? htmlspecialchars($consumersDetails['name']) : ''; ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                   placeholder="Enter address" required value="<?php echo isset($consumersDetails) ? htmlspecialchars($consumersDetails['address']) : ''; ?>">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-sm-6">
                                            <label for="contact_number">Contact Number</label>
                                            <input type="tel" class="form-control" id="contact_number"
                                                   name="contact_number" placeholder="Enter contact number" required value="<?php echo isset($consumersDetails) ? htmlspecialchars($consumersDetails['contact_number']) : ''; ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control" id="status" name="status"
                                                   placeholder="Enter status" required value="<?php echo isset($consumersDetails) ? htmlspecialchars($consumersDetails['status']) : ''; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-sm-6">
                                            <label for="account_number">Account Number</label>
                                            <input type="text" class="form-control" id="account_number" name="account_number"
                                                   placeholder="Enter account number" required value="<?php echo isset($consumersDetails) ? htmlspecialchars($consumersDetails['account_number']) : ''; ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="photo">Photo (Optional)</label>
                                            <input type="file" class="form-control" id="photo" name="photo">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <aside class="control-sidebar control-sidebar-dark"></aside>

    <footer class="main-footer">
        <strong> &copy; <?php echo date('Y'); ?> codeastro.com</a> -</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Developed By</b> <a href="https://codeastro.com/">CodeAstro</a>
        </div>
    </footer>
</div>

<?php include('includes/footer.php'); ?>
</body>
</html>
