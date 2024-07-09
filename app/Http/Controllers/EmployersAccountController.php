<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployersAccountController extends Controller
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
        $path = 'my account';
        return view('employer.account.index', compact('employer', 'path'));
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
    public function update_password(Request $request)
    {
        $employer = Employer::find(auth('employer')->id());

        $request->validate(
            [
                'c_password' => ['required', 'string'],
                'password' => ['required', 'string', 'confirmed'],
            ],
            [
                'password.confirmed' => 'The confirmed new password does not match the new password'
            ]
        );
        if (Hash::check($request->input('c_password'), auth('employer')->user()->password)) {
            $employer->password = Hash::make($request->input('password'));
            $employer->save();
            return response([
                'success' => true,
                'url' => redirect()->route('my-account.show')
                    ->with('success', 'Password updated successfully')
                    ->getTargetUrl()
            ]);
        } else {
            return response()->json(
                [
                    'errors' =>
                    ['The current password is incorrect']
                ],
                422,
                ['content-type' => 'application/json']
            );
        }
    }
    public function update(Request $request)
    {
        $employer = Employer::find(auth('employer')->id());
        // Validate the request

        $request->validate(
            [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'username' => 'required|string|unique:employers,username,' . $employer->id,
                'phone_number' => 'required|string',
                'email' => 'required|email|unique:employers,email,' . $employer->id,
                'gender' => 'required|string|in:male,female',
                // 'password' => 'required|string',
                // 'accept_terms' => 'required|accepted'
            ],
            [
                // 'accept_terms' => 'The terms of services must be accepted',
                'email' => 'The email is already linked with another account',
                'username' => "The username '{$request->username}' already exists",
            ]
        );
        $employer->update(array_map('strtolower', $request->all()));
        return back()->with('success', 'account updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employer $employer)
    {
        //
    }
}
