<?php
namespace App\Models;

class LikedPerson
{
    public string $userEmail;
    public array $likedUsers;
    public function __construct(string $userEmail,array $likedUsers)
    {
        $this->userEmail = $userEmail;
        $this->likedUsers = $likedUsers;
    }
}