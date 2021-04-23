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
        $userInfo = $this->registeredUsersRepository->selectByEmail($_SESSION['login']['email']);
        $userName = $userInfo[0]['name'];
        $userSurname = $userInfo[0]['surname'];
        $userGender = $userInfo[0]['gender'];
        $userAge = 2020 - $userInfo[0]['birth_year'];
        $userImagePath = 'Pictures/'.$userInfo[0]['picture_path'];

        $this->context = [
            'name' => $userName,
            'surname' => $userSurname,
            'age' => $userAge,
            'picture' => $userImagePath,
            'gender' => $userGender
        ];
    }
    public function getContext()
    {
        return $this->context;
    }
}