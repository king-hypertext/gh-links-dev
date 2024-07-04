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
            return back();
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

        $request->validate([
            'password' => 'required|string',
        ]);
        if (Auth::guard('candidate')->attempt($credentials)) {
            $redirect_url = redirect()->intended(route('candidate.dashboard'))->getTargetUrl();
            return $request->ajax() ?
                response(['success' => true, 'redirect_url' => $redirect_url]) :
                redirect()->intended(route('candidate.dashboard'));
        }
        return $request->ajax() ?
            response('invalid login credentials', 403) :
            back()->with('error', 'invalid login credentials');

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

        $request->validate([
            'password' => 'required|string',
        ]);
        if (Auth::guard('employer')->attempt($credentials)) {
            $redirect_url = redirect()->intended(route('employer.dashboard'))->getTargetUrl();
            return $request->ajax() ?
                response(['success' => true, 'redirect_url' => $redirect_url]) :
                redirect()->intended(route('employer.dashboard'));
        }
        return $request->ajax() ?
            response('invalid login credentials', 403) :
            back()->with('error', 'invalid login credentials');
    }
}
