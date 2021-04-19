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
    private int $uploadOk;
    private string $imageName = '';
    private string $nameErr = '';
    private string $surnameErr = '';
    private string $passwordErr = '';
    private string $password2Err = '';
    private string $emailErr = '';
    private string $imageErr = '';
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
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $this->emailErr = 'Invalid Email';
            } elseif (!empty($this->registeredUsersRepository->selectByEmail($_POST['email']))) {
                $this->emailErr = 'This email is already used';
            } else {
                $this->email = $this->inputRefactor($_SESSION['register']['email']);
            }
            if ($_POST['password'] != $_POST['password2']) {
                $this->passwordErr = 'Passwords dont match';
            } else {
                $this->password = $this->inputRefactor($_SESSION['register']['password']);
            }
            $this->gender = $this->inputRefactor($_SESSION['register']['gender']);
            $this->birthYear = $this->inputRefactor($_SESSION['register']['birthYear']);

                //uploadImage
                if (!empty($_FILES["image"]["name"])) {
                    $target_dir = "/home/janis/Desktop/php-projects/miniDatingSite/app/Storage/Pictures/";
                    //create multiple image directories
                    $this->imageName = basename($_FILES["image"]["name"]);
                    $imageType = explode('.',$this->imageName);
                    $imageType = $imageType[1];
                    $this->imageName = md5($this->imageName).'.'.$imageType;
                    $pathArray = str_split($this->imageName,2);
                    if ( ! is_dir($target_dir.$pathArray[0].'/'.$pathArray[1])) {
                        mkdir($target_dir.$pathArray[0].'/'.$pathArray[1],0777,true);
                    }
                    $this->imageName = $pathArray[0].'/'.$pathArray[1].'/'.$this->imageName;

                    $target_file = $target_dir . $this->imageName;
                    $imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));
                    // Check if image file is a actual image or fake image
                    $this->uploadOk = 1;

                    // Check file size
                    if ($_FILES["image"]["size"] > 8000000) {
                        $this->imageErr = "Sorry, your file is too large.";
                        $this->uploadOk = 0;
                    }
                    // Allow certain file formats
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif") {
                        $this->imageErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $this->uploadOk = 0;
                    }
                    if ($this->uploadOk == 1) {
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    }
                }
            if (!empty($this->name) && !empty($this->surname) && !empty($this->email) &&
                !empty($this->password) && $this->uploadOk == 1) {
                $_SESSION['register']['success'] = 'You have successfully registered';
            }
            }
        }

    public function getName():string
    {
        return $this->name;
    }

    public function getSurname():string
    {
        return $this->surname;
    }

    public function getEmail():string
    {
        return $this->email;
    }

    public function getPassword():string
    {
        return $this->password;
    }

    public function getGender():string
    {
        return $this->gender;
    }

    public function getBirthYear():string
    {
        return $this->birthYear;
    }
    public function getNameErr():string
    {
        return $this->nameErr;
    }

    public function getSurnameErr():string
    {
        return $this->surnameErr;
    }

    public function getEmailErr():string
    {
        return $this->emailErr;
    }

    public function getPasswordErr():string
    {
        return $this->passwordErr;
    }

    public function getPassword2Err():string
    {
        return $this->password2Err;
    }
    public function getImageErr(): string
    {
        return $this->imageErr;
    }
    public function getUploadOk(): int
    {
        return $this->uploadOk;
    }
    public function getImageName(): string
    {
        return $this->imageName;
    }
    public function setImageName(string $imageName): void
    {
        $this->imageName = $imageName;
    }
}