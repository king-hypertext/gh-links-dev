<?php

namespace App\Http\Controllers\auth;

use App\Models\Employer;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login() // returns the login page
    {
        if (Auth::guard('candidate')->check()) // if the candidate is already logged in, return to home page
        {
            return redirect()->route('home')->with('info', 'You are already logged in');
        }
        if (Auth::guard('employer')->check()) // if the employer is already logged in, return to employers dashboard
        {
            return redirect()->route('employer.dashboard')->with('info', 'You are already logged in');
        }
        return view('auth.login', ['page_title' => 'LOGIN']);
    }
    public function register() // returns the registration page
    {
        return view('auth.register', ['page_title' => 'REGISTER']);
    }
    public function create(Request $request) // handles the form submission for creating a new employee or employer
    {
        // perform input validation
        $request->validate(
            [
                'account_type' => 'required',
                'password' => 'required|string|confirmed',
                'accept_terms' => 'required|accepted'
            ],
            [
                'accept_terms' => 'The terms of services must be accepted',
            ]
        );
        // check if the account type == 1 (candidate)
        if ($request->account_type == 1) {
            // perform input validation
            $request->validate(
                [
                    'username' => 'required|string|unique:candidates,username',
                    'email' => 'required|email|unique:candidates,email',
                    'phone_number' => 'required|string|unique:candidates,phone_number',
                ],
                [
                    'email' => 'The email is already linked with another account',
                    'phone_number' => 'The phone number is already linked with another account',
                    'username' => "The username '{$request->username}' already exists",
                ]
            );
            $home = redirect()->route('home')->with('success', 'Account created successfully')->getTargetUrl(); // get the home page url
            $user = Candidate::create(array_map('strtolower', $request->all())); // create the user
            Auth::guard('candidate')->login($user); // automatically login the user
            // quickly reutrn the resonse to the view
            Mail::to($user->email)->send(); //
            return $request->ajax() ?
                response(['success' => true, 'redirect_url' => $home]) :
                redirect()->route('home')->with('success', 'Account created successfully');
        }
        if ($request->account_type == 2) {
            $request->validate(
                [
                    'username' => 'required|string|unique:employers,username',
                    'email' => 'required|email|unique:employers,email',
                    'phone_number' => 'required|string|unique:employers,phone_number',
                ],
                [
                    'email' => 'The email is already linked with another account',
                    'phone_number' => 'The phone number is already linked with another account',
                    'username' => "The username '{$request->username}' already exists",
                ]
            );
            $dashboard = redirect()->route('employer.dashboard')->with('success', 'Account created successfully')->getTargetUrl();
            $user = Employer::create(array_map('strtolower', $request->all()));
            Auth::guard('employer')->login($user);
            return $request->ajax() ?
                response(['success' => true, 'redirect_url' => $dashboard]) :
                redirect()->route('employer.dashboard')->with('success', 'Account created successfully');
        }
    }
    public function authenticate(Request $request)
    {
        $url = $request->to;
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

        if ($request->account_type == 1) {
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
                $redirect_url = $request->filled('to') ?
                    redirect()->to($url)->with('success', 'You have successfully log in')->getTargetUrl() :
                    redirect()->intended()->with('success', 'You have successfully log in')->getTargetUrl();
                return
                    $request->ajax() ?
                    response(['success' => true, 'redirect_url' => $redirect_url]) :
                    redirect()->intended()->with('success', 'You have successfully log in');
            }
        }
        if ($request->account_type == 2) {
            if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
                // $user is an email
                $credentials = [
                    'email' => $user,
                    'password' => $request['password']
                ];
                $request->validate(
                    [
                        'user' => 'required|email|exists:employers,email'
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
        }
        return
            $request->ajax() ?
            response('invalid login credentials', 403) :
            back()->withErrors(['password' => 'invalid login credentials']);
    }
    // public function authenticate_employer(Request $request)
    // {
    //     $user = $request['user'];
    //     $request->validate(
    //         [
    //             'user' => 'required',
    //             'password' => 'required|string',
    //         ],
    //         [
    //             'user' => 'The username or email field is required'
    //         ]
    //     );
    //     $credentials = [];
    //     if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
    //         // $user is an email
    //         $credentials = [
    //             'email' => $user,
    //             'password' => $request['password']
    //         ];
    //         $request->validate(
    //             [
    //                 'user' => 'required|email|exists:employers,email'
    //             ],
    //             [
    //                 'user.exists' => "Email '{$request->user}' does not exists"
    //             ]
    //         );
    //     } else {
    //         // $user is not an email
    //         $credentials = [
    //             'username' => $user,
    //             'password' => $request['password']
    //         ];
    //         $request->validate([
    //             'user' => 'required|exists:employers,username',
    //         ], [
    //             "user.exists" => "Username '{$request->user}' does not exist"
    //         ]);
    //     }

    //     if (Auth::guard('employer')->attempt($credentials)) {
    //         $request->session()->regenerate();
    //         $redirect_url = redirect()->intended(route('employer.dashboard'))->with('success', 'You have logged in successfully')->getTargetUrl();
    //         return $request->ajax() ?
    //             response(['success' => true, 'redirect_url' => $redirect_url]) :
    //             redirect()->intended(route('employer.dashboard'))->with('success', 'You have logged in successfully');
    //     }
    //     return $request->ajax() ?
    //         response('invalid login credentials', 403) :
    //         back()->with('error', 'invalid login credentials');
    // }
    public function email()
    {
        return view('auth.verify-email');
    }
}
