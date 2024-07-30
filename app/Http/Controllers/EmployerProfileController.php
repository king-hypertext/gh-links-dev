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
    public function candidates()
    {
        $page_title = 'MY CANDIDATES';
        return view('employer.candidates', compact('page_title'));
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
        // dd($request);
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'company_name' => 'required|string',
            'company_description' => 'required|string',

            'organization_id' => 'required|exists:organizations,id',
            'industry_id' => 'required|exists:industries,id',
            'company_size' => 'required|string',
            'company_website' => 'required|active_url',
            'company_founding_year' => 'required|date',
            'company_vision' => 'required|string',

            'company_location' => 'required|string',
            'company_email' => 'required|email',
        ]);
        $profile = EmployerProfile::where('employer_id', auth('employer')->id())->first();
        if ($profile->exists()) {
            $profile->update($request->all());
            // return response(['success' =>true, ])
        } else {
            EmployerProfile::create($request->all());
        }
        $redirect_url = redirect()->route('employer.company-profile', ['tab' => 'account-image-upload'])->with('success', 'profile updated successfully')->getTargetUrl();
        return response(['success' => true, 'next_tab' => $redirect_url]);
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
    public function save_candidate(Request $request)
    {
        $savedCandidate = auth('employer')->user()->profile->saved_candidates()->where('candidate_profile_id', $request->candidate_id);
        $isCandidateSaved = auth('employer')->user()->profile->saved_candidates->contains('candidate_profile_id', $request->candidate_id);
        if ($isCandidateSaved) {
            $savedCandidate->delete();
            return response(['success' => true, 'message' => 'candidate removed from favourites']);
        }
        // Save the candidate
        auth('employer')->user()->profile->saved_candidates()->create([
            'candidate_profile_id' => $request->candidate_id,
            'employer_profile_id' => auth('employer')->user()->profile->id,
        ]);
        return response(['success' => true, 'message' => 'candidate added to favourites']);
    }
    public function unsave_candidate(Request $request)
    {
        $savedCandidate = auth('employer')->user()->profile->saved_candidates()->where('candidate_profile_id', $request->candidate_id);
        $savedCandidate->delete();
        $redirect_url = redirect()->back()->with('success', 'candidate removed from favourites')->getTargetUrl();
        return response(['success' => true, 'url' => $redirect_url, 'message' => 'candidate removed from favourites']);
    }
}
