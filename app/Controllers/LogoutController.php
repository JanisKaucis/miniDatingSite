<?php
namespace App\Controllers;

class LogoutController
{
    public function logout()
    {
        if (isset($_SESSION['login']))
        {
            unset($_SESSION['login']);
        }
        header("Location: /");
    }
}