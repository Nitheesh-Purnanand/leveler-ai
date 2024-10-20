<?php
// reset_progress.php
$db = new SQLite3('tasks.db');

$user_id = 1; // default user

// Reset the user's progress and level
$db->exec("UPDATE users SET level = 1, progress = 0 WHERE id = $user_id");

header('Location: progress.php');
exit;
?>
