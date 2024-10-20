<?php
$db = new SQLite3('tasks.db');

// Fetch today's tasks
$tasks = $db->query("SELECT * FROM tasks WHERE user_id = 1 AND date_assigned = DATE('now')");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Task Leveling App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Daily Task Leveling App</h1>
    <button class="view-progress-btn"><a href="progress.php">View Progress</a> </button>|
<button class="refresh-tasks-btn"> <a href="refresh_tasks.php">Refresh Tasks</a>
</button>
    <h2>Add New Task</h2>
    <form action="add_task.php" method="POST">
        <label for="task">Task:</label>
        <input type="text" id="task" name="task" required><br>

        <label for="points">Points:</label>
        <input type="number" id="points" name="points" required><br>

        <input type="submit" value="Add Task">
    </form>

    <h2>Today's Tasks</h2>
    <ul>
    <?php while ($row = $tasks->fetchArray()): ?>
        <li>
            <?= htmlspecialchars($row['task']) ?> (<?= $row['points'] ?> points)

            <!-- Complete Task Button -->
            <form action="complete_task.php" method="GET" style="display:inline;">
                <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
                <button type="submit" <?= $row['completed'] ? 'disabled' : '' ?> style="background-color: green; color: white;">
                    <?= $row['completed'] ? 'Completed' : 'Complete Task' ?>
                </button>
            </form>

            <!-- Delete Task Button -->
            <form action="delete_task.php" method="GET" style="display:inline;">
                <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
                <button type="submit" style="background-color: red; color: white;" onclick="return confirm('Are you sure you want to delete this task?');">Delete</button>
            </form>
        </li>
    <?php endwhile; ?>
    </ul>

</body>
</html>
