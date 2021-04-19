<?php
namespace App\Models;

class RegisteredPerson
{
    private string $name;
    private string $surname;
    private string $gender;
    private string $email;
    private string $image;
    private string $birthYear;
    private string $password;

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

    public function getName():string
    {
        return $this->name;
    }
    public function getSurname():string
    {
        return $this->surname;
    }
    public function getGender():string
    {
        return $this->gender;
    }
    public function getImage():string
    {
        return $this->image;
    }
    public function getBirthYear():string
    {
        return $this->birthYear;
    }
    public function getPassword():string
    {
        return $this->password;
    }
    public function getEmail():string
    {
        return $this->email;
    }
}