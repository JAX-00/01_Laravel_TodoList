<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    // Make contractor for user service
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // Show page login
    public function login(): Response
    {
        return response()->view("user.login", [
            "title" => "Login"
        ]);
    }

    // Logic of the Login
    public function doLogin(Request $request): Response|RedirectResponse
    {
        $user = $request->input('user');
        $password = $request->input('password');

        // Validate input Empty or Not
        if (empty($user) || empty($password)) {
            return response()->view("user.login", [
                "title" => "Login",
                "error" => "User or password is required"
            ]);
        }

        // Check data Input
        if ($this->userService->login($user, $password)) {
            $request->session()->put("user", $user);
            return redirect("/");
        }

        // if login failed
        return response()->view("user.login", [
            "title" => "Login",
            "error" => "user or password is wrong"
        ]);
    }

    // Logout
    public function doLogout(Request $request)
    {
        $request->session()->forget("user");
        return redirect("/");
    }
}
