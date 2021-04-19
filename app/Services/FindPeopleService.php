<?php

namespace App\Services;

use App\Repositories\RegisteredUsersRepository;

class FindPeopleService
{
    private RegisteredUsersRepository $registeredUsersRepository;

    public function __construct(RegisteredUsersRepository $registeredUsersRepository)
    {
        $this->registeredUsersRepository = $registeredUsersRepository;
    }

    public function showOppositeSex()
    {
        $user = $this->registeredUsersRepository->selectByEmail($_SESSION['login']['email']);
        if ($user[0]['gender'] == 'male'){
            $gender = 'female';
        }else {
            $gender = 'male';
        }
        $oppositeUser = $this->registeredUsersRepository->selectByGender($gender);
        var_dump($oppositeUser);
        $context = [
            'name' => $oppositeUser
        ];
    }
}