<?php

namespace App\Controllers;

use App\Services\RegisterService;
use Twig\Environment;

class RegisterController
{
    private Environment $twig;
    private RegisterService $registerService;

    public function __construct(RegisterService $registerService, Environment $twig)
    {
        $this->registerService = $registerService;
        $this->twig = $twig;
    }
    public function register()
    {
        $this->registerService->setRegisteredPerson();
        echo $this->twig->render('RegisterView.twig', $this->registerService->getContext());
    }
}