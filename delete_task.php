<?php
// delete_task.php
$db = new SQLite3('tasks.db');

if (isset($_GET['task_id'])) {
    $task_id = intval($_GET['task_id']);

    // Delete the task from the database
    $db->exec("DELETE FROM tasks WHERE id = $task_id");

    // Redirect back to the main page
    header('Location: index.php');
    exit;
}
?>
