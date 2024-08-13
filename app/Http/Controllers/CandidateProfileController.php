<?php

namespace App\Http\Controllers;

use App\Models\SavedJob;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\CandidateResume;
use App\Models\CandidateProfile;
use App\Models\CandidateApplication;
use Illuminate\Support\Facades\Hash;
use App\Models\CandidateJobExperience;
use App\Models\CandidateEducationDetail;

class CandidateProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('candidate.dashboard');
    }
    public function settings()
    {
        $page_title = 'SEETINGS';
        return view('candidate.settings', compact('page_title'));
    }
    public function upload_image(Request $request)
    {
        $user = $request->user('candidate');
        if ($request->hasFile('image')) {
            $request->validate(
                [
                    'image' => 'required|image|mimes:jpg,png,jpeg,webp,bmp|max:2048',
                ],
                [
                    'image.max' => 'image size must be less than 2MB'
                ]
            );
            $dp = '/storage/' . $request->file('image')->store('images/candidates', 'public');
            $user->candidate()->update([
                'dp' => $dp,
            ]);
            return response(['success' => true, 'file' => $dp]);
        }
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
        $id = $request->user('candidate')->id;
        $back = redirect()->route('candidate.profile.create')->with('success', 'Profile updated successfully');
        $candidate = Candidate::query()->where('user_id', '=', $id);
        $candidate_id = $candidate->first('id')->id;
        if ($request->filled('basic_info')) {
            $request->validate([
                'gender' => 'required|in:male,female',
                'dp' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'website_url' => 'nullable|active_url',
                'marital_status' => 'required|in:married,single,divorced',
                'location' => 'required|string',
                'date_of_birth' => 'required|date',
                'experience' => 'required|integer',
                'profession' => 'required|string',
            ]);
            $dp = $request->file('dp') ? $request->file('dp')->store('images/candidates', 'public') : null;
            Candidate::updateOrCreate(
                [
                    'user_id' => $id,
                ],
                [
                    'user_id' => $id,
                    'gender' => $request->gender,
                    'first_name' => strtolower($request->first_name),
                    'last_name' => strtolower($request->last_name),
                    'website_url' => strtolower($request->website_url),
                    'marital_status' => $request->marital_status,
                    'location' => strtolower($request->location),
                    'date_of_birth' => $request->date_of_birth,
                    'experience' => $request->experience,
                    'profession' => strtolower($request->profession),
                ]
            );
            if ($dp) {
                Candidate::updateOrCreate([
                    'user_id' => $id
                ], [
                    'dp' => '/storage/' . $dp
                ]);
            }
            return  response(['success' => true, 'url' => $back->getTargetUrl()]);
        }
        if ($request->filled('edu_info')) {
            if (!$candidate->exists()) {
                return back()->with('incomplete', 'Please update your basic information section before updating your Educational information');
            }
            $request->validate([
                'institution_name' => 'required|string',
                'institution_location' => 'required|string',
                'started_at' => 'required|string|date',
                'ended_at' => 'required|string|date',
            ]);
            CandidateEducationDetail::updateOrCreate([
                'candidate_id' => $candidate_id,
            ], [
                'candidate_id' => $candidate_id,
                'institution_name' => $request->institution_name,
                'institution_location' => $request->institution_location,
                'started_at' => $request->started_at,
                'ended_at' => $request->ended_at,
            ]);
            return $back;
        }
        if ($request->filled('job_exp')) {
            if (!$candidate->exists()) {
                return back()->with('incomplete', 'Please update your basic information section before updating your Job Experices information');
            }
            $request->validate([
                'is_current' => 'nullable|boolean',
                'job_started_at' => 'required|date',
                'position' => 'required|string',
                'job_description' => 'required|string',
                'company_name' => 'required|string',
                'job_location' => 'required|string',
            ]);
            CandidateJobExperience::updateOrCreate([
                'candidate_id' => $candidate_id,
            ], [
                'candidate_id' => $candidate_id,
                'is_current' => $request->is_current ?? false,
                'started_at' => $request->job_started_at,
                'ended_at' => $request->job_ended_at ?? null,
                'position' => $request->position,
                'job_description'   => $request->job_description,
                'company_name' => $request->company_name,
                'job_location' => $request->job_location,
            ]);
            return $back;
        }
        if ($request->filled('biography')) {
            if (!$candidate->exists()) {
                return back()->with('incomplete', 'Please update your basic information section before updating your Biography');
            }
            $request->validate([
                'biography' => 'required|string',
            ]);
            $candidate->update(['biography' => $request->biography]);
            return $back;
        }
        if ($request->filled('cv_upload')) {
            if (!$candidate->exists()) {
                return back()->with('incomplete', 'Please update your basic information section before uploading you CV');
            }
            $request->validate([
                'cv' => 'required|file|mimes:pdf',
            ]);
            $cv_name = str_replace(' ', '_', $candidate->first('full_name')->full_name) . '_@gh-links_' . $candidate_id . '.pdf';
            $cv = $request->file('cv') ? $request->file('cv')->storeAs('/pdf/resumes', $cv_name, 'public') : null;
            CandidateResume::updateOrCreate([
                'candidate_id' => $candidate_id,
            ], [
                'candidate_id' => $candidate_id,
                'cv' => '/storage/' . $cv
            ]);
            return $back;
        }
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
    public function update(Request $request)
    {
        $user = $request->user('candidate');
        if ($request->has('password')) {
            $request->validate(
                [
                    'c_password' => ['required', 'string'],
                    'password' => ['required', 'string', 'confirmed'],
                ],
                [
                    'password.confirmed' => 'The confirmed new password does not match the new password'
                ]
            );
            if (Hash::check($request->input('c_password'), $user->password)) {
                $user->password = Hash::make($request->input('password'));
                $user->save();
                return response([
                    'success' => true,
                    'url' => redirect()->back()
                        ->with('success', 'Password updated successfully')
                        ->getTargetUrl()
                ]);
            }
            return response()->json(
                [
                    'errors' =>
                    ['The current password is incorrect']
                ],
                422,
                ['content-type' => 'application/json']
            );
        }
        $request->validate([
            'username' => 'required|string|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|unique:users,phone_number,' . $user->id,
        ]);
        $user->update(array_map('strtolower', $request->all()));
        return back()->with('success', 'info uccessfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CandidateProfile $candidateProfile)
    {
        abort(403);
    }
    public function save_jobs()
    {
        $page_title = 'SAVED JOBS';
        return view('candidate.saved-jobs', compact('page_title'));
    }
    public function save_job(Request $request)
    {
        $user = $request->user('candidate');
        $savedJob = $user->candidate->savedJobs()->where('job_id', $request->job_id);
        $isJobSaved = $user->candidate->savedJobs->contains('job_id', $request->job_id);
        // dd($request->all(), $isJobSaved, $user, $savedJob);
        if ($isJobSaved) {
            $savedJob->delete();
            return response(['success' => true, 'message' => 'job removed from favourites', 'title' => 'add job to favourites']);
        }
        // Save the job
        $user->candidate->savedJobs()->create([
            'job_id' => $request->job_id,
            'candidate_id' => $user->candidate->id
        ]);
        return response(['success' => true, 'message' => 'job added to favourites', 'title' => 'remove job to favourites']);
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
        $candidate_id =  Candidate::where('user_id', $request->user('candidate')->id)->value('id');
        // dd($candidate_id);
        $request->validate([
            'cover_letter' => 'required|string',
        ]);
        CandidateApplication::create([
            'candidate_id' => $candidate_id,
            'job_id' => $request->job_id,
            'cover_letter' => $request->cover_letter,
        ]);
        // application will be sent here and before response is sent
        return response(['success' => true, 'message' => 'application sent successfully', 'statusText' => 'sent']);
    }
    public function applied_jobs()
    {
        $page_title = 'APPLIED JOBS';
        return view('candidate.applied-jobs', compact('page_title'));
    }
}
