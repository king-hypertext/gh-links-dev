<?php

namespace App\Http\Controllers;

use App\Models\EmployerProfile;
use Illuminate\Http\Request;

class EmployerProfileController extends Controller
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
    public function show(EmployerProfile $employerProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployerProfile $employerProfile)
    {
        $path = 'account setup';
        $profile = $employerProfile;
        return view('employer.edit-profile', compact('path', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployerProfile $employerProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployerProfile $employerProfile)
    {
        //
    }
}
