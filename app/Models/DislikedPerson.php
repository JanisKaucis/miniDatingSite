<?php
namespace App\Models;

class DislikedPerson
{
    public string $userEmail;
    public array $dislikedUsers;
    public function __construct(string $userEmail,array $dislikedUsers)
    {
        $this->userEmail = $userEmail;
        $this->dislikedUsers = $dislikedUsers;
    }
    public function getUserEmail(): string
    {
        return $this->userEmail;
    }
    public function getLikedUsers(): array
    {
        return $this->dislikedUsers;
    }
}