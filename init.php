<?php
// init.php (Run this once to create the database)
$db = new SQLite3('tasks.db');

// Create Users Table
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    level INTEGER DEFAULT 1,
    progress INTEGER DEFAULT 0
)");

// Create Tasks Table
$db->exec("CREATE TABLE IF NOT EXISTS tasks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    task TEXT NOT NULL,
    points INTEGER NOT NULL,
    completed INTEGER DEFAULT 0,
    date_assigned DATE DEFAULT (DATE('now'))
)");

// Add a default user
$db->exec("INSERT INTO users (username) VALUES ('default_user')");

echo "Database initialized!";
?>
