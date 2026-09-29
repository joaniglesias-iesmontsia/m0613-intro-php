<?php
// ==============================================================================
// Router Class
// Dispatches incoming HTTP requests to the matching Controller & Action
// ==============================================================================

class Router {
    private array $routes;

    public function __construct(array $routes) {
        $this->routes = $routes;
    }

    public function dispatch(string $controllerName, string $actionName, PDO $db): void {
        // 1. Validate route or fallback to default ('students')
        if (!array_key_exists($controllerName, $this->routes)) {
            $controllerName = 'students';
        }

        // 2. Instantiate the corresponding Controller
        $controllerClass = $this->routes[$controllerName];
        $controller = new $controllerClass($db);

        // 3. Execute the requested action if it exists, or fallback to index
        if (method_exists($controller, $actionName)) {
            $controller->$actionName();
        } else {
            $controller->index();
        }
    }
}
