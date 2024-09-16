<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link href="dist/css/notif.css" rel="stylesheet">
    <link rel="stylesheet" href="css/notifications.css"> <!-- Link to your CSS -->
    <script src="dist/js/notif.js"></script>
</head>
<body>

<div class="notifications-container">
    <h3>Your Notifications</h3>
    <ul id="notification-list">
        <!-- Notifications will be dynamically loaded here -->
    </ul>
</div>

<script>
$(document).ready(function() {
    var userId = 1; // This should be dynamically set to the logged-in user's ID

    // Function to load notifications
    function loadNotifications() {
        $.ajax({
            url: 'fetch_notifications.php',
            method: 'GET',
            data: { user_id: userId },
            success: function(data) {
                var notifications = JSON.parse(data);
                $('#notification-list').html(''); // Clear the current list

                notifications.forEach(function(notification) {
                    var isReadClass = notification.is_read == 1 ? 'read' : 'unread';
                    var notificationHtml = `
                        <li class="notification-item ${isReadClass}" data-id="${notification.notification_id}">
                            <div class="notification-title">${notification.title}</div>
                            <div class="notification-message">${notification.message}</div>
                            <div class="notification-time">${notification.created_at}</div>
                        </li>`;
                    $('#notification-list').append(notificationHtml);
                });
            }
        });
    }

    // Load notifications when the page loads
    loadNotifications();

    // Mark notification as read when clicked
    $(document).on('click', '.notification-item', function() {
        var notificationId = $(this).data('id');

        $.ajax({
            url: 'mark_as_read.php',
            method: 'POST',
            data: { notification_id: notificationId },
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    loadNotifications(); // Reload the notifications list
                } else {
                    alert(res.message);
                }
            }
        });
    });
});
</script>

</body>
</html>
