<?php

namespace App\Controllers;

use App\Services\MainMenuService;
use Twig\Environment;

class MainMenuController
{
    private Environment $twig;
    private MainMenuService $mainMenuService;
    public function __construct(Environment $twig,MainMenuService $mainMenuService)
    {
        $this->twig = $twig;
        $this->mainMenuService = $mainMenuService;
    }
    public function mainMenu()
    {
        $this->mainMenuService->showUser();
        echo $this->twig->render('MainMenuView.twig', $this->mainMenuService->getContext());
    }
}