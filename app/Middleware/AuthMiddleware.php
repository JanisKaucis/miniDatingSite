<?php

namespace App\Middleware;

use App\Repositories\RegisteredUsersRepository;
use App\Services\LoginService;

class AuthMiddleware implements MiddlewareInterface
{
    private RegisteredUsersRepository $registeredUsersRepository;

    public function __construct(RegisteredUsersRepository $registeredUsersRepository)
    {
        $this->registeredUsersRepository = $registeredUsersRepository;
    }

    public function handleAuth()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($this->registeredUsersRepository->selectByEmailAndPassword($_POST['email'], $_POST['password']))) {
                header('Location: mainMenu');
            }

        }
    }
}