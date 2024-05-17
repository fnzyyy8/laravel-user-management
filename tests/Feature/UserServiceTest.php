<?php

namespace Tests\Feature;

use App\Service\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testLoginSuccess()
    {
        $hasil = $this->userService->login('Farhan','passwordFarhan');
        self::assertTrue($hasil);

    }

    public function testLoginFailed()
    {
        $hasil = $this->userService->login('Deniss','passwordFarhan');
        self::assertFalse($hasil);

    }

    public function testWrongPassword()
    {
        $hasil = $this->userService->login('Anto','passwordSalah');
        self::assertFalse($hasil);

    }


}
