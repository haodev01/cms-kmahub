<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;

class AuthController extends Controller
{
    //
    public function login(): View
    {
        return view('admin.pages.auth.login');
    }

    public function handleLogin(LoginRequest $request): RedirectResponse
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'remember' => $request->input('remember')
        ];

        if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']], $data['remember'])) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->withErrors(['message' => 'Email hoặc mật khẩu không đúng'])->withInput();
    }

    public function register(): View
    {
        return view('admin.pages.auth.register');
    }


    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
