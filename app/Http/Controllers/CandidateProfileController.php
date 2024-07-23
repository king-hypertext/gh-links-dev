<?php

namespace App\Http\Controllers;

use App\Models\CandidateEducationDetail;
use App\Models\CandidateJobExperience;
use App\Models\CandidateProfile;
use Illuminate\Http\Request;

class CandidateProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'n';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $candidate = auth('candidate')->user();
        return view('candidate.profile', compact('candidate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = CandidateProfile::where('candidate_id', $request->user('candidate')->id)->first();
        dd($id);
        dd($request->all());
        $request->validate([
            'gender' => 'required|in:male,female',
            'profile_picture' => 'required|image|mimes:png,jpg,jpeg,webp',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'website_url' => 'active_url',
            'marital_status' => 'required|in:married,single,divorced',
            // 'nationality',
            // 'current_salary',
            'location' => 'required|string',
            'date_of_birth' => 'required|date',
            'experience' => 'required|string',
            'biography' => 'required|string',

            'institution_name' => 'required|string',
            'institution_location' => 'required|string',
            'level' => 'required|string',
            'started_at' => 'date',
            'eneded_at' => 'date',

            'is_current',
            'started_at',
            'ended_at',
            'position',
            'job_description',
            'company_name',
            'location',
        ]);
        $profile_picture = $request->file('profile_picture')->store('candidates/image');
        CandidateEducationDetail::updateOrCreate([
            'candidate_profile_id' => $id,
        ], $request->only([]));
        CandidateJobExperience::updateOrCreate([
            'candidate_profile_id' => $id
        ], $request->only([]));
        CandidateProfile::updateOrCreate([
            'candidate_profile_id' => $id
        ], [
            'candidate_id',
            'gender',
            'profile_picture' => $profile_picture,
            'first_name',
            'last_name',
            'website_url',
            'marital_status',
            'nationality',
            'current_salary',
            'location',
            'date_of_birth',
            'experience',
            'biography',
        ]);
        return back()->with('success', 'Your profile has been setup successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CandidateProfile $candidateProfile)
    {
        return  view('candidate.layout',);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CandidateProfile $candidateProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CandidateProfile $candidateProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CandidateProfile $candidateProfile)
    {
        //
    }
    public function save_jobs(CandidateProfile $candidate)
    {
        $page_title = 'SAVED JOBS';
        return view('candidate.saved-jobs', compact('page_title', 'candidate'));
    }
}
