<?php

namespace App\Services;

use App\Models\DislikedPerson;
use App\Models\LikedPerson;
use App\Repositories\RegisteredUsersRepository;
use Twig\Environment;

class FindPeopleService
{
    private RegisteredUsersRepository $registeredUsersRepository;
    private array $context;
    private array $oppositeUsers;

    public function __construct(RegisteredUsersRepository $registeredUsersRepository)
    {
        $this->registeredUsersRepository = $registeredUsersRepository;
    }

    public function showOppositeSex()
    {
        $user = $this->registeredUsersRepository->selectByEmail($_SESSION['login']['email']);
        $userEmail = $user[0]['email'];
        if ($user[0]['gender'] == 'male') {
            $gender = 'female';
        } else {
            $gender = 'male';
        }
        if (isset($_POST['findPeople'])) {
            $this->oppositeUsers = $this->registeredUsersRepository->selectByGender($gender);
            shuffle($this->oppositeUsers);
        }
        $date = date('Y');

        if (isset($_POST['findPeople'])){
            $file = fopen('Storage/persons.json', 'w');
            fwrite($file, json_encode($this->oppositeUsers));
            fclose($file);
        }
        $PersonString = file_get_contents('Storage/persons.json');
        $people = json_decode($PersonString,true);
        if (!empty($people)) {
        if (isset($_POST['like']) ) {
            $likedPersonString = file_get_contents('Storage/likedPersons.json');

                $likedPerson = new LikedPerson($userEmail, $people[0]);
                if (!empty($likedPersonString)) {
                    $likedPersonArray = json_decode($likedPersonString, true);
                    $fileToEncode = array_merge($likedPersonArray, [$likedPerson]);
                } else {
                    $fileToEncode = [$likedPerson];
                }
                $file = fopen('Storage/likedPersons.json', 'w');
                fwrite($file, json_encode($fileToEncode));
                fclose($file);
                unset($people[0]);
                $file = fopen('Storage/persons.json', 'w');
                $people = array_values($people);
                fwrite($file, json_encode($people));
                fclose($file);
                header('Location: findPeople');
            }
        if (isset($_POST['dislike']) ) {
            $dislikedPersonString = file_get_contents('Storage/dislikedPersons.json');
                $dislikedPerson = new DislikedPerson($userEmail, $people[0]);
                if (!empty($dislikedPersonString)) {
                    $dislikedPersonArray = json_decode($dislikedPersonString, true);
                    $fileToEncode = array_merge($dislikedPersonArray, [$dislikedPerson]);
                } else {
                    $fileToEncode = [$dislikedPerson];
                }
                $file = fopen('Storage/dislikedPersons.json', 'w');
                fwrite($file, json_encode($fileToEncode));
                fclose($file);
                unset($people[0]);
                $file = fopen('Storage/persons.json', 'w');
                $people = array_values($people);
                fwrite($file, json_encode($people));
                fclose($file);
                header('Location: findPeople');
            }
        }
        if (empty($people[0])){
            $people[0]['picture_path'] = 'default.png';
            $error = 'No more people to show';
        }else {
             $error = '';
        }
        $this->context = [
            'date' => $date,
            'person' => $people[0],
            'error' => $error
        ];

    }
    public function showLiked()
    {
//        foreach ($likedPersonArray as $user){
//                    var_dump($user['userEmail']);
//            if ($user['userEmail'] == $_SESSION['login']['email']){
//                var_dump($user);
//            }
//        }
    }


    public function getContext(): array
    {
        return $this->context;
    }
}