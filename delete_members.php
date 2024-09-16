<?php
// include('includes/config.php');

// if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
//     $userId = $_GET['id'];

//     $checkQuery = "SELECT * FROM users WHERE id = $userId";
//     $checkResult = $conn->query($checkQuery);

//     if ($checkResult->num_rows > 0) {
//         $deleteQuery = "DELETE FROM users WHERE id = $userId";

//         if ($conn->query($deleteQuery) === TRUE) {
//             header("Location: manage_users.php");
//             exit();
//         } else {
//             echo "Error deleting record: " . $conn->error;
//         }
//     } else {
//         header("Location: manage_users.php");
//         exit();
//     }
// } else {
//     header("Location: manage_users.php");
//     exit();
// }

// $conn->close();

include('includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $userId = $_GET['id'];

    $checkRenewQuery = "SELECT * FROM renew WHERE user_id = $userId";
    $checkRenewResult = $conn->query($checkRenewQuery);

    if ($checkRenewResult->num_rows > 0) {
        $deleteRenewQuery = "DELETE FROM renew WHERE user_id = $userId";
        if ($conn->query($deleteRenewQuery) === FALSE) {
            echo "Error deleting related renew records: " . $conn->error;
            exit();
        }
    }

    $deleteuserQuery = "DELETE FROM users WHERE id = $userId";

    if ($conn->query($deleteuserQuery) === TRUE) {
        header("Location: manage_users.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: manage_users.php");
    exit();
}

$conn->close();
?>