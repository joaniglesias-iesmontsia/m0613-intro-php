<?php
// ==============================================================================
// Front Controller (index.php)
// Application bootstrap: loads configuration, router, and dispatches request
// ==============================================================================

// 1. Load database connection
require_once __DIR__ . '/config/db.php';

// 2. Load Router and Route table
require_once __DIR__ . '/Router.php';
$routes = require_once __DIR__ . '/routes.php';

// 3. Read request parameters from URL (default: students / index)
$controller = $_GET['controller'] ?? 'students';
$action     = $_GET['action'] ?? 'index';

// 4. Dispatch the request through the Router
$router = new Router($routes);
$router->dispatch($controller, $action, $db);
