<?php

namespace App\Controllers;

use App\Services\ShowLikedService;
use Twig\Environment;

class ShowLikedController
{
    private Environment $twig;
    private ShowLikedService $showLikedService;

    public function __construct(Environment $twig,ShowLikedService $showLikedService)
    {
        $this->twig = $twig;
        $this->showLikedService = $showLikedService;
    }

    public function showLiked()
    {
        $this->showLikedService->showLiked();
        echo $this->twig->render('ShowLikedView.twig',$this->showLikedService->getContext());
    }
}