<?php
require_once '../vendor/autoload.php';
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL );
//& ~E_NOTICE
require_once '../app/Bootstrap/Twig.php';
require_once '../app/Bootstrap/Router.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['register'])){
    unset($_SESSION['register']);
}