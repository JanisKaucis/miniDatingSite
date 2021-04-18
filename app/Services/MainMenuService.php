<?php
namespace App\Services;

use App\Repositories\RegisteredUsersRepository;

class MainMenuService
{
    private RegisteredUsersRepository $registeredUsersRepository;
    private $context;

    public function __construct(RegisteredUsersRepository $registeredUsersRepository)
    {
        $this->registeredUsersRepository = $registeredUsersRepository;
    }

    public function showUser()
    {
        $user = $this->registeredUsersRepository->selectByEmail($_SESSION['login']['email']);
        $userName = $user[0]['name'];
        $this->context = [
            'name' => $userName
        ];
    }
    public function getContext()
    {
        return $this->context;
    }
}