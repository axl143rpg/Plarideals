$(document).ready(function() {
    var conversationId = 1;  // Replace with actual conversation ID
    var senderId = 1;        // Replace with logged-in user's ID

    // Function to load messages
    function loadMessages() {
        $.ajax({
            url: 'fetch_messages.php',
            method: 'GET',
            data: { conversation_id: conversationId },
            success: function(data) {
                var messages = JSON.parse(data);
                $('#chat-messages').html(''); // Clear existing messages
                messages.forEach(function(message) {
                    var messageHtml = '<div class="message ' + (message.sender_id == senderId ? 'sent' : 'received') + '">' + message.message_text + '</div>';
                    $('#chat-messages').append(messageHtml);
                });
                $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight); // Scroll to the bottom
            }
        });
    }

    // Load messages when the page loads
    loadMessages();

    // Send message on button click
    $('#sendMessageBtn').on('click', function() {
        var messageText = $('#messageText').val();

        if (messageText.trim() !== '') {
            $.ajax({
                url: 'send_message.php',
                method: 'POST',
                data: {
                    conversation_id: conversationId,
                    sender_id: senderId,
                    message_text: messageText
                },
                success: function() {
                    $('#messageText').val(''); // Clear input field
                    loadMessages(); // Reload messages
                }
            });
        }
    });

    // Polling every 5 seconds to refresh messages
    setInterval(loadMessages, 5000);
});
