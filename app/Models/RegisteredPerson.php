<?php
namespace App\Models;

class RegisteredPerson
{
    private $name;
    private $surname;
    private $gender;
    private $email;
    private $birthYear;
    private $password;

    public function __construct($name, $surname, $gender,$email, $birthYear, $password)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->gender = $gender;
        $this->email = $email;
        $this->birthYear = $birthYear;
        $this->password = $password;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function getGender()
    {
        return $this->gender;
    }
    public function getBirthYear()
    {
        return $this->birthYear;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getEmail()
    {
        return $this->email;
    }
}