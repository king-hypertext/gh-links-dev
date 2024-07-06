<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/')->with('info', 'You are already logged in');
        }
        return view('auth.login', ['page_title' => 'LOGIN']);
    }
    public function register()
    {
        return view('auth.register', ['page_title' => 'REGISTER']);
    }
    public function authenticate_candidate(Request $request)
    {
        // dd($request->all());
        $user = $request['user'];
        $request->validate(
            [
                'user' => 'required',
                'password' => 'required|string',
            ],
            [
                'user' => 'The username or email field is required'
            ]
        );
        $credentials = [];
        if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
            // $user is an email
            $credentials = [
                'email' => $user,
                'password' => $request['password']
            ];
            $request->validate(
                [
                    'user' => 'required|email|exists:candidates,email'
                ],
                [
                    'user.exists' => 'The email you entered does not exist'
                ]
            );
        } else {
            // $user is not an email
            $credentials = [
                'username' => $user,
                'password' => $request['password']
            ];
            $request->validate([
                'user' => 'required|exists:candidates,username',
            ], [
                "user.exists" => "Username '{$request->user}' does not exist"
            ]);
        }
        if (Auth::guard('candidate')->attempt($credentials)) {
            $request->session()->regenerate();
            // $redirect_url = redirect()->intended()->with('success', 'You have successfully log in')->getTargetUrl();
            return
                // auth('candidate')->user();
                // $request->ajax() ?
                // response(['success' => true, 'redirect_url' => $redirect_url]) :
                redirect()->intended(route('home'))->with('success', 'You have successfully log in');
        }
        return back()->withErrors(['password' => 'invalid login credentials']);
        // $request->ajax() ?
        // response('invalid login credentials', 403) :
    }
    public function authenticate_employer(Request $request)
    {
        $user = $request['user'];
        $request->validate(
            [
                'user' => 'required',
                'password' => 'required|string',
            ],
            [
                'user' => 'The username or email field is required'
            ]
        );
        $credentials = [];
        if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
            // $user is an email
            $credentials = [
                'email' => $user,
                'password' => $request['password']
            ];
            $request->validate([
                'user' => 'required|email|exists:employers,email'
            ]);
        } else {
            // $user is not an email
            $credentials = [
                'username' => $user,
                'password' => $request['password']
            ];
            $request->validate([
                'user' => 'required|exists:employers,username',
            ], [
                "user.exists" => "Username '{$request->user}' does not exist"
            ]);
        }

        if (Auth::guard('employer')->attempt($credentials)) {
            $request->session()->regenerate();
            $redirect_url = redirect()->intended(route('employer.dashboard'))->with('success', 'You have logged in successfully')->getTargetUrl();
            return $request->ajax() ?
                response(['success' => true, 'redirect_url' => $redirect_url]) :
                redirect()->intended(route('employer.dashboard'))->with('success', 'You have logged in successfully');
        }
        return $request->ajax() ?
            response('invalid login credentials', 403) :
            back()->with('error', 'invalid login credentials');
    }
}
