<?php
// ==============================================================================
// Routes Definition
// Maps controller keys from the URL to their respective Controller classes
// ==============================================================================

require_once __DIR__ . '/controllers/StudentController.php';
require_once __DIR__ . '/controllers/TeacherController.php';

return [
    'students' => StudentController::class,
    'teachers' => TeacherController::class,
];
