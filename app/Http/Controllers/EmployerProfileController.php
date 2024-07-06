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
        $path = 'profile setup';
        $profile = auth('employer')->user();
        return view('employer.edit-profile', compact('path', 'profile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'required|image|mimes:jpg,png,jpeg,webp,bmp|max:2048',
            ]);
            $logo = $request->file('logo');
            // $logoName = time() . '.' . $logo->getClientOriginalExtension();
            // $path = $request->file("logo")->storeAs('products', $logo, 'public');
            // $logo->move(public_path('images'), $logoName);
            $path = $logo->store('/company/logos', 'public');
            $profile = EmployerProfile::where('employer_id', auth('employer')->id());
            if ($profile->exists()) {
                $profile->update([
                    'employer_id' => auth('employer')->id(),
                    'logo_image' => url('/storage/' . $path),
                    'banner_image' => '',
                    'company_name' => '',
                    'about_us' => '',
                ]);
            } else {
                EmployerProfile::create([
                    'employer_id' => auth('employer')->id(),
                    'logo_image' => url('/storage/' . $path),
                    'banner_image' => '',
                    'company_name' => '',
                    'about_us' => '',
                ]);
            }
            return response(['success' => true, 'file' => url('/storage/' . $path)]);
        }
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
