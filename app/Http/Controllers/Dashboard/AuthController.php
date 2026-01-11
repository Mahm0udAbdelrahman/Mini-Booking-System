<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use App\Services\Dashboard\AuthService;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService){}

    public function login()
    {
        return view('dashboard.pages.auth.login');
    }

    public function loginAction(LoginRequest $request)
    {
        if ($this->authService->login($request->validated()))
        {
            return redirect()->route('Admin.home');
        }

        return redirect()->back();
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login');
    }
}
