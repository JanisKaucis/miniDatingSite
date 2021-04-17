<?php

namespace App\Controllers;

use App\Services\RegisterService;
use App\Validation\Validator;
use Twig\Environment;

class IndexController
{
    private Environment $twig;
    private RegisterService $registerService;
    private Validator $validator;

    public function __construct(RegisterService $registerService, Validator $validator, Environment $twig)
    {
        $this->registerService = $registerService;
        $this->validator = $validator;
        $this->twig = $twig;
    }

    public function StartMenu()
    {
        echo $this->twig->render('StartMenu.twig');
    }

    public function login()
    {
        echo $this->twig->render('Login.twig');
    }

    public function register()
    {
        $this->registerService->setRegisteredPerson();

        echo $this->twig->render('RegisterView.twig', $this->registerService->getContext());
    }
}