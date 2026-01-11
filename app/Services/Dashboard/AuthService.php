<?php
namespace App\Services\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthService
{
    public function login(array $credentials): bool
    {
        if (! Auth::attempt($credentials)) {
            Session::flash('message', ['type' => 'error','text' => __('Invalid credentials!')]);
            return false;
        }

        $user = Auth::user();

        if ($user->email_verified_at === null) {
            Auth::logout();
            Session::flash('message', ['type' => 'warning','text' => __('Please verify your email before proceeding.')]);
            return false;
        }

        Session::flash('message', ['type' => 'success','text' => __('Welcome Home!'),]);

        return true;
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
