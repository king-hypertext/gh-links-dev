<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateApplication;
use App\Models\CandidateEducationDetail;
use App\Models\CandidateJobExperience;
use App\Models\CandidateProfile;
use App\Models\CandidateResume;
use App\Models\SavedJob;
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
    public function settings()
    {
        $page_title = 'SEETINGS';
        return view('candidate.settings', compact('page_title'));
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
                'profile_picture' => 'nullable|image|mimes:png,jpg,jpeg,webp',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'website_url' => 'nullable|active_url',
                'marital_status' => 'required|in:married,single,divorced',
                'location' => 'required|string',
                'date_of_birth' => 'required|date',
                'experience' => 'required|string',
                'job_role' => 'required|string',
            ]);
            $profile_picture = $request->file('profile_picture') ? url('/storage/' . $request->file('profile_picture')->store('candidates/image', 'public')) : null;
            if ($candidate->exists()) {
                $candidate->first()->update(
                    [
                        'gender' => $request->gender,
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'website_url' => $request->website_url,
                        'marital_status' => $request->marital_status,
                        'location' => $request->location,
                        'date_of_birth' => $request->date_of_birth,
                        'experience' => $request->experience,
                        'job_role' => $request->job_role,
                        // 'biography' => null,
                    ]
                );
                $request->file('profile_picture') ?
                    $candidate->first()->update([
                        'profile_picture' => $profile_picture,
                    ]) : null;
                // return response(['success' => true, 'url' => $url]);
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
                    'job_role' => $request->job_role,
                    // 'biography' => 'not filled',
                ]);
            }
        });

        $request->whenHas('edu_info', function () use ($request, $candidate) {
            if ($candidate->exists()) {
                $request->validate([
                    'candidate_profile_id',
                    'institution_name',
                    'institution_location',
                    'level',
                    'started_at',
                    'ended_at',
                ]);
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
                return back()->with('success', 'Profile updated successfully');
            } else
                return back()->with('incomplete', 'Please update your basic information section before updating your Educational information');
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
            } else
                return back()->with('incomplete', 'Please update your basic information section before updating your Job Experience information');
        });
        $request->whenHas('biography', function () use ($request, $candidate) {
            $request->validate([
                'biography' => 'required|string',
            ]);
            if ($candidate->exists()) {
                $candidate->first()->update(['biography' => $request->biography]);
            } else
                return back()->with('incomplete', 'Please update your basic information section before updating your Biography');
        });
        $request->whenHas('cv_upload', function () use ($request, $candidate) {
            $request->validate([
                'cv' => 'required|file|mimes:pdf',
            ]);
            $cv = $request->file('cv');
            if ($candidate->exists()) {
                if ($candidate->first()->resume->file) {
                    // dd(public_path(str_ireplace(url(''), '', $candidate->first()->resume->file)));
                    unlink(public_path(str_ireplace(url(''), '', $candidate->first()->resume->file)));
                }
                $cv_path = url('/storage/' . $cv->storeAs('candidates/cv', $request->name . '.' . $candidate->first()->id . '.' . now()->format('Y.m.d.H.i') . '.pdf', 'public'));
                CandidateResume::updateOrCreate([
                    'candidate_profile_id' => $candidate->first()->id,
                ], [
                    'candidate_profile_id' => $candidate->first()->id,
                    'name' => $request->name . '.' . $candidate->first()->id . '.' . now()->format('Y.m.d.H.i'),
                    'file' => $cv_path
                ]);
            } else
                return back()->with('incomplete', 'Please update your basic information section before uploading your CV file.');
        });
        $url = redirect()->route('candidate.profile.create')->with('success', 'Profile updated successfully')->getTargetUrl();
        return $request->ajax() ? response(['success' => true, 'url' => $url]) :
            back()->with('success', 'Profile updated successfully');
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
        $candidate = $candidate->where('candidate_id', auth('candidate')->id())->first();
        $saved_jobs = $candidate->saved_jobs;
        return view('candidate.saved-jobs', compact('page_title', 'candidate', 'saved_jobs'));
    }
    public function save_job(Request $request)
    {
        $savedJob = auth('candidate')->user()->profile->saved_jobs()->where('job_id', $request->job_id);
        $isJobSaved = auth('candidate')->user()->profile->saved_jobs->contains('job_id', $request->job_id);
        if ($isJobSaved) {
            $savedJob->delete();
            return response(['success' => true, 'message' => 'job removed from favourites']);
        }
        // Save the job
        auth('candidate')->user()->profile->saved_jobs()->create([
            'job_id' => $request->job_id,
            'candidate_profile_id' => auth('candidate')->user()->profile->id
        ]);
        return response(['success' => true, 'message' => 'job added to favourites']);
    }
    public function unsave_job(Request $request)
    {
        $savedJob = auth('candidate')->user()->profile->saved_jobs()->where('job_id', $request->job_id);
        $savedJob->delete();
        $redirect_url = redirect()->back()->with('success', 'job removed from favourites')->getTargetUrl();
        return response(['success' => true, 'url' => $redirect_url, 'message' => 'job removed from favourites']);
    }
    public function apply_job(Request $request)
    {
        $request->validate([
            'cover_letter' => 'required|string',
        ]);
        CandidateApplication::create([
            'candidate_profile_id' => auth('candidate')->user()->profile->id,
            'job_id' => $request->job_id,
            'cover_letter' => $request->cover_letter,
        ]);
        return response(['success' => true, 'message' => 'application sent successfully', 'statusText' => 'sent']);
    }
    public function applied_jobs(CandidateProfile $candidate)
    {
        $page_title = 'APPLIED JOBS';
        $candidate = auth('candidate')->user()->profile;
        $applied_jobs = $candidate->job_applications;
        return view('candidate.applied-jobs', compact('page_title', 'candidate', 'applied_jobs'));
    }
}
