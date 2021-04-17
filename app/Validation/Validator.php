<?php

namespace App\Validation;

class Validator implements ValidatorInterface
{
    private $name;
    private $surname;
    private $email;
    private $password;
    private $gender;
    private $birthYear;
    private $nameErr = '';
    private $surnameErr = '';
    private $passwordErr = '';
    private $password2Err = '';
    private $emailErr = '';

    public function inputRefactor($data): string
    {
//        $data = trim($data);
//        $data = htmlspecialchars($data);
        return $data;
    }

    public function validateRegisterForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['name'])) {
                $this->nameErr = 'Name is required';
            } else {
                $this->name = $this->inputRefactor($_POST['name']);
            }
            if (empty($_POST['surname'])) {
                $this->surnameErr = 'Surname is required';
            } else {
                $this->surname = $this->inputRefactor($_POST['surname']);
            }
            if (empty($_POST['password'])) {
                $this->passwordErr = 'Password is required';
            }
            if (empty($_POST['password2'])) {
                $this->password2Err = 'Repeat password is required';
            }
            if (empty($_POST['email'])) {
                $this->emailErr = "Email is required";
            } else {
                $this->email = $this->inputRefactor($_POST['email']);
            }
            if ($_POST['password'] != $_POST['password2']) {
                $this->passwordErr = 'Passwords dont match';
            } else {
                $this->password = $this->inputRefactor($_POST['password']);
            }
            $this->gender = $this->inputRefactor($_POST['gender']);
            $this->birthYear = $this->inputRefactor($_POST['birthYear']);
        }
    }
    public function getName()
    {
        return $this->name;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getGender()
    {
        return $this->gender;
    }
    public function getBirthYear()
    {
        return $this->birthYear;
    }
    public function getNameErr()
    {
        return $this->nameErr;
    }
    public function getSurnameErr()
    {
        return $this->surnameErr;
    }
    public function getEmailErr()
    {
        return $this->emailErr;
    }
    public function getPasswordErr()
    {
        return $this->passwordErr;
    }
    public function getPassword2Err()
    {
        return $this->password2Err;
    }
}