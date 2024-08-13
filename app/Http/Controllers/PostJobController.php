<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Employer;
use App\Models\EmployerProfile;
use App\Models\Job;
use App\Models\JobTags;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employer = Employer::where('user_id', auth('employer')->id())->first();
        $applications = \App\Models\CandidateApplication::all();

        // if ($request->has('status')) {
        //     $active = $request->active;
        //     $inactive = $request->inactive;
        //     if ($active) {
        //         $employer = $employer->where('status', '=', true);
        //     } elseif ($inactive) {
        //         $employer = $employer->where('status', '=', false);
        //     }
        // }
        $page_title = 'MY JOBS';
        $all_jobs = $employer->jobs->sortBy('status', 0);
        return view('employer.post-job.index', compact('all_jobs', 'page_title', 'employer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employer = Employer::query()->where('user_id','=', auth('employer')->id())->first();
        // dd($employer);
        if (!$employer) {
            return redirect(route('employer.company-profile'))->with('incomplete', 'Please complete your profile before you can post a new job');
        }

        $page_title = 'POST JOB';
        $education = DB::table('education')->get(['id', 'level']);
        $job_experiences = DB::table('job_experience')->get(['id', 'level']);
        $salaries = DB::table('salaries')->get(['id', 'type']);
        $cities = City::all(['id', 'name']);
        // $company_id =  $employer->id;
        $tags = Tags::orderBy('created_at','desc')->get();
        // dd($tags);
        return view(
            'employer.post-job.create',
            compact( 'page_title', 'education', 'job_experiences', 'salaries', 'cities', 'tags')
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
                'city_id' => 'required|integer|exists:districts,id',
                'benefits' => 'nullable|string',
                'entry_id' => 'required|integer|exists:job_experience,id',
                'open_vacancies' => 'required|integer|min:0',
                'min_experience' => 'required|string',
                'education_id' => 'required|integer|exists:education,id',
                'salary_id' => 'required|integer|exists:salaries,id',
                'tags.*' => 'nullable|exists:tags,id'
            ]
        );
        // $request->dd();
        $job = Job::create($request->all());
        foreach ($request->tags as $tag) {
            JobTags::create([
                'job_id' => $job->id,
                'tags_id' => $tag,
            ]);
        }
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
    public function edit($id)
    {
        $job = Job::find($id);
        $path = 'EIDT JOB';
        $education = DB::table('education')->get(['id', 'level']);
        $job_experiences = DB::table('job_experience')->get(['id', 'level']);
        $salaries = DB::table('salaries')->get(['id', 'type']);
        $cities = City::all(['id', 'name']);
        $page_title = 'EDIT JOB';
        $tags = Tags::all();
        $job_tag_ids = $job->tags->pluck('id')->toArray();
        // dd($job_tag_ids, $job->tags);
        return view('employer.post-job.edit', compact('job', 'job_tag_ids', 'tags', 'page_title', 'education', 'salaries', 'cities', 'job_experiences'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request, Job $job)
    {
        // dd($request->tags);
        // $request->dd();
        $data = $request->validate(
            [
                'title' => 'required|string|max:255',
                'type' => 'required|string|in:full-time,part-time,contract,intenship',
                'company_id' => 'required|integer|exists:employer_profiles,id',
                'min_salary' => 'required|integer|min:10',
                'max_salary' => 'required|integer|min:0',
                'description' => 'required|string',
                'city_id' => 'required|integer|exists:cities,id',
                'benefits' => 'nullable|string',
                'entry_id' => 'required|integer|exists:job_experience,id',
                'open_vacancies' => 'required|integer|min:0',
                'min_experience' => 'required|string',
                'education_id' => 'required|integer|exists:education,id',
                'salary_id' => 'required|integer|exists:salaries,id',
                'status' => 'nullable|in:0,1',
            ]
        );
        $job->where('id', $id)->update($data);
        JobTags::where('job_id', $id)->delete();
        foreach ($request->tag_id as $tag) {
            JobTags::where('job_id', $id)->create([
                'job_id' => $job->find($id)->id,
                'tags_id' => $tag
            ]);
        }
        // $job/* ->with('tags') */->find($id)->tags()->syncWithoutDetaching($request->only('tag_id'));
        return redirect(route('my-jobs.edit', $id))->with('success', 'Job updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        abort(404);
    }
}
