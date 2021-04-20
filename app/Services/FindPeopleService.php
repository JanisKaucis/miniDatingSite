<?php

namespace App\Services;

use App\Models\DislikedPerson;
use App\Models\LikedPerson;
use App\Repositories\RegisteredUsersRepository;

class FindPeopleService
{
    private RegisteredUsersRepository $registeredUsersRepository;
    private array $context;

    public function __construct(RegisteredUsersRepository $registeredUsersRepository)
    {
        $this->registeredUsersRepository = $registeredUsersRepository;
    }

    public function showOppositeSex()
    {
        $user = $this->registeredUsersRepository->selectByEmail($_SESSION['login']['email']);
        $userEmail = $user[0]['email'];
        $date = date('Y');

        if ($user[0]['gender'] == 'male') {
            $gender = 'female';
        } else {
            $gender = 'male';
        }
        $likedPersonString = file_get_contents('Storage/likedPersons.json');
        $likedPersonArray = json_decode($likedPersonString, true);
        $dislikedPersonString = file_get_contents('Storage/dislikedPersons.json');
        $dislikedPersonArray = json_decode($dislikedPersonString, true);
        if (isset($_POST['findPeople'])) {
            file_put_contents('Storage/persons.json','');

            $oppositeUsers = $this->registeredUsersRepository->selectByGender($gender);
            shuffle($oppositeUsers);
            if (!empty($likedPersonArray)) {
                foreach ($likedPersonArray as $likedUser) {
                    if ($userEmail == $likedUser['userEmail']) {
                        foreach ($oppositeUsers as $key => $oppositeUser) {
                            if ($oppositeUser['email'] == $likedUser['likedUsers']['email']) {
                                unset($oppositeUsers[$key]);
                            }
                        }
                    }
                }
            }
            if (!empty($dislikedPersonArray)) {
                foreach ($dislikedPersonArray as $dislikedUser) {
                    if ($userEmail == $dislikedUser['userEmail']) {
                        foreach ($oppositeUsers as $key => $oppositeUser) {
                            if ($oppositeUser['email'] == $dislikedUser['dislikedUsers']['email']) {
                                unset($oppositeUsers[$key]);
                            }
                        }
                    }
                }
            }
            if (!empty($oppositeUsers)) {
                $file = fopen('Storage/persons.json', 'w');
                fwrite($file, json_encode($oppositeUsers));
                fclose($file);
            }
        }

        $PersonString = file_get_contents('Storage/persons.json');
        $people = json_decode($PersonString, true);
        if (!empty($people)) {
            if (isset($_POST['like'])) {

                $likedPerson = new LikedPerson($userEmail, $people[0]);
                $likedPerson = get_object_vars($likedPerson);

                if (!empty($likedPersonString)) {

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
            if (isset($_POST['dislike'])) {

                $dislikedPerson = new DislikedPerson($userEmail, $people[0]);
                $dislikedPerson = get_object_vars($dislikedPerson);

                if (!empty($dislikedPersonString)) {

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
            $error = '';
        } else {
            $people[0]['picture_path'] = 'default.png';
            $error = 'No more people to show';
        }
        $this->context = [
            'date' => $date,
            'person' => $people[0],
            'error' => $error
        ];
    }

    public function getContext(): array
    {
        return $this->context;
    }
}