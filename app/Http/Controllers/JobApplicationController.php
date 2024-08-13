<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Candidate;
use App\Models\CandidateProfile;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\Tags;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $page_title = 'JOB APPLICATIONS';
    //     return view('employer.applications', compact('page_title'));
    // }

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
    public function show($job)
    {
        abort_if($job == null, 403, 'No job or candidate specified');
        $job = Job::find($job);
        abort_unless($job !== null, 403, 'Application not found');
        $path = 'my jobs / ' . $job->title;
        $page_title = 'APPLICATION';
        return view('employer.applications', compact('page_title',   'job', 'path'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $jobApplication)
    {
        //
    }
    public function approve_application($id)
    {
        // dd($id); 
        JobApplication::where('id', $id)->update([
            'approved' => true
        ]);
        return response(['success' => true, 'message' => 'application approved successfully']);
    }
    public function add_skill_set(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]); 
        Tags::create($request->all('name'));
        return response(['success' => true, 'message' => 'skill set addedd successfully']);
    }
}
