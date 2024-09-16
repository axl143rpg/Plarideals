<?php
include_once('includes/config.php'); // Include database connection

// Fetch tasks from the database
$query = "SELECT * FROM tasks ORDER BY created_at DESC";
$result = $conn->query($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission to add or update tasks
    if (isset($_POST['title'], $_POST['description'], $_POST['status'], $_POST['due_date'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $due_date = $_POST['due_date'];
        $assigned_to = $_POST['assigned_to']; // This should be handled with user selection

        if (isset($_POST['task_id'])) {
            // Update existing task
            $task_id = $_POST['task_id'];
            $query = "UPDATE tasks SET title = ?, description = ?, status = ?, due_date = ?, updated_at = NOW() WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssi", $title, $description, $status, $due_date, $task_id);
        } else {
            // Insert new task
            $query = "INSERT INTO tasks (title, description, status, due_date, created_at) VALUES (?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $title, $description, $status, $due_date);
        }

        if ($stmt->execute()) {
            header("Location: tasks.php"); // Redirect to the same page to show updated tasks
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/task.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>Task Management</h1>
    
    <!-- Add/Edit Task Form -->
    <div class="task-form">
        <h2>Add/Edit Task</h2>
        <form action="tasks.php" method="POST">
            <input type="hidden" name="task_id" id="task_id" value="">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
            <label for="description">Description:</label>
            <textarea name="description" id="description"></textarea>
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
            <label for="due_date">Due Date:</label>
            <input type="date" name="due_date" id="due_date">
            <label for="assigned_to">Assigned To:</label>
            <input type="text" name="assigned_to" id="assigned_to"> <!-- Assuming a way to select user -->
            <button type="submit">Save Task</button>
        </form>
    </div>

    <!-- Tasks List -->
    <div class="task-list">
        <h2>Tasks</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Assigned To</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td><?php echo htmlspecialchars($row['due_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['assigned_to']); ?></td>
                    <td>
                        <button onclick="editTask(<?php echo $row['id']; ?>)">Edit</button>
                        <a href="delete_task.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
    // Function to pre-fill the form for editing
    function editTask(taskId) {
        // Fetch task data via AJAX or pre-fill from the page (for simplicity, assuming a direct approach)
        var row = document.querySelector(`tr[data-task-id='${taskId}']`);
        document.getElementById('task_id').value = taskId;
        document.getElementById('title').value = row.querySelector('td:nth-child(1)').textContent;
        document.getElementById('description').value = row.querySelector('td:nth-child(2)').textContent;
        document.getElementById('status').value = row.querySelector('td:nth-child(3)').textContent;
        document.getElementById('due_date').value = row.querySelector('td:nth-child(4)').textContent;
        document.getElementById('assigned_to').value = row.querySelector('td:nth-child(5)').textContent;
    }
    </script>
</body>
</html>
