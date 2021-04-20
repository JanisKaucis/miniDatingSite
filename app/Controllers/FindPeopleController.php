<?php
namespace App\Controllers;

use App\Services\FindPeopleService;
use Twig\Environment;

class FindPeopleController
{
    private Environment $twig;
    private FindPeopleService $findPeopleService;

    public function __construct(Environment $twig, FindPeopleService $findPeopleService)
    {
        $this->twig = $twig;
        $this->findPeopleService = $findPeopleService;
    }
    public function showPeople()
    {
        $this->findPeopleService->showOppositeSex();
        $this->findPeopleService->likeUser();
        $this->findPeopleService->dislikeUser();

        echo $this->twig->render('FindPeopleView.twig',$this->findPeopleService->getContext());
    }
}