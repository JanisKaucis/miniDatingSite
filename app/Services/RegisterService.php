<?php

namespace App\Services;

use App\Models\RegisteredPerson;
use App\Repositories\RegisteredUsersRepository;
use App\Validation\RegisterValidatorInterface;

class RegisterService
{
    private RegisteredUsersRepository $registeredUsersRepository;
    private RegisterValidatorInterface $validator;
    private array $context;

    public function __construct(RegisteredUsersRepository $registeredUsersRepository, RegisterValidatorInterface $validator)
    {
        $this->registeredUsersRepository = $registeredUsersRepository;
        $this->validator = $validator;
    }

    public function setRegisteredPerson()
    {
        $this->validator->validateRegisterForm();
            $this->context = [
                'nameErr' => $this->validator->getNameErr(),
                'surnameErr' => $this->validator->getSurnameErr(),
                'passwordErr' => $this->validator->getPasswordErr(),
                'password2Err' => $this->validator->getPassword2Err(),
                'emailErr' => $this->validator->getEmailErr(),
                'imageErr' => $this->validator->getImageErr()
            ];
            if (empty($this->validator->getImageName())){
                $this->validator->setImageName('default.png');
            }

        if (!empty($this->validator->getName()) && !empty($this->validator->getSurname()) &&
            !empty($this->validator->getPassword()) && !empty($this->validator->getEmail())) {
            $person = new RegisteredPerson($this->validator->getName(), $this->validator->getSurname(),
                $this->validator->getGender(), $this->validator->getEmail(),$this->validator->getImageName(),
                $this->validator->getBirthYear(),
                $this->validator->getPassword());//TODO hide password
            $this->registeredUsersRepository->addUser($person);
//            header('Location: /register');
        }
        if (isset($_SESSION['register']['success'])) {
            $this->context = [
                'success' => $_SESSION['register']['success']
            ];
        }

    }

    public function getContext()
    {
        return $this->context;
    }
}