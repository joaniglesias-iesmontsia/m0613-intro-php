<?php
// Database connection configuration (SQLite)
$db = new PDO('sqlite:' . __DIR__ . '/students.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
