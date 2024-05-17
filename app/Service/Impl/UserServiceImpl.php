<?php

namespace App\Service\Impl;

use App\Service\UserService;

class UserServiceImpl implements UserService
{

    private array $users = [
        'Farhan' => 'passwordFarhan',
        'Anto'=>'passwordAnto'
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
