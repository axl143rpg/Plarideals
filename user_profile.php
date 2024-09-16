<?php
// Start session


// Include database connection file
include_once('includes/config.php');

// Assuming user_id is stored in the session
$id = $_SESSION['user_id']; // Make sure to set 'user_id' in the session on login

// Fetch user details from database
$query = "SELECT name, username, role, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id); // Changed from "id" to "i" (integer)
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("User not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/your/css/style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="profile-container">
        <h1>User Profile</h1>
        <div class="profile-details">
            <div class="profile-picture">
                <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" id="profile-picture" alt="Profile Picture">
            </div>
            <div class="profile-info">
                <p><strong>Name:</strong> <span id="user-name"><?php echo htmlspecialchars($user['name']); ?></span></p>
                <p><strong>Username:</strong> <span id="user-username"><?php echo htmlspecialchars($user['username']); ?></span></p>
                <p><strong>Role:</strong> <span id="user-role"><?php echo htmlspecialchars($user['role']); ?></span></p>
            </div>
        </div>
    </div>
</body>
</html>
