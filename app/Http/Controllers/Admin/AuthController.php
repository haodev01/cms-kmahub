<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GoogleHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(): View
    {
        $instance = new GoogleHelper();
        $auth_gg_url = $instance->getUrlAuthentication();
        return view('admin.pages.auth.login', compact('auth_gg_url'));
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

    public function handleGoogleCallback(Request $request)
    {
        $code = $request->get('code');
        if (empty($code)) {
            return redirect()->route('admin.login')->withErrors(['message' => 'Có lỗi xảy ra khi đăng  nhập google']);
        }
        $instant = new GoogleHelper($code);
        $user = $instant->getProfile();
        $exist = Admin::where('email', $user['email'])->first();
        if (!$exist) {
            $user = Admin::create([
                'name' => $user['email'],
                'email' => $user['email'],
                'password' => Hash::make($user['email']),
                'username' => $user['email'],
            ]);
            Auth::guard('admin')->login($user);
        } else {
            Auth::guard('admin')->login($exist);
        }
        return redirect()->route('admin.dashboard');
    }
}
