<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
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
        $id = auth('candidate')->id();
        $candidate = CandidateProfile::query()->where('candidate_id', '=', $id);
        $request->whenHas('basic_info', function () use ($candidate, $request, $id) {
            $request->validate([
                'gender' => 'required|in:male,female',
                'profile_picture' => 'required|image|mimes:png,jpg,jpeg,webp',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'website_url' => 'nullable|active_url',
                'marital_status' => 'required|in:married,single,divorced',
                'location' => 'required|string',
                'date_of_birth' => 'required|date',
                'experience' => 'required|string',
                'biography' => 'nullable|string',
            ]);
            $url = redirect()->back()->with('success', 'Profile updated successfully')->getTargetUrl();
            $profile_picture = url('/storage/' . $request->file('profile_picture')->store('candidates/image', 'public'));
            if ($candidate->exists()) {
                $candidate->first()->update(
                    [
                        'gender' => $request->gender,
                        'profile_picture' => $profile_picture,
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'website_url' => $request->website_url,
                        'marital_status' => $request->marital_status,
                        'location' => $request->location,
                        'date_of_birth' => $request->date_of_birth,
                        'experience' => $request->experience,
                        'biography' => null,
                    ]
                );
                return response(['success' => true, 'url' => $url]);
            } else {
                CandidateProfile::create([
                    'candidate_id' => $id,
                    'gender' => $request->gender,
                    'profile_picture' => $profile_picture,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'website_url' => $request->website_url,
                    'marital_status' => $request->marital_status,
                    'location' => $request->location,
                    'date_of_birth' => $request->date_of_birth,
                    'experience' => $request->experience,
                    'biography' => 'not filled',
                ]);
            }
            return response(['success' => true, 'url' => $url]);
        });
        $request->whenHas('edu_info', function () use ($request, $candidate) {
            if ($candidate->exists()) {
                CandidateEducationDetail::updateOrCreate([
                    'candidate_profile_id' => $candidate->first()->id,
                ], [
                    'candidate_profile_id' => $candidate->first()->id,
                    'institution_name' => $request->institution_name,
                    'institution_location' => $request->institution_location,
                    'level' => $request->level,
                    'started_at' => $request->started_at,
                    'ended_at' => $request->ended_at,
                ]);
            }
            return back()->with('success', 'Profile updated successfully');
        });
        $request->whenHas('job_exp', function () use ($request, $candidate) {
            $request->validate([
                'is_current' => 'nullable|boolean',
                'job_started_at' => 'required|date',
                'position' => 'required|string',
                'job_description' => 'required|string',
                'company_name' => 'required|string',
                'job_location' => 'required|string',
            ]);
            if ($candidate->exists()) {
                CandidateJobExperience::updateOrCreate([
                    'candidate_profile_id' => $candidate->first()->id,
                ], [
                    'candidate_profile_id' => $candidate->first()->id,
                    'is_current' => $request->is_current ?? false,
                    'started_at' => $request->job_started_at,
                    'ended_at' => $request->job_ended_at ?? null,
                    'position' => $request->position,
                    'job_description'   => $request->job_description,
                    'company_name' => $request->company_name,
                    'job_location' => $request->job_location,
                ]);
                return back()->with('success', 'Profile updated successfully');
            }
        });
        $request->whenHas('biography', function () use ($request, $candidate) {
            $request->validate([
                'biography' => 'required|string',
            ]);
            if ($candidate->exists()) {
                $candidate->first()->update(['biography' => $request->biography]);
            } else {
                CandidateProfile::create([
                    'candidate_profile_id' => $candidate->first()->id,
                ], [
                    'candidate_profile_id' => $candidate->first()->id,
                    'biography' => $request->biography,
                ]);
            }
        });
        $request->whenHas('cv', function () use ($request, $candidate) {
            $request->validate([
                'cv' => 'required|file|mimes:pdf',
            ]);
            $cv = $request->file('cv');
            $cv_path = url('/storage/' . $cv->storeAs('candidates/cv', $candidate->first()->full_name . '.' . now()->format('Y.m.d.H.i') . '.pdf', 'public'));
            if ($candidate->exists()) {
                $candidate->first()->update(['cv' => $cv_path]);
            } else {
                CandidateProfile::updateOrCreate([
                    'candidate_profile_id' => $candidate->first()->id,
                ], [
                    'candidate_profile_id' => $candidate->first()->id,
                    'cv' => $cv_path,
                ]);
            }
        });
        return back()->with('success', 'Profile updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CandidateProfile $candidateProfile)
    {
        return  view('candidate.dashboard',);
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
