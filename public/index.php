<?php
require_once '../vendor/autoload.php';
session_start();

require_once '../app/Bootstrap/Twig.php';
require_once '../app/Bootstrap/Router.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['register'])){
    unset($_SESSION['register']);
}