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
        $profile = EmployerProfile::where('employer_id', auth('employer')->id())->first();

        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'required|image|mimes:jpg,png,jpeg,webp,bmp|max:2048',
            ]);
            $logo = $request->file('logo');

            $path = url('/storage/' . $logo->store('/company/logos', 'public'));
            if ($profile->exists()) {
                $profile->update([
                    'logo' => $path,
                ]);
            } else {
                EmployerProfile::create([
                    'employer_id' => auth('employer')->id(),
                    'logo' => $path,
                ]);
            }
            return response(['success' => true, 'file' => $path]);
        }
        if ($request->hasFile('banner')) {
            $request->validate([
                'banner' => 'required|image|mimes:jpg,png,jpeg,webp,bmp|max:4096',
            ]);
            $banner = $request->file('banner');
            $path = url('/storage/' . $banner->store('/company/banners', 'public'));
            if ($profile->exists()) {
                $profile->update([
                    'banner' => $path,
                ]);
            } else {
                EmployerProfile::create([
                    'employer_id' => auth('employer')->id(),
                    'banner' => $path,
                ]);
            }
            return response(['success' => true, 'file' => $path]);
        }
        if ($profile->exists()) {
            $profile->update([
                'company_name' => '',
                'about_us' => '',
            ]);
        } else {
            EmployerProfile::create([
                'company_name' => '',
                'about_us' => '',
            ]);
        }
        $next_tab = redirect()->route('employer.company-profile', ['tab' => 'account-setup-2'])->with('success', 'company info updated');
        return response(['success' => true, 'next_tab' => $next_tab]);
        // return response(['success' => true, 'file' => url('/storage/' . $path)]);
        // }
        // $logoName = time() . '.' . $logo->getClientOriginalExtension();
        // $path = $request->file("logo")->storeAs('products', $logo, 'public');
        // $logo->move(public_path('images'), $logoName);
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployerProfile $employerProfile, Request $request)
    {
        $path = 'profile setup';
        $profile = auth('employer')->user();
        return view('employer.edit-profile', compact('path', 'profile'));
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
