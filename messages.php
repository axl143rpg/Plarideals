<?php
// Database connection
include_once ('includes/config.php');

// Function to handle sending messages
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['conversation_id']) && isset($_POST['sender_id']) && isset($_POST['message_text'])) {
    $conversation_id = $_POST['conversation_id'];
    $sender_id = $_POST['sender_id'];
    $message_text = $_POST['message_text'];

    // Insert query to add a new message
    $query = "INSERT INTO messages (conversation_id, sender_id, message_text) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $conversation_id, $sender_id, $message_text);

    if ($stmt->execute()) {
        echo json_encode(["status" => "Message sent"]);
    } else {
        echo json_encode(["status" => "Error", "message" => "Failed to send message"]);
    }
    exit;
}

// Function to retrieve all messages
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['conversation_id'])) {
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
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversation</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin/css/message.css"> <!-- Link to your CSS file -->
    <script src="dist/js/msg.js"></script> <!-- jQuery -->
</head>
<body>

<div class="chat-container">
    <div class="chat-header">
        <h3>Conversation with <span id="receiver-name">User</span></h3>
    </div>
    <div class="chat-messages" id="chat-messages">
        <!-- Messages will be dynamically inserted here -->
    </div>
    <div class="chat-input">
        <textarea id="messageText" placeholder="Type your message here..."></textarea>
        <button id="sendMessageBtn"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>

<script>
// JavaScript to handle message sending and fetching
$(document).ready(function() {
    var conversationId = 1;  // Set the conversation ID (this should be dynamic)
    var senderId = 1;        // Set the sender ID (this should be the logged-in user)

    // Function to load messages from the server
    function loadMessages() {
        $.ajax({
            url: window.location.href,  // Use the same page URL to fetch messages
            type: 'GET',
            data: { conversation_id: conversationId },
            success: function(response) {
                var messages = JSON.parse(response);
                $('#chat-messages').empty(); // Clear the chat window

                // Append each message
                messages.forEach(function(message) {
                    $('#chat-messages').append(`
                        <div class="message">
                            <p><strong>User ${message.sender_id}:</strong> ${message.message_text}</p>
                            <span class="time">${message.sent_at}</span>
                        </div>
                    `);
                });
            }
        });
    }

    // Load messages on page load
    loadMessages();

    // Send message on button click
    $('#sendMessageBtn').on('click', function() {
        var messageText = $('#messageText').val();

        // Don't send an empty message
        if (messageText.trim() === '') {
            alert('Message cannot be empty');
            return;
        }

        // Send the message to the server
        $.ajax({
            url: window.location.href,
            type: 'POST',
            data: {
                conversation_id: conversationId,
                sender_id: senderId,
                message_text: messageText
            },
            success: function(response) {
                var result = JSON.parse(response);

                if (result.status === "Message sent") {
                    $('#messageText').val(''); // Clear the text area
                    loadMessages(); // Reload the messages
                } else {
                    alert(result.message);
                }
            }
        });
    });
});
</script>
</body>
</html>
