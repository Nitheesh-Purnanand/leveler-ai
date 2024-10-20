<?php
$db = new SQLite3('tasks.db');

if (isset($_GET['task_id'])) {
    $task_id = intval($_GET['task_id']);
    $user_id = 1; // default user

    // Get task points
    $task = $db->querySingle("SELECT points FROM tasks WHERE id = $task_id AND completed = 0", true);

    if ($task) {
        $points = $task['points'];

        // Mark task as completed
        $db->exec("UPDATE tasks SET completed = 1 WHERE id = $task_id");

        // Update user progress
        $user = $db->querySingle("SELECT level, progress FROM users WHERE id = $user_id", true);
        $new_progress = $user['progress'] + $points;

        // Define rank-up points
        $rank_up_points = 100;
        if ($new_progress >= $rank_up_points) {
            $new_level = $user['level'] + 1;
            $new_progress -= $rank_up_points;
            $db->exec("UPDATE users SET level = $new_level, progress = $new_progress WHERE id = $user_id");
        } else {
            $db->exec("UPDATE users SET progress = $new_progress WHERE id = $user_id");
        }
    }

    header('Location: index.php');
    exit;
}
?>
