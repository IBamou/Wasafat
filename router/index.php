<?php
/**
 * Router Index
 * Main entry point that routes all HTTP requests to appropriate controllers
 */

// Start session FIRST before anything else
session_start();

// Register error handler for catching all errors
require __DIR__ . '/../vendor/autoload.php';

// Import controllers

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\DashboardController;
use App\Controllers\CategoryController;
use App\Controllers\RecipeController;
use App\Controllers\UserController;
use App\Middleware\Middleware;

/**
 * Router Class
 * Handles URL pattern matching and dispatches to controllers
 * 
 * Features:
 * - GET/POST method separation
 * - Parameter extraction from URLs (e.g., /users/{id})
 * - Middleware support for authentication/authorization
 */
class Router {
    static private array $routes = [];
    static private int $currentRouteIndex;

    /**
     * Register a GET route
     */
    static public function get(string $pattern, array $callback): self {
        $route = [
            'method' => 'GET',
            'pattern' => $pattern,
            'callback' => $callback,
            'middleware' => []
        ];
        self::$routes[] = $route;
        self::$currentRouteIndex = count(self::$routes) - 1;
        return new self;
    }

    /**
     * Register a POST route
     */
    static public function post(string $pattern, array $callback): self {
        $route = [
            'method' => 'POST',
            'pattern' => $pattern,
            'callback' => $callback,
            'middleware' => []
        ];
        self::$routes[] = $route;
        self::$currentRouteIndex = count(self::$routes) - 1;
        return new self;
    }

    /**
     * Add middleware to the current route
     */
    static public function middleware(string $method, array $args = []): self {
        if (isset(self::$currentRouteIndex)) {
            self::$routes[self::$currentRouteIndex]['middleware'][] = [$method, $args];
        }
        return new self;
    }

    /**
     * Parse the current request
     * Returns path and HTTP method
     */
    static public function request(): array {
        $basePath = '/Wasafat/';
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $request = trim(str_replace(strtolower($basePath), '', strtolower($path)), '/');
        if ($request === '') $request = '/';
        return [
            'PATH' => $request, 
            'REQUEST_METHOD' => $_SERVER['REQUEST_METHOD']
        ];
    }

    /**
     * Match current request to a route and execute
     */
    static public function match(): void {
        $request = self::request();

        // Iterate through all registered routes
        foreach (self::$routes as $route) {
            // Skip if HTTP method doesn't match
            if ($route['method'] !== $request['REQUEST_METHOD']) continue;

            // Convert URL pattern to regex
            // Example: 'users/{id}' becomes 'users/(?P<id>\d+)'
            $patternRegex = preg_replace_callback(
                '#\{([\w]+)\}#', 
                fn($matches) => '(?P<' . $matches[1] . '>\d+)',
                $route['pattern']
            );
            
            // Try to match the request path against the pattern
            if (preg_match("#^$patternRegex$#", $request['PATH'], $matches)) {
                // Extract named parameters from URL
                $params = [];
                foreach ($matches as $key => $value) {
                    if (is_string($key)) $params[$key] = $value;
                }
                
                // Run middleware (if any)
                if (!empty($route['middleware'])) {
                    foreach ($route['middleware'] as $middleware) {
                        [$middlewareMethod, $args] = $middleware;
                        call_user_func_array([new Middleware(), $middlewareMethod], $args);
                    }
                }
                
                // Instantiate controller and call method
                [$class, $method] = $route['callback'];
                $controller = new $class();
                call_user_func_array([$controller, $method], $params);
                return;
            }
        }

        // No route matched - show 404
        include '../app/Views/Errors/404.php';
        exit;
    }
}

// =============================================================================
// ROUTES DEFINITION
// =============================================================================


Router::get('/', [HomeController::class, 'index']);
Router::get('home', [HomeController::class, 'index']);

// Auth
Router::get('login', [AuthController::class, 'login'])->middleware('isGuest');
Router::post('login', [AuthController::class, 'login'])->middleware('isGuest');
Router::get('signup', [AuthController::class, 'signup'])->middleware('isGuest');
Router::post('signup', [AuthController::class, 'signup'])->middleware('isGuest');
Router::post('logout', [AuthController::class, 'logout'])->middleware('isLoggedIn');

// Dashboard
Router::get('dashboard', [DashboardController::class, 'index'])->middleware('isLoggedIn');

// Categories 
Router::get('categories', [CategoryController::class, 'index'])->middleware('isLoggedIn');
Router::get('categories/{id}', [CategoryController::class, 'show'])->middleware('isLoggedIn');
Router::get('categories/create', [CategoryController::class, 'create'])->middleware('isLoggedIn');
Router::post('categories/create', [CategoryController::class, 'store'])->middleware('isLoggedIn');
Router::get('categories/edit/{id}', [CategoryController::class, 'edit'])->middleware('isLoggedIn');
Router::post('categories/edit/{id}', [CategoryController::class, 'update'])->middleware('isLoggedIn');
Router::post('categories/delete/{id}', [CategoryController::class, 'delete'])->middleware('isLoggedIn');

// Recipes
Router::get('recipes', [RecipeController::class, 'index'])->middleware('isLoggedIn');
Router::get('recipes/{id}', [RecipeController::class, 'show'])->middleware('isLoggedIn');
Router::get('recipes/create', [RecipeController::class, 'create'])->middleware('isLoggedIn');
Router::post('recipes/create', [RecipeController::class, 'store'])->middleware('isLoggedIn');
Router::get('recipes/edit/{id}', [RecipeController::class, 'edit'])->middleware('isLoggedIn');
Router::post('recipes/edit/{id}', [RecipeController::class, 'update'])->middleware('isLoggedIn');
Router::post('recipes/delete/{id}', [RecipeController::class, 'delete'])->middleware('isLoggedIn');

// User 
Router::get('profile', [UserController::class, 'profile'])->middleware('isLoggedIn');
Router::post('profile/update', [UserController::class, 'updateProfile'])->middleware('isLoggedIn');
Router::post('profile/change-password', [UserController::class, 'changePassword'])->middleware('isLoggedIn');


// Start the router
Router::match();
