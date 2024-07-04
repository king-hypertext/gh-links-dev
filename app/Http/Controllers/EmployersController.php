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
        //
    }
    public function register(Request $request)
    {
        $request->validate(
            [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'username' => 'required|string',
                'phone_number' => 'required|string',
                'email' => 'required|email',
                'gender' => 'required|in:male,female',
                'password' => 'required|string|confirmed',
                'accept_terms' => 'required|accepted'
            ],
            [
                'accept_terms' => 'The terms of services must be accepted'
            ]
        );
        // dd($request->all());
        $data = Employer::create(array_map('strtolower', $request->all()));
        $dashboard = redirect()->route('employer.dashboard')->with('success', 'Account created successfully');
        if (Auth::guard('candidate')->attempt(['username' => $data->username, 'password' => $data->password])) {
            return response(['success' => true, 'redirect_url' => $dashboard]);
        }
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
        $employer = Employer::find(auth('employer')->id());
        return view('employer.da    shboard', compact('employer'));
    }
}
