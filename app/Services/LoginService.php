<?php

namespace App\Services;

use App\Validation\LoginValidatorInterface;

class LoginService
{
    private LoginValidatorInterface $loginValidator;
    private array $context;

    public function __construct(LoginValidatorInterface $validator)
    {
        $this->loginValidator = $validator;
    }

    public function login()
    {
        $this->loginValidator->validateLoginForm();
        $this->context = [
            'emailErr' => $this->loginValidator->getEmailErr(),
            'passwordErr' => $this->loginValidator->getPasswordErr(),
            'loginErr' => $this->loginValidator->getLoginErr()
        ];
    }
    public function getContext(): array
    {
        return $this->context;
    }
}