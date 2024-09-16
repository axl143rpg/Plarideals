<?php
include('../includes/config.php'); // Ensure the correct path to your database connection

// Fetch the user ID from the URL
$getID = isset($_GET['id']) ? $_GET['id'] : ''; // Ensure ID is set

// Validate and sanitize the user ID
if (!filter_var($getID, FILTER_VALIDATE_INT)) {
    die("Invalid user ID");
}

// Prepare the query with a parameterized statement
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);

// Check for preparation errors
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind the user ID parameter and execute the statement
$stmt->bind_param("i", $getID);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if the query was successful
if ($result) {
    // Fetch user details
    if ($user = $result->fetch_assoc()) {
        $name = htmlspecialchars($user['name']);
        $username = htmlspecialchars($user['username']);
        $email = htmlspecialchars($user['role']);
        $phone = htmlspecialchars($user['created_at']); // Assuming you meant phone number for `created_at`
    } else {
        die("User not found");
    }
} else {
    die("Query failed: " . $conn->error);
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="path/to/your/css/style.css"> <!-- Link to your CSS file -->
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Editing User (<?php echo htmlspecialchars($getID); ?>)</h4>
                    </div>
                    <div class="panel-body form-group form-group-sm">
                        <form method="post" id="update_user" action="update_user.php"> <!-- Make sure `update_user.php` handles form submission -->
                            <input type="hidden" name="action" value="update_user">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($getID); ?>">

                            <div class="row">
                                <div class="col-xs-4">
                                    <input type="text" class="form-control margin-bottom required" name="name" placeholder="Name" value="<?php echo $name; ?>" required>
                                </div>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control margin-bottom required" name="username" placeholder="Enter username" value="<?php echo $username; ?>" required>
                                </div>
                                <div class="input-group-append">
                                    <div class="input-group mb-3">
                                        <select name="role" class="form-control" aria-placeholder="">
                                            <option value="<?php echo $username; ?>">Select Role</option>
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
                               
                            </div>

                            <div class="row">
                                <div class="col-xs-12 margin-top btn-group">
                                    <input type="submit" id="action_update_user" class="btn btn-success float-right" value="Edit user" data-loading-text="Editing...">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</body>

</html>