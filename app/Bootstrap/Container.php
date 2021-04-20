<?php

use App\Controllers\FindPeopleController;
use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\MainMenuController;
use App\Controllers\RegisterController;
use App\Controllers\ShowLikedController;
use App\Repositories\MysqlRegisteredUsers;
use App\Repositories\RegisteredUsersRepository;
use App\Services\FindPeopleService;
use App\Services\LoginService;
use App\Services\MainMenuService;
use App\Services\RegisterService;
use App\Services\ShowLikedService;
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
$container->add(MainMenuService::class,MainMenuService::class)
    ->addArguments([RegisteredUsersRepository::class]);
$container->add(FindPeopleService::class,FindPeopleService::class)
    ->addArguments([RegisteredUsersRepository::class]);
$container->add(ShowLikedService::class,ShowLikedService::class)
    ->addArguments([RegisteredUsersRepository::class]);

$container->add(IndexController::class,IndexController::class)
->addArgument($twig);
$container->add(RegisterController::class,RegisterController::class)
    ->addArguments([RegisterService::class,$twig]);
$container->add(LoginController::class,LoginController::class)
    ->addArguments([$twig,LoginService::class]);
$container->add(MainMenuController::class,MainMenuController::class)
    ->addArguments([$twig, MainMenuService::class]);
$container->add(FindPeopleController::class,FindPeopleController::class)
    ->addArguments([$twig, FindPeopleService::class]);
$container->add(ShowLikedController::class,ShowLikedController::class)
    ->addArguments([$twig,ShowLikedService::class]);
$container->add(LogoutController::class,LogoutController::class);