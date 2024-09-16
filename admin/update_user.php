<?php
include('../includes/config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id']; // Get the user ID from the form
    $name = $_POST['name'];
    $username = $_POST['username'];
    $role = $_POST['role']; // Assuming this is what you meant instead of email

    // Sanitize and validate input
    $id = $conn->real_escape_string($id);
    $name = $conn->real_escape_string($name);
    $username = $conn->real_escape_string($username);
    $role = $conn->real_escape_string($role);

    // Prepare the update query
    $query = "UPDATE users SET name = ?, username = ?, role = ? WHERE id = ?";

    $stmt = $conn->prepare($query);

    if ($stmt) {
        // Bind the parameters correctly (sssi: 3 strings and 1 integer)
        $stmt->bind_param("sssi", $name, $username, $role, $id);
        
        // Execute the query
        if ($stmt->execute()) {
            // Redirect to the users list or another page upon success
            header("Location: users.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Prepare failed: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
