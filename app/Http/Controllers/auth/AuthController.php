<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', ['page_title' => 'LOGIN']);
    }
    public function register()
    {
        return view('auth.register', ['page_title' => 'REGISTER']);
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->only(['username', 'password']);
        $request->validate(
            [
                'username' => 'required|exists:users,username',
                'password' => 'required'
            ],
            ['username.exists' => 'User does not exist']
        );
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $redirect_url = redirect()->intended(route('home'))->getTargetUrl();
            return response(['success' => true, 'redirect_url' => $redirect_url]);
        }
        if ($request->ajax()) {
            return response('invalid login credentials', 500);
        }
    }
}
