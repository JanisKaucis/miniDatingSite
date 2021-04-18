<?php
namespace App\Validation;

interface LoginValidatorInterface
{
    public function inputRefactor($data): string;
    public function validateLoginForm();
    public function getEmail(): string;
    public function getPassword(): string;
    public function getEmailErr(): string;
    public function getPasswordErr(): string;
    public function getLoginErr(): string;
}