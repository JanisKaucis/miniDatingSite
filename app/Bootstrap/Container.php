<?php

use App\Controllers\IndexController;
use App\Repositories\MysqlRegisteredUsers;
use App\Repositories\RegisteredUsersRepository;
use App\Services\RegisterService;
use App\Validation\Validator;
use App\Validation\ValidatorInterface;
use League\Container\Container;
require_once 'Twig.php';

$container = new Container();

$container->add(RegisteredUsersRepository::class, MysqlRegisteredUsers::class);
$container->add(ValidatorInterface::class, Validator::class);

$container->add(RegisterService::class,RegisterService::class)
    ->addArguments([RegisteredUsersRepository::class, ValidatorInterface::class]);

$container->add(IndexController::class,IndexController::class)
->addArguments([RegisterService::class,ValidatorInterface::class, $twig]);