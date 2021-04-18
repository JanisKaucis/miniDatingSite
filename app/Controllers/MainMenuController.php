<?php

namespace App\Controllers;

use Twig\Environment;

class MainMenuController
{
    private Environment $twig;
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
    public function mainMenu()
    {
        echo $this->twig->render('MainMenuView.twig');
    }
}