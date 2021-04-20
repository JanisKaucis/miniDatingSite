<?php

namespace App\Services;

use App\Models\DislikedPerson;
use App\Models\LikedPerson;
use App\Repositories\RegisteredUsersRepository;

class FindPeopleService
{
    private RegisteredUsersRepository $registeredUsersRepository;
    private array $context;
    private string $userEmail;
    private $people;
    private array $likedPersonArray;
    private array $dislikedPersonArray;

    public function __construct(RegisteredUsersRepository $registeredUsersRepository)
    {
        $this->registeredUsersRepository = $registeredUsersRepository;
    }

    public function showOppositeSex()
    {
        $user = $this->registeredUsersRepository->selectByEmail($_SESSION['login']['email']);
        $this->userEmail = $user[0]['email'];
        $date = date('Y');

        if ($user[0]['gender'] == 'male') {
            $gender = 'female';
        } else {
            $gender = 'male';
        }
        $likedPersonString = file_get_contents('Storage/likedPersons.json');
        $this->likedPersonArray = json_decode($likedPersonString, true);
        $dislikedPersonString = file_get_contents('Storage/dislikedPersons.json');
        $this->dislikedPersonArray = json_decode($dislikedPersonString, true);
        if (isset($_POST['findPeople'])) {
            file_put_contents('Storage/persons.json', '');

            $oppositeUsers = $this->registeredUsersRepository->selectByGender($gender);
            shuffle($oppositeUsers);
            if (!empty($this->likedPersonArray)) {
                foreach ($this->likedPersonArray as $likedUser) {
                    if ($this->userEmail == $likedUser['userEmail']) {
                        foreach ($oppositeUsers as $key => $oppositeUser) {
                            if ($oppositeUser['email'] == $likedUser['likedUsers']['email']) {
                                unset($oppositeUsers[$key]);
                            }
                        }
                    }
                }
            }
            if (!empty($this->dislikedPersonArray)) {
                foreach ($this->dislikedPersonArray as $dislikedUser) {
                    if ($this->userEmail == $dislikedUser['userEmail']) {
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
        $this->people = json_decode($PersonString, true);
        if (!empty($this->people)) {
            $error = '';
        } else {
            $this->people[0]['picture_path'] = 'default.png';
            $error = 'No more people to show';
        }
        $this->context = [
            'date' => $date,
            'person' => $this->people[0],
            'error' => $error
        ];
    }

    public function likeUser()
    {
        if (isset($_POST['like'])) {

            $likedPerson = new LikedPerson($this->userEmail, $this->people[0]);
            $likedPerson = get_object_vars($likedPerson);

            if (!empty($likedPersonString)) {

                $LikedFileToEncode = array_merge($this->likedPersonArray, [$likedPerson]);
            } else {
                $LikedFileToEncode = [$likedPerson];
            }
            $likedFile = fopen('Storage/likedPersons.json', 'w');
            fwrite($likedFile, json_encode($LikedFileToEncode));
            fclose($likedFile);
            unset($this->people[0]);
            $file = fopen('Storage/persons.json', 'w');
            $this->people = array_values($this->people);
            fwrite($file, json_encode($this->people));
            fclose($file);
            header('Location: findPeople');
        }
    }

    public function dislikeUser()
    {
        if (isset($_POST['dislike'])) {

            $dislikedPerson = new DislikedPerson($this->userEmail, $this->people[0]);
            $dislikedPerson = get_object_vars($dislikedPerson);

            if (!empty($dislikedPersonString)) {

                $dislikedFileToEncode = array_merge($this->dislikedPersonArray, [$dislikedPerson]);
            } else {
                $dislikedFileToEncode = [$dislikedPerson];
            }
            $dislikedFile = fopen('Storage/dislikedPersons.json', 'w');
            fwrite($dislikedFile, json_encode($dislikedFileToEncode));
            fclose($dislikedFile);
            unset($this->people[0]);
            $file = fopen('Storage/persons.json', 'w');
            $this->people = array_values($this->people);
            fwrite($file, json_encode($this->people));
            fclose($file);
            header('Location: findPeople');
        }
    }

    public function getContext(): array
    {
        return $this->context;
    }
}