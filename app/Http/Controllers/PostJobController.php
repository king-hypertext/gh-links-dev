<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Employer;
use App\Models\EmployerProfile;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employer = Employer::find(auth('employer')->id());
        return view('employer.post-job.index', ['page_title' => 'POST JOB', 'employer' => $employer]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employer = EmployerProfile::query()->where('employer_id', auth('employer')->id())->first();
        if (!$employer) {
            return redirect(route('employer.company-profile'))->with('incomplete', 'Please complete your profile before you can post a new job');
        }

        $path = 'POST JOB';
        $page_title = 'Create Job';
        $education = DB::table('education')->get(['id', 'level']);
        $job_experiences = DB::table('job_experience')->get(['id', 'level']);
        $salaries = DB::table('salaries')->get(['id', 'type']);
        $cities = City::all(['id', 'name']);
        $company_id =  $employer->id;
        return view(
            'employer.post-job.create',
            compact('path', 'page_title', 'education', 'job_experiences', 'salaries', 'cities', 'company_id')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'type' => 'required|string|in:full-time,part-time,contract',
                'company_id' => 'required|integer|exists:employer_profiles,id',
                'min_salary' => 'required|integer|min:10',
                'max_salary' => 'required|integer|min:0',
                'description' => 'required|string',
                'district_id' => 'required|integer|exists:districts,id',
                'benefits' => 'nullable|string',
                'entry_id' => 'required|integer|exists:job_experience,id',
                'open_vacancies' => 'required|integer|min:0',
                'min_experience' => 'required|string',
                'education_id' => 'required|integer|exists:education,id',
                'salary_id' => 'required|integer|exists:salaries,id',
            ]
        );
        Job::create($request->all());
        return redirect(route('job.index'))->with('success', 'job successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
