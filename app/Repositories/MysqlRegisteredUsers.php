<?php

namespace App\Repositories;

use App\Models\RegisteredPerson;
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
    public function selectByEmail($email):array
    {
        return $this->database->select('registered_users',['name','surname','gender','email','birth_year'],
            ['email' => $email]);
    }
    public function selectByEmailAndPassword($email,$password):array
    {
        return $this->database->select('registered_users',['name','surname','gender','birth_year'],['email' => $email,
            'password' => $password]);
    }
}