<?php
// Include the database configuration
include_once 'includes/config.php';

// Ensure that the conversation ID is provided
if (isset($_GET['conversation_id'])) {
    $conversation_id = $_GET['conversation_id'];

    // Query to fetch all messages for the given conversation
    $query = "SELECT * FROM messages WHERE conversation_id = ? ORDER BY sent_at ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $conversation_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize an array to hold the messages
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    // Return the messages in JSON format
    echo json_encode($messages);
} else {
    echo json_encode(["status" => "Error", "message" => "Conversation ID not provided"]);
}
?>
