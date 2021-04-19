<?php
namespace App\Repositories;

use App\Models\RegisteredPerson;

interface RegisteredUsersRepository
{
    public function addUser(RegisteredPerson $registeredPerson):void;
    public function selectByEmail($email):array;
    public function selectByEmailAndPassword($email,$password):array;
    public function selectByGender($gender):array;
}