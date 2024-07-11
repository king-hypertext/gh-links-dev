<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\CompanyImage;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\EmployerProfile;

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
        dd($request);
        // EmployerProfile::create($request);
        return redirect()->route('employer.company-profile.save', ['tab' => 'set-up'])->with('success', 'profile updated successfully');
    }
    public function storeImages(Request $request)
    {
        $profile = EmployerProfile::where('employer_id', auth('employer')->id())->first();
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'required|image|mimes:jpg,png,jpeg,webp,bmp|max:2048',
            ]);
            $logo = $request->file('logo');

            $path = url('/storage/' . $logo->store('/company/images', 'public'));
            if ($profile->image?->logo_image !== null) {
                unlink($profile->image->logo_image);
                $profile->image()->update([
                    'logo_image' => $path,
                ]);
            } else {
                CompanyImage::create([
                    'employer_profile_id' => auth('employer')->id(),
                    'logo_image' => $path,
                ]);
            }
            return response(['success' => true, 'file' => $path]);
        }
        if ($request->hasFile('banner')) {
            $request->validate([
                'banner' => 'required|image|mimes:jpg,png,jpeg,webp,bmp|max:4096',
            ]);
            $banner = $request->file('banner');
            $path = url('/storage/' . $banner->store('/company/images', 'public'));
            if ($profile->image->banner_image) {
                unlink($profile->image->banner_image);
                $profile->image()->update([
                    'banner_image' => $path,
                ]);
            } else {
                CompanyImage::create([
                    'employer_profile_id' => auth('employer')->id(),
                    'banner_image' => $path,
                ]);
            }
            return response(['success' => true, 'file' => $path]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployerProfile $employerProfile, Request $request)
    {
        $path = 'profile setup';
        $profile = auth('employer')->user();
        $organization_types = Organization::all();
        $industry_types = Industry::all();
        return view('employer.edit-profile', compact('path', 'profile', 'organization_types', 'industry_types'));
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
