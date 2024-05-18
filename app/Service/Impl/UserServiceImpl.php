<?php

namespace App\Service\Impl;

use App\Service\UserService;

class UserServiceImpl implements UserService
{

    private array $users = [
        'Farhan' => '123',
    ];


    public function login(string $user, string $password) : bool
    {
        if (!isset($this->users[$user])){
            return false;
        }

        $currentPassword = $this->users[$user];
        return $password == $currentPassword;
    }
}
