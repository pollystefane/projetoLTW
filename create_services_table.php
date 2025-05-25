<?php
require_once 'includes/db.php';

$query = "
CREATE TABLE IF NOT EXISTS services (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    title TEXT NOT NULL,
    description TEXT NOT NULL,
    price REAL NOT NULL,
    category TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
";

if ($db->exec($query)) {
    echo "Table 'services' created successfully.";
} else {
    echo "Error creating table: " . $db->lastErrorMsg();
}
