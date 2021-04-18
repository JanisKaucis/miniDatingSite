<?php
namespace App\Models;

class RegisteredPerson
{
    private $name;
    private $surname;
    private $gender;
    private $email;
    private $image;
    private $birthYear;
    private $password;

    public function __construct($name, $surname, $gender,$email,$image, $birthYear, $password)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->gender = $gender;
        $this->email = $email;
        $this->image = $image;
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
    public function getImage()
    {
        return $this->image;
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