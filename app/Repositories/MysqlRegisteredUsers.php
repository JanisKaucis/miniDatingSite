<?php

namespace App\Repositories;

use App\Models\RegisteredPerson;
use App\Services\RegisterService;
use Medoo\Medoo;

class MysqlRegisteredUsers implements RegisteredUsersRepository
{
    public Medoo $database;
    public function __construct()
    {
        $this->database = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'mini_dating_site',
            'server' => 'localhost',
            'username' => 'root',
            'password' => ''
        ]);
    }
    public function addUser(RegisteredPerson $person)
    {
        $this->database->insert('registered_users',['name' => $person->getName(),
            'surname' => $person->getSurname(),'gender' => $person->getGender(),'email' => $person->getEmail(),
            'birth_year' => $person->getBirthYear(),'password' => $person->getPassword()]);
    }
}