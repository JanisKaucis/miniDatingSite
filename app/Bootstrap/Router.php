<?php

use App\Controllers\FindPeopleController;
use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\MainMenuController;
use App\Controllers\RegisterController;
use App\Controllers\ShowLikedController;
use App\Middleware\AuthMiddleware;
use App\Repositories\RegisteredUsersRepository;

require_once 'Container.php';


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    //routes
    $r->addRoute('GET','/', [IndexController::class,'StartMenu']);
    $r->addRoute(['GET','POST'],'/login',[LoginController::class,'login']);
    $r->addRoute(['GET','POST'],'/register',[RegisterController::class,'register']);
    $r->addRoute(['GET','POST'],'/mainMenu',[MainMenuController::class,'mainMenu']);
    $r->addRoute(['GET','POST'],'/findPeople',[FindPeopleController::class,'showPeople']);
    $r->addRoute(['GET','POST'],'/showLiked',[ShowLikedController::class,'showLiked']);
});
//Middleware
$middlewares = [
LoginController::class.'@login' =>[
    AuthMiddleware::class
    ]
];

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controller,$method] = $handler;

        $controllerMiddlewares = [];
        $middlewareKey = $controller.'@'.$method;
        $controllerMiddlewares = $middlewares[$middlewareKey] ?? [];
        foreach ($controllerMiddlewares as $controllerMiddleware) {
            (new $controllerMiddleware($container->get(RegisteredUsersRepository::class)))->handleAuth();
        }
        // ... call $handler with $vars
        echo $container->get($controller)->$method($vars);
        break;
}