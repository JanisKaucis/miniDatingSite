<?php
namespace App\Repositories;

use App\Models\RegisteredPerson;

interface RegisteredUsersRepository
{
    public function addUser(RegisteredPerson $registeredPerson);
}