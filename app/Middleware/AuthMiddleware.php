<?php

namespace App\Middleware;

use App\Repositories\RegisteredUsersRepository;

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
            $user =$this->registeredUsersRepository->selectByEmail($_POST['email']);
            if (!empty($user)){
                $hash = $user[0]['password'];
            }else{
                $hash = '';
            }
            if (!empty($this->registeredUsersRepository->selectByEmail($_POST['email']))
            && password_verify($_POST['password'],$hash)) {
                header('Location: mainMenu');
            }

        }
    }
}