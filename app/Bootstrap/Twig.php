<?php

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;


$loader = new FilesystemLoader('../app/Views');
$twig = new Environment($loader, [
    'debug' => true
]);
$twig->addExtension(new DebugExtension());





