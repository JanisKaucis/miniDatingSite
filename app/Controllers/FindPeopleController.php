<?php
namespace App\Controllers;

use Twig\Environment;

class FindPeopleController
{
    private Environment $twig;
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
    public function showPeople()
    {
        echo $this->twig->render('FindPeopleView.twig');
    }
}