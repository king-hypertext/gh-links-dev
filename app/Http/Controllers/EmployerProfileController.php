<?php

namespace App\Http\Controllers;

use App\Models\CompanyPhoneNumber;
use App\Models\CompanySocialMediaLink;
use App\Models\Industry;
use App\Models\Image;
use App\Models\Employer;
use App\Models\Organization;
use Illuminate\Http\Request;

class EmployerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request);
        return $request->status;
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
            'company_name' => 'required|string',
            'company_description' => 'required|string',

            'organization_id' => 'required|exists:organizations,id',
            'industry_id' => 'required|exists:industries,id',
            'company_size' => 'required|string',
            'company_website' => 'nullable|active_url',
            'company_founding_year' => 'required|date',
            'company_vision' => 'required|string',

            'company_location' => 'required|string',
            'company_email' => 'required|email',
        ]);
        $id = $request->user('employer')->id;
        // $employer = Employer::where('user_id', $id);
        Employer::updateOrCreate([
            'user_id' => $id
        ], [
            'user_id' => $id,
            'company_name' => $request->company_name,
            'company_description' => $request->company_description,

            'organization_id' => $request->organization_id,
            'industry_id' => $request->industry_id,
            'company_size' => $request->company_size,
            'company_website' => $request->company_website,
            'company_founding_year' => $request->company_founding_year,
            'company_vision' => $request->company_vision,

            'company_location' => $request->company_location,
            'company_email' => $request->company_email,
        ]);
        $redirect_url = redirect()->route('employer.company-profile', ['#verify-business'])->with('success', 'profile updated successfully')->getTargetUrl();
        return response(['success' => true, 'next_tab' => $redirect_url]);
    }
    public function storeImages(Request $request)
    {
        $user = auth('employer')->user();
        if (!$user) {
            abort(403);
        }
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'required|image|mimes:jpg,png,jpeg,webp,bmp|max:2048',
            ]);
            $logo = $request->file('logo')->store('/employer/images', 'public');
            Image::updateOrCreate([
                'employer_id' => $user->employer->id
            ], [
                'employer_id' => $user->employer->id,
                'logo' => '/storage/' . $logo
            ]);
            return response(['success' => true, 'file' => url('/storage/' . $logo)]);
        }
        if ($request->hasFile('banner')) {
            $request->validate([
                'banner' => 'required|image|mimes:jpg,png,jpeg,webp,bmp|max:2048',
            ]);
            $banner = $request->file('banner')->store('/employer/images', 'public');
            Image::updateOrCreate([
                'employer_id' => $user->employer->id
            ], [
                'employer_id' => $user->employer->id,
                'banner' => '/storage/' . $banner
            ]);

            return response(['success' => true, 'file' => url('/storage/' . $banner)]);
        }
    }
    public function storeContacts(Request $request)
    {
        $user = auth('employer')->user();
        $request->validate(
            [
                'phone.0' => 'required|numeric',
                'phone.*' => 'nullable|numeric|different:phone',
            ],
            [
                'phone.*.different' => 'phone number already added',
            ]
        );

        $value = $request->input('phone');
        CompanyPhoneNumber::where('employer_id', $user->employer->id)->delete();
        for ($i = 0; $i < count($value); $i++) {
            if ($value[$i] !== null) {
                CompanyPhoneNumber::create([
                    'employer_id' => $user->employer->id,
                    'number' => $value[$i]
                ]);
            }
        }
        return response(['success' => true, 'message' => 'contact has been created successfully']);
    }
    public function storeSocialMediaLink(Request $request)
    {
        $user = auth('employer')->user();
        $request->validate(
            [
                'fb' => 'nullable|url|active_url|different:url',
                'x' => 'nullable|url|active_url|different:url',
                'linkedin' => 'nullable|url|active_url|different:url',
                'instagram' => 'nullable|url|active_url|different:url',
                'whatsapp' => 'nullable|url|active_url|different:url',
            ],
            [
                'x.active_url' => 'The x(twitter) field must be a valid url',
                'fb.active_url' => 'The facebook field must be a valid url',
            ]
        );
        CompanySocialMediaLink::where('employer_id', $user->employer->id)->delete();
        if (!$request->anyFilled(['x', 'fb', 'instagram', 'linkedin', 'whatsapp'])) {
            return response(['success' => true, 'message' => 'At least one field must be filled.'], 422);
        }
        CompanySocialMediaLink::updateOrCreate(
            ['employer_id' => $user->employer->id],
            [
                'employer_id' => $user->employer->id,
                'fb' => $request->fb,
                'x' => $request->x,
                'instagram' => $request->instagram,
                'whatsapp' => $request->whatsapp,
                'linkedin' => $request->linkedin
            ]
        );
        return response(['success' => true, 'message' => 'success ✅']);
    }
    /**
     * Display the specified resource.
     */
    public function show(Employer $employer, Request $request)
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
    public function edit(Employer $employer) {}

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
    public function save_candidate(Request $request)
    {
        $savedCandidate = auth('employer')->user()->employer->savedCandidates()->where('candidate_id', $request->candidate_id);
        $isCandidateSaved = auth('employer')->user()->employer->savedCandidates->contains('candidate_id', $request->candidate_id);
        if ($isCandidateSaved) {
            $savedCandidate->delete();
            $redirect_url = redirect()->back()->with('success', 'candidate removed from favourites')->getTargetUrl();
            return response(['success' => true, 'url' => $redirect_url, 'message' => 'candidate removed from favourites']);
        }
        // Save the candidate
        auth('employer')->user()->employer->savedCandidates()->create([
            'candidate_id' => $request->candidate_id,
            'employer_id' => auth('employer')->user()->employer->id,
        ]);
        return response(['success' => true, 'message' => 'candidate added to favourites']);
    }
}
