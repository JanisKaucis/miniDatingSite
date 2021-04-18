<?php

namespace App\Controllers;

use App\Services\LoginService;
use Twig\Environment;

class LoginController
{
    private Environment $twig;
    private LoginService $loginService;

    public function __construct(Environment $twig,LoginService $loginService)
    {
        $this->twig = $twig;
        $this->loginService = $loginService;
    }
    public function login()
    {
        $this->loginService->login();
        echo $this->twig->render('LoginView.twig',$this->loginService->getContext());
    }

}