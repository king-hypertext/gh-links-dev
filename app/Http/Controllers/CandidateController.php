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
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ], []);
        Candidate::create(array_map('strtolower', $request->all()));
        // $back = redirect()->back()->with('success', 'Candidate created successfully')->getTargetUrl();
        if (Auth::guard('candidate')->attempt($request->only(['username', 'password']))) {
            $dashboard = redirect()->route('employee.dashboard')->with('success', 'Account created successfully');
            return response(['success' => true, 'redirect_url' => $dashboard]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $employee)
    {
        //
    }
    public function dashboard(Request $request)
    {
        $candidate = Candidate::find(auth('candidate')->id());
        return view('candidate.dashboard', compact('candidate'));
    }
}
