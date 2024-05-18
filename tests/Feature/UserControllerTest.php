<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLogin()
    {
        $this->post('/user/login', [
            'user' => 'Farhan',
            'password' => 'passwordFarhan'
        ])->assertRedirect('/')
            ->assertSessionHas('user', 'Farhan');
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            'user'=>'Farhan'
        ])->get('/user/login')
            ->assertRedirect('/');

    }


    public function testLoginAuthentication()
    {
        $this->post('/user/login', [])
            ->assertSeeText('User or password is required');
    }

    public function testLoginFailed()
    {
        $this->post('/user/login', [
            'user' => 'wrong',
            'password' => 'wrong'
        ])->assertSeeText('Wrong email or password');
    }

    public function testLogout()
    {

        $this->withSession([
            'user' => 'Farhan'
        ])->post('/user/logout')
            ->assertRedirect('/user/login')
            ->assertSessionMissing('user');

    }


}
