<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Models\Employer;
use App\Models\Candidate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Mail\AccountRegistrationMessage;

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
        // tranform the account type to its associated string value
        $guard = $request['user_type'] == 1 ? $request['user_type'] = 'candidate' : 'employer';
        // perform input validation
        $request->validate(
            [
                'user_type' => 'required|in:1,2',
                'password' => 'required|string|confirmed',
                'accept_terms' => 'required|accepted',
                'username' => 'required|string|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'phone_number' => 'required|string|unique:users,phone_number',
            ],
            [
                'user_type' => 'The account type must be candidate or employer',
                'accept_terms' => 'The terms of services must be accepted',
                'email' => 'The email is already linked with another account',
                'phone_number' => 'The phone number is already linked with another account',
                'username' => "The username '{$request->username}' already exists",
            ]
        );
        $home = redirect()->route('home')->with('success', 'Account created successfully')->getTargetUrl(); // get the home page url
        $user = User::create(array_map('strtolower', $request->all())); // create the user
        Auth::guard($guard)->login($user); // automatically login the user
        // event(new Registered($user));
        // Mail::to($user->email)->sendNow(new AccountRegistrationMessage($user)); // send the registration message to the user
        return $request->ajax() ?
            response(['success' => true, 'redirect_url' => $home]) :
            redirect()->route('home')->with('success', 'Account created successfully');
    }
    public function authenticate(Request $request)
    {
        $url = $request->to;
        $user = $request['user'];
        $credentials = [];
        $guard = $request['account_type'] == 1 ? 'candidate' : 'employer';
        if (filter_var($user, FILTER_VALIDATE_EMAIL)) // $user is an email
        {
            $credentials = [
                'email' => $user,
                'user_type' => $request['account_type'],
                'password' => $request['password']
            ];
            $request->validate(
                [
                    'user' => 'required|email|exists:users,email',
                    'account_type' => 'required|exists:users,user_type',
                    'password' => 'required'
                ],
                [
                    'user.exists' => 'The email you entered does not exist',
                    'account_type.exists' => 'account not exists',
                ]
            );
        } else {
            // $user is not an email
            $credentials = [
                'username' => $user,
                'user_type' => $request['account_type'],
                'password' => $request['password']
            ];
            $request->validate([
                'user' => 'required|exists:users,username',
                'account_type' => 'required|exists:users,user_type',
                'password' => 'required'
            ], [
                "user.exists" => "Username '{$request->user}' does not exist",
                'account_type.exists' => 'account not exists',
            ]);
        }
        if (Auth::guard($guard)->attempt($credentials)) {
            $request->session()->regenerate();
            $redirect_url = $request->filled('to') ?
                redirect()->to($url)->with('success', 'You have successfully log in')->getTargetUrl() :
                redirect()->intended($guard == 'employer' ? route('employer.dashboard') : '/')->with('success', 'You have successfully log in')->getTargetUrl();
            return
                $request->ajax() ?
                response(['success' => true, 'redirect_url' => $redirect_url]) :
                redirect()->intended($guard == 'employer' ? route('employer.dashboard') : '/')->with('success', 'You have successfully log in');
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
    public function forgot_password(Request $request)
    {
        $page_title = "FOTGOT PASSWORD";
        return view('auth.reset-password', compact('page_title'));
    }
    // public function reset_password(Request $request, $token, $account_type)
    // {

    //     $token_exists = DB::table('password_reset_tokens')->where('email', $user->email)->first();
    //     if ($token_exists->exists()) {
    //         DB::table('password_reset_tokens')->where('email', $user->email)->delete();
    //     }
    //     $page_title = "RESET PASSWORD";
    //     if ($user) {
    //         return view('auth.update-password', compact('token'));
    //     }
    //     return redirect()->route('password.request')->with('error', 'Invalid token');
    // }
    public function verify_reset_token(Request $request, $token, $account_type)
    {
        $token = $request->token;
        $account_type = $request->account_type;
        $token_exists = DB::table('password_reset_tokena')->where('token', $token)->first();
        if (!$token_exists->exists()) {
            return view('auth.verify-token', compact('token', 'account_type'));
        }
        if ($account_type == 1) {
        } else if ($account_type == 2) {
        }
        return redirect()->route('login')->with('info', 'Password has been changed');
    }
    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'account_type' => 'required',
        ]);
        if ($request->account_type == 1) {
            $request->validate([
                'email' => 'required|email|exists:candidates,email'
            ]);
            $user = Candidate::where('email', $request->email)->first();
            $token_exists = DB::table('password_reset_tokens')->where('email', $user->email)->first();
            if ($token_exists) {
                DB::table('password_reset_tokens')->where('email', $user->email)->delete();
            }
            if (!$user) {
                return redirect()->route('password.request')->with('error', 'No account found with this email');
            }
            $token = $user->remember_token = Str::random(60);
            $account_type = $request->account_type;
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            Mail::to($user->email)->send(new PasswordResetMail($token, $account_type));

            return redirect()->route('reset-password')->with('success', 'Reset password link has been sent to your email address');
        } elseif ($request->account_type == 2) {
            $request->validate([
                'email' => 'required|email|exists:employers,email'
            ]);
            $user = Candidate::where('email', $request->email)->first();
            $token_exists = DB::table('password_reset_tokens')->where('email', $user->email)->first();
            if ($token_exists) {
                DB::table('password_reset_tokens')->where('email', $user->email)->delete();
            }
            if (!$user) {
                return redirect()->route('password.request')->with('error', 'No account found with this email');
            }
            $token = $user->remember_token = Str::random(60);
            $account_type = $request->account_type;

            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            Mail::to($user->email)->send(new PasswordResetMail($token, $account_type));

            return redirect()->route('reset-password')->with('success', 'Reset password link has been sent to your email address');
        }
    }
}
