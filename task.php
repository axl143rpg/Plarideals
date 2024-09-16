<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link rel="stylesheet" href="dist/css/task.css"> <!-- Your CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="task-container">
        <h3>My Tasks</h3>
        <div id="task-list">
            <!-- Tasks will be inserted here -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var userId = 1; // Logged-in user ID

            // Load tasks on page load
            $.ajax({
                url: 'fetch_tasks.php',
                method: 'GET',
                data: { user_id: userId },
                success: function(data) {
                    var tasks = JSON.parse(data);
                    var taskList = $('#task-list');
                    taskList.empty();
                    if (tasks.length > 0) {
                        tasks.forEach(function(task) {
                            var taskStatus = (task.status === 'completed') ? 'checked' : '';
                            taskList.append(`
                                <div class="task-item">
                                    <input type="checkbox" class="task-checkbox" data-task-id="${task.task_id}" ${taskStatus}>
                                    <span>${task.task_name}</span>
                                </div>
                            `);
                        });

                        // Add event listener to task checkboxes
                        $('.task-checkbox').on('change', function() {
                            var taskId = $(this).data('task-id');
                            var status = $(this).is(':checked') ? 'completed' : 'pending';
                            $.ajax({
                                url: 'update_task_status.php',
                                method: 'POST',
                                data: { task_id: taskId, status: status },
                                success: function(response) {
                                    console.log(response);
                                }
                            });
                        });
                    } else {
                        taskList.append('<div>No tasks assigned.</div>');
                    }
                }
            });
        });
    </script>
</body>
</html>
