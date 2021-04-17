<?php

namespace App\Services;

use App\Models\RegisteredPerson;
use App\Repositories\RegisteredUsersRepository;
use App\Validation\ValidatorInterface;

class RegisterService
{
    private RegisteredUsersRepository $registeredPersonsRepository;
    private ValidatorInterface $validator;
    private array $context;
    private $success;

    public function __construct(RegisteredUsersRepository $registeredUsersRepository, ValidatorInterface $validator)
    {
        $this->registeredPersonsRepository = $registeredUsersRepository;
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
            'emailErr' => $this->validator->getEmailErr()
        ];
        if (!empty($this->validator->getName()) && !empty($this->validator->getSurname()) &&
            !empty($this->validator->getPassword()) && !empty($this->validator->getEmail())) {
            $person = new RegisteredPerson($this->validator->getName(), $this->validator->getSurname(),
                $this->validator->getGender(), $this->validator->getEmail(),
                $this->validator->getBirthYear(),
                password_hash($this->validator->getPassword(), PASSWORD_DEFAULT));
            $this->registeredPersonsRepository->addUser($person);
            $this->success = ['success' => 'You have successfully registered'];
            header('Location: login');
        }
    }

    public function getContext()
    {
        return $this->context;
    }
}