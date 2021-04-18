<?php

namespace App\Validation;

use App\Repositories\RegisteredUsersRepository;

class RegisterValidator implements RegisterValidatorInterface
{
    private string $name = '';
    private string $surname = '';
    private string $email = '';
    private string $password = '';
    private string $gender = '';
    private string $birthYear = '';
    private string $nameErr = '';
    private string $surnameErr = '';
    private string $passwordErr = '';
    private string $password2Err = '';
    private string $emailErr = '';
    private RegisteredUsersRepository $registeredUsersRepository;

    public function __construct(RegisteredUsersRepository $registeredUsersRepository)
    {
        $this->registeredUsersRepository = $registeredUsersRepository;
    }

    public function inputRefactor($data): string
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function validateRegisterForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['register']['name'] = $_POST['name'];
            $_SESSION['register']['surname'] = $_POST['surname'];
            $_SESSION['register']['password'] = $_POST['password'];
            $_SESSION['register']['email'] = $_POST['email'];
            $_SESSION['register']['gender'] = $_POST['gender'];
            $_SESSION['register']['birthYear'] = $_POST['birthYear'];

            if (empty($_POST['name'])) {
                $this->nameErr = 'Name is required';
            } else {
                $this->name = $this->inputRefactor($_SESSION['register']['name']);
            }
            if (empty($_POST['surname'])) {
                $this->surnameErr = 'Surname is required';
            } else {
                $this->surname = $this->inputRefactor($_SESSION['register']['surname']);
            }
            if (empty($_POST['password'])) {
                $this->passwordErr = 'Password is required';
            }
            if (empty($_POST['password2'])) {
                $this->password2Err = 'Repeat password is required';
            }
            if (empty($_POST['email'])) {
                $this->emailErr = "Email is required";
            }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $this->emailErr = 'Invalid Email';
            } elseif (!empty($this->registeredUsersRepository->selectByEmail($_POST['email']))){
                $this->emailErr = 'This email is already used';
            }else {
                $this->email = $this->inputRefactor($_SESSION['register']['email']);
            }
            if ($_POST['password'] != $_POST['password2']) {
                $this->passwordErr = 'Passwords dont match';
            } else {
                $this->password = $this->inputRefactor($_SESSION['register']['password']);
            }
            $this->gender = $this->inputRefactor($_SESSION['register']['gender']);
            $this->birthYear = $this->inputRefactor($_SESSION['register']['birthYear']);
            if (!empty($this->name) && !empty($this->surname) && !empty($this->email) && !empty($this->password)){
                $_SESSION['register']['success'] = 'You have successfully registered';
            }
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