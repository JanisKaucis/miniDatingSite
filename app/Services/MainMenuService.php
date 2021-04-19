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
        $userAge = 2020 - $userInfo[0]['birth_year'];
        $userImagePath = 'Pictures/'.$userInfo[0]['picture_path'];
//        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            $_SESSION['login']['findPeople'] = $_POST['findPeople'];
//        }
        $this->context = [
            'name' => $userName,
            'surname' => $userSurname,
            'age' => $userAge,
            'picture' => $userImagePath
        ];
    }
    public function getContext()
    {
        return $this->context;
    }
}