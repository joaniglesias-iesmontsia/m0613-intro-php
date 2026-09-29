<?php
// ==============================================================================
// Database Configuration (SQLite via PDO)
// ==============================================================================

$db = new PDO('sqlite:' . dirname(__DIR__) . '/students.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Initialize database tables if not existing
$db->exec("CREATE TABLE IF NOT EXISTS students (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    age INTEGER NOT NULL
)");

$db->exec("CREATE TABLE IF NOT EXISTS teachers (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    subject TEXT NOT NULL
)");
