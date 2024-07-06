<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }
    public function register(Request $request)
    {
        $request->validate(
            [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'username' => 'required|string|unique:employers,username',
                'phone_number' => 'required|string',
                'email' => 'required|email|unique:employers,email',
                'gender' => 'required|in:male,female',
                'password' => 'required|string|confirmed',
                'accept_terms' => 'required|accepted'
            ],
            [
                'accept_terms' => 'The terms of services must be accepted',
                'email' => 'The email is already linked with another account',
                'username' => "The username '{$request->username}' already exists",
            ]
        );
        // dd($request->all());
        $dashboard = redirect()->route('employer.dashboard')->with('success', 'Account created successfully')->getTargetUrl();
        $user = Employer::create(array_map('strtolower', $request->all()));
        Auth::guard('employer')->login($user);
        /* $user =   */
        // dd($user,);
        return $request->ajax() ?
            response(['success' => true, 'redirect_url' => $dashboard]) :
            response(['success' => false, 'message' => 'Failed to create account']);
    }
    // log the user out of the system
    public function logout()
    {
        if (!Auth::guard('employer')->check()) {
            return redirect()->route('login');
        }
        session()->regenerate();
        session()->invalidate();
        session()->flush();
        Auth::guard('employer')->logout();
        return redirect()->route('login', ['tab' => 'employer'])->with('info', 'You have been logged out successfully');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Employer $employer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employer $employer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employer $employer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employer $employer)
    {
        //
    }
    public function dashboard()
    {
        $user = Employer::find(auth('employer')->id());
        // dd($employer);
        return view('employer.dashboard', compact('user'));
    }
}
