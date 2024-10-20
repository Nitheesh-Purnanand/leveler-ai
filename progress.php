<?php
$db = new SQLite3('tasks.db');

$user_id = 1; // default user
$user = $db->querySingle("SELECT level, progress FROM users WHERE id = $user_id", true);

$level = $user['level'];
$progress = $user['progress'];
$rank_up_points = 100;
$progress_percentage = ($progress / $rank_up_points) * 100;
$ranks = ['E', 'D', 'C', 'B', 'A', 'S (God Level)'];
$current_rank = $ranks[min($level - 1, 5)];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Your Progress</h1>
    <h2>Current Rank: <?= $current_rank ?></h2>
    <h3>Level: <?= $level ?></h3>

    <div class="progress-bar">
        <div class="progress" style="width: <?= $progress_percentage ?>%;"><?= intval($progress_percentage) ?>%</div>
    </div>

    <!-- Reset Progress Button -->
    <form action="reset_progress.php" method="POST">
        <button type="submit" style="background-color: red; color: white;">Reset Progress</button>
    </form>

    <br><button class="back-task-btn"><a href="index.php">Back to Task List</a></button>

</body>
</html>
