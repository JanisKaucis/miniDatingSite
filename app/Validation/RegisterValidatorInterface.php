<?php
namespace App\Validation;

interface RegisterValidatorInterface
{
    public function inputRefactor($data): string;
    public function validateRegisterForm();
    public function getName();
    public function getSurname();
    public function getEmail();
    public function getPassword();
    public function getGender();
    public function getBirthYear();
    public function getNameErr();
    public function getSurnameErr();
    public function getEmailErr();
    public function getPasswordErr();
    public function getPassword2Err();

}