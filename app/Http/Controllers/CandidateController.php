<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
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
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $request->validate(
            [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'username' => 'required|string|unique:candidates,username',
                'phone_number' => 'required|string',
                'email' => 'required|email|unique:candidates,email',
                // 'gender' => 'required|in:male,female',
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
        $dashboard = redirect()->route('candidate.dashboard')->with('success', 'Account created successfully')->getTargetUrl();
        $data = Candidate::create(array_map('strtolower', $request->all()));
        Auth::guard('candidate')->login($data);
        /* $user =   */
        // dd($user,);
        return $request->ajax() ?
            response(['success' => true, 'redirect_url' => $dashboard]) :
            response(['success' => false, 'message' => 'Failed to create account']);
    }

    public function logout(Request $request)
    {
        if (!Auth::guard('candidate')->check()) {
            return redirect()->route('login')->with('warning', 'You must be logged in');
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::guard('candidate')->logout();
        return redirect('/')->with('info', 'You have been logged out successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        return view('candidate.profile', compact('candidate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
    public function profile(Request $request)
    {
        $candidate = Candidate::find(auth('candidate')->id());
        return view('candidate.profile', compact('candidate'));
    }
}
