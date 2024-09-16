<?php
// Include the database configuration
include_once '/includes/config.php';

// Ensure that all required fields are provided
if (isset($_POST['conversation_id']) && isset($_POST['sender_id']) && isset($_POST['message_text'])) {
    $conversation_id = $_POST['conversation_id'];
    $sender_id = $_POST['sender_id'];
    $message_text = $_POST['message_text'];

    // Insert query to add a new message to the conversation
    $query = "INSERT INTO messages (conversation_id, sender_id, message_text) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $conversation_id, $sender_id, $message_text);

    if ($stmt->execute()) {
        echo json_encode(["status" => "Message sent"]);
    } else {
        echo json_encode(["status" => "Error", "message" => "Failed to send message"]);
    }
} else {
    echo json_encode(["status" => "Error", "message" => "Required fields not provided"]);
}
?>
