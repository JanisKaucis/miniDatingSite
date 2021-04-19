<?php

namespace App\Validation;

use App\Repositories\RegisteredUsersRepository;

class LoginValidator implements LoginValidatorInterface
{
    private string $email = '';
    private string $password = '';
    private string $emailErr = '';
    private string $passwordErr = '';
    private string $loginErr = '';
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

    public function validateLoginForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['login']['email'] = $_POST['email'];
            $_SESSION['login']['password'] = $_POST['password'];

            if (empty($_POST['email'])) {
                $this->emailErr = 'Email is required';
                $hash = '';
            } else {
                $user =$this->registeredUsersRepository->selectByEmail($_POST['email']);
                if (!empty($user)){
                    $hash = $user[0]['password'];
                }else{
                    $hash = '';
                }
                $this->email = $this->inputRefactor($_SESSION['login']['email']);
            }
            if (empty($_POST['password'])) {
                $this->passwordErr = 'Password is required';
            } else {
                $this->password = $this->inputRefactor($_SESSION['login']['password']);
            }
            if (!empty($_POST['email']) && !empty($_POST['password']) &&
                empty($this->registeredUsersRepository->selectByEmail($_POST['email'])) ||
                    password_verify($_POST['password'],$hash) == false){
                $this->loginErr = 'Invalid email or password';
            }
        }
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getEmailErr(): string
    {
        return $this->emailErr;
    }
    public function getPasswordErr(): string
    {
        return $this->passwordErr;
    }
    public function getLoginErr(): string
    {
        return $this->loginErr;
    }
}