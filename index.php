<?php
 
declare(strict_types=1);

$uri = $_SERVER['REQUEST_URI'];

require_once __DIR__ . '/bootstrap.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\ErrorHandler\Debug;
use League\Route\Http\Exception\NotFoundException;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\RedirectResponse;

Debug::enable();

if(str_contains($uri, '.css') || str_contains($uri, '.js') || str_contains($uri, '.png') || str_contains($uri, '.jpg') || str_contains($uri, '.jpeg') || str_contains($uri, '.gif') || str_contains($uri, '.webp')) {
    return false;
}

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

session_start();

$router = new League\Route\Router;

// default routes 
$router->map('GET', '/', App\Controller\HomeController::class);
$router->map('GET', '/404', [App\Controller\HomeController::class, 'error']);

// routes
$router->map('GET', '/contact', [App\Controller\HomeController::class, 'contact']);
$router->map('POST', '/contact', [App\Controller\HomeController::class, 'contact']);
$router->map('GET', '/about', [App\Controller\HomeController::class, 'about']);

// schedule routes
$router->map('GET', '/schedule', [App\Controller\HomeController::class, 'schedule']);
$router->map('POST', '/schedule', [App\Controller\HomeController::class, 'schedule']);

// login and registration routes
$router->map('GET', '/login', [App\Controller\HomeController::class, 'login']);
$router->map('POST', '/login', [App\Controller\HomeController::class, 'login']);
$router->map('GET', '/registration', [App\Controller\HomeController::class, 'registration']);
$router->map('POST', '/registration', [App\Controller\HomeController::class, 'registration']);

// profile routes
$router->map('GET', '/profile', [App\Controller\HomeController::class, 'profile']);
$router->map('POST', '/profile', [App\Controller\HomeController::class, 'profile']);
$router->map('GET', '/profile/reset-password', [App\Controller\HomeController::class, 'resetPassword']);
$router->map('POST', '/profile/reset-password', [App\Controller\HomeController::class, 'resetPassword']);
$router->map('GET', '/logout', [App\Controller\HomeController::class, 'logout']);

// admin panel routes
$router->map('GET', '/admin-panel', App\Controller\AdminPanelController::class);
$router->map('POST', '/admin-panel', App\Controller\AdminPanelController::class);
$router->map('GET', '/admin-panel/workouts', [App\Controller\AdminPanelController::class, 'workouts']);
$router->map('POST', '/admin-panel/workouts', [App\Controller\AdminPanelController::class, 'workouts']);
$router->map('GET', '/admin-panel/workouts/search', [App\Controller\AdminPanelController::class, 'searchWorkouts']);
$router->map('GET', '/admin-panel/workouts/add', [App\Controller\AdminPanelController::class, 'addWorkout']);
$router->map('GET', '/admin-panel/workouts/delete', [App\Controller\AdminPanelController::class, 'deleteWorkout']);
$router->map('GET', '/admin-panel/workouts/edit', [App\Controller\AdminPanelController::class, 'showEditedWorkout']);
$router->map('POST', '/admin-panel/workouts/edit/confirm', [App\Controller\AdminPanelController::class, 'editWorkout']);
$router->map('GET', '/admin-panel/users', [App\Controller\AdminPanelController::class, 'users']);
$router->map('POST', '/admin-panel/users', [App\Controller\AdminPanelController::class, 'users']);
$router->map('GET', '/admin-panel/users/search', [App\Controller\AdminPanelController::class, 'searchUsers']);
$router->map('GET', '/admin-panel/users/delete', [App\Controller\AdminPanelController::class, 'deleteUser']);
$router->map('GET', '/admin-panel/users/edit', [App\Controller\AdminPanelController::class, 'showEditedUser']);
$router->map('POST', '/admin-panel/users/edit/confirm', [App\Controller\AdminPanelController::class, 'editUser']);
$router->map('GET', '/admin-panel/users/edit/confirm', [App\Controller\AdminPanelController::class, 'editUser']);
$router->map('GET', '/admin-panel/trainers', [App\Controller\AdminPanelController::class, 'trainers']);
$router->map('POST', '/admin-panel/trainers', [App\Controller\AdminPanelController::class, 'trainers']);
$router->map('GET', '/admin-panel/subscriptions', [App\Controller\AdminPanelController::class, 'subscriptions']);
$router->map('POST', '/admin-panel/subscriptions', [App\Controller\AdminPanelController::class, 'subscriptions']);

// purchases routes
$router->map('GET', '/purchase', [App\Controller\HomeController::class, 'purchase']);
$router->map('POST', '/purchase', [App\Controller\HomeController::class, 'purchase']);



try {
    $response = $router->dispatch($request);
} catch (NotFoundException $e) {
    $response = new RedirectResponse('/404');
}

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);