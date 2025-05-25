<?php
try {
    $db = new SQLite3(__DIR__ . '/../database/freelancer.db');
} catch (Exception $e) {
    die('Unable to connect to database: ' . $e->getMessage());
}
