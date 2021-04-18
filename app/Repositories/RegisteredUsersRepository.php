<?php
namespace App\Repositories;

use App\Models\RegisteredPerson;

interface RegisteredUsersRepository
{
    public function addUser(RegisteredPerson $registeredPerson);
    public function selectByEmail($email):array;
    public function selectByEmailAndPassword($email,$password):array;
}