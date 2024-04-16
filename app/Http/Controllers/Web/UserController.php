<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;

final class UserController extends Controller
{
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials)) {
            return redirect()->intended();
        } else {
            return back()->withErrors(['email' => 'Неверный логин или пароль']);
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->intended();
    }
}
