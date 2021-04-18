<?php
namespace App\Validation;

interface RegisterValidatorInterface
{
    public function inputRefactor($data): string;
    public function validateRegisterForm();
    public function getName():string;
    public function getSurname():string;
    public function getEmail():string;
    public function getPassword():string;
    public function getGender():string;
    public function getBirthYear():string;
    public function getNameErr():string;
    public function getSurnameErr():string;
    public function getEmailErr():string;
    public function getPasswordErr():string;
    public function getPassword2Err():string;
    public function getImageErr(): string;
    public function getUploadOk(): int;
    public function getImageName(): string;
    public function setImageName(string $imageName): void;

}