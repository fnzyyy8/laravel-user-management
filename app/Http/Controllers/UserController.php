<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function loginView()
    {
        return view('/user/login');

    }

    public function login(Request $request): Response|RedirectResponse
    {


        $user = $request->input('user');
        $password = $request->input('password');

        if (empty($user) || empty($password)) {
            return \response()->view('/user/login', [
                'title' => "Login",
                'error' => 'User or password is required'
            ]);
        }

        if ($this->userService->login($user, $password)) {
            $request->session()->put("user", $user);
            return redirect('/');
        }

        return \response()->view('/user/login', [
            'title' => 'login',
            'error' => 'Wrong email or password'
            ]);
    }

    public function logout(Request $request) : RedirectResponse
    {
        $request->session()->forget('user');
        return redirect('/user/login');

    }
}
