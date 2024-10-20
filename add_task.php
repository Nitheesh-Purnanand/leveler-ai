<?php
$db = new SQLite3('tasks.db');

if (isset($_POST['task']) && isset($_POST['points'])) {
    $task = $_POST['task'];
    $points = intval($_POST['points']);
    $user_id = 1; // default user

    // Add task to the database
    $db->exec("INSERT INTO tasks (user_id, task, points) VALUES ($user_id, '$task', $points)");

    header('Location: index.php');
    exit;
}
?>
