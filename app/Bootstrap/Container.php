<?php

use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\MainMenuController;
use App\Controllers\RegisterController;
use App\Middleware\AuthMiddleware;
use App\Middleware\MiddlewareInterface;
use App\Repositories\MysqlRegisteredUsers;
use App\Repositories\RegisteredUsersRepository;
use App\Services\LoginService;
use App\Services\RegisterService;
use App\Validation\LoginValidator;
use App\Validation\LoginValidatorInterface;
use App\Validation\RegisterValidator;
use App\Validation\RegisterValidatorInterface;
use League\Container\Container;
require_once 'Twig.php';

$container = new Container();

$container->add(RegisteredUsersRepository::class, MysqlRegisteredUsers::class);
$container->add(RegisterValidatorInterface::class, RegisterValidator::class)
->addArgument(RegisteredUsersRepository::class);
$container->add(LoginValidatorInterface::class, LoginValidator::class)
    ->addArgument(RegisteredUsersRepository::class);

$container->add(RegisterService::class,RegisterService::class)
    ->addArguments([RegisteredUsersRepository::class, RegisterValidatorInterface::class]);
$container->add(LoginService::class,LoginService::class)
    ->addArgument(LoginValidatorInterface::class);
$container->add(MiddlewareInterface::class,AuthMiddleware::class)
    ->addArgument(RegisteredUsersRepository::class);

$container->add(IndexController::class,IndexController::class)
->addArgument($twig);
$container->add(RegisterController::class,RegisterController::class)
    ->addArguments([RegisterService::class,$twig]);
$container->add(LoginController::class,LoginController::class)
    ->addArguments([$twig,LoginService::class]);

$container->add(MainMenuController::class,MainMenuController::class)
    ->addArguments([$twig]);