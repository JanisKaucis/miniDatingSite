<?php

namespace App\Controllers;

use Twig\Environment;

class IndexController
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function StartMenu()
    {
        echo $this->twig->render('StartMenu.twig');
    }
}