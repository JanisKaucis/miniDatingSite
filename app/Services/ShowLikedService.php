<?php
namespace App\Services;

use App\Repositories\RegisteredUsersRepository;

class ShowLikedService
{
    private RegisteredUsersRepository $registeredUsersRepository;
    private array $context;
    private array $likedUsers = [];

    public function __construct(RegisteredUsersRepository $registeredUsersRepository)
    {
        $this->registeredUsersRepository = $registeredUsersRepository;
    }

    public function showLiked()
    {
        $user = $this->registeredUsersRepository->selectByEmail($_SESSION['login']['email']);
        $userEmail = $user[0]['email'];
        $likedPersonString = file_get_contents('Storage/likedPersons.json');
        $likedPersonArray = json_decode($likedPersonString, true);
            foreach ($likedPersonArray as $likedPerson) {
                if ($likedPerson['userEmail'] == $userEmail) {
                    $this->likedUsers[] = $likedPerson['likedUsers'];
                }
            }
        $this->context = [
            'likedUsers' => $this->likedUsers
        ];
    }

    public function getContext(): array
    {
        return $this->context;
    }
}