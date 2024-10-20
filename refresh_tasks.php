<?php
$db = new SQLite3('tasks.db');

// Remove tasks older than today
$db->exec("DELETE FROM tasks WHERE date_assigned < DATE('now')");

header('Location: index.php');
exit;
?>
